<?php
// db.php

$db_file = __DIR__ . '/database.sqlite';

try {
    // Create (connect to) SQLite database in file
    $pdo = new PDO("sqlite:" . $db_file);
    // Set errormode to exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Create tables if they don't exist
    
    // 1. Stats Table (Stores single row of aggregate data for dashboard)
    $pdo->exec("CREATE TABLE IF NOT EXISTS stats (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        total_hours REAL DEFAULT 0,
        topics_count INTEGER DEFAULT 0,
        mock_scores TEXT DEFAULT '[]' -- JSON array of scores
    )");

    // Initialize stats row if empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM stats");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO stats (total_hours, topics_count, mock_scores) VALUES (0, 0, '[]')");
    }

    // 2. Schedule Table (Stores topics and PDFs)
    $pdo->exec("CREATE TABLE IF NOT EXISTS schedule (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        subject TEXT NOT NULL,
        topic_name TEXT NOT NULL,
        file_path TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
