<?php
// api.php
header('Content-Type: application/json');
require 'db.php';

$action = $_GET['action'] ?? '';

try {
    switch ($action) {
        // --- Dashboard Stats Endpoints ---
        
        case 'get_stats':
            $stmt = $pdo->query("SELECT * FROM stats LIMIT 1");
            $data = $stmt->fetch();
            // Decode JSON for frontend
            $data['mock_scores'] = json_decode($data['mock_scores']);
            echo json_encode($data);
            break;

        case 'update_stats':
            // Expect JSON input
            $input = json_decode(file_get_contents('php://input'), true);
            if (!$input) throw new Exception("Invalid JSON input");

            $totalHours = $input['totalHours'] ?? 0;
            $topicsCount = $input['topicsCount'] ?? 0;
            $mockScores = json_encode($input['mockScores'] ?? []);

            $stmt = $pdo->prepare("UPDATE stats SET total_hours = ?, topics_count = ?, mock_scores = ? WHERE id = 1"); // Assuming single user row
            $stmt->execute([$totalHours, $topicsCount, $mockScores]);
            
            echo json_encode(['status' => 'success']);
            break;

        // --- Schedule Endpoints ---

        case 'get_schedule':
            $stmt = $pdo->query("SELECT * FROM schedule ORDER BY created_at ASC");
            $schedule = $stmt->fetchAll();
            echo json_encode($schedule);
            break;

        case 'add_schedule_item':
            // Handles FormData (Text + File)
            $subject = $_POST['subject'] ?? '';
            $topicName = $_POST['topicName'] ?? '';
            $filePath = '';

            if (empty($subject) || empty($topicName)) {
                throw new Exception("Subject and Topic Name are required.");
            }

            // Handle File Upload
            if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                $fileName = time() . '_' . basename($_FILES['pdfFile']['name']);
                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], $targetPath)) {
                    $filePath = 'uploads/' . $fileName;
                } else {
                    throw new Exception("File upload failed.");
                }
            }

            $stmt = $pdo->prepare("INSERT INTO schedule (subject, topic_name, file_path) VALUES (?, ?, ?)");
            $stmt->execute([$subject, $topicName, $filePath]);
            
            echo json_encode(['status' => 'success', 'id' => $pdo->lastInsertId(), 'file_path' => $filePath]);
            break;

        case 'delete_schedule_item':
            $input = json_decode(file_get_contents('php://input'), true);
            $id = $input['id'] ?? 0;
            
            if ($id) {
                // Get file path first to delete file
                $stmt = $pdo->prepare("SELECT file_path FROM schedule WHERE id = ?");
                $stmt->execute([$id]);
                $item = $stmt->fetch();

                if ($item && $item['file_path'] && file_exists(__DIR__ . '/' . $item['file_path'])) {
                    unlink(__DIR__ . '/' . $item['file_path']);
                }

                $pdo->prepare("DELETE FROM schedule WHERE id = ?")->execute([$id]);
                echo json_encode(['status' => 'success']);
            } else {
                throw new Exception("Invalid ID");
            }
            break;

        case 'clear_schedule':
            // Delete all files
            $stmt = $pdo->query("SELECT file_path FROM schedule");
            while ($row = $stmt->fetch()) {
                if ($row['file_path'] && file_exists(__DIR__ . '/' . $row['file_path'])) {
                    unlink(__DIR__ . '/' . $row['file_path']);
                }
            }
            // Truncate table
            $pdo->exec("DELETE FROM schedule");
            // Reset Auto Increment? (SQLite specific)
            $pdo->exec("DELETE FROM sqlite_sequence WHERE name='schedule'");
            
            echo json_encode(['status' => 'success']);
            break;

        default:
            throw new Exception("Invalid action");
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
