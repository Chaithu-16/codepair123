<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Study Planner</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-blue: #2563eb;
            --secondary-blue: #3b82f6;
            --light-blue: #eff6ff;
            --white: #ffffff;
            --text-dark: #1e293b;
            --text-gray: #64748b;
            --danger: #ef4444;
            --success: #22c55e;
            --border-color: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f1f5f9;
            color: var(--text-dark);
            min-height: 100vh;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Container */
        .container {
            width: 100%;
            max-width: 1400px;
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 2rem;
            animation: fadeIn 0.5s ease-out;
        }

        /* Header */
        header {
            width: 100%;
            max-width: 1400px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: white;
            padding: 1rem 2rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        header h1 {
            color: var(--primary-blue);
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-link {
            text-decoration: none;
            color: var(--text-gray);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: var(--primary-blue);
        }

        /* Cards */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            height: fit-content;
        }

        /* Input Section */
        .input-header {
            border-bottom: 2px solid var(--light-blue);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .input-header h2 {
            font-size: 1.25rem;
            color: var(--text-dark);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-gray);
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            outline: none;
            transition: border-color 0.2s;
            font-size: 0.95rem;
        }

        .form-group input:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px var(--light-blue);
        }

        .btn {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: var(--primary-blue);
            color: white;
            margin-top: 1rem;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-success {
            background: var(--success);
            color: white;
            margin-top: 0.5rem;
        }

        .btn-success:hover {
            background: #16a34a;
        }

        .btn-danger {
            background: var(--danger);
            color: white;
            margin-top: 0.5rem;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-gray);
            margin-top: 0.5rem;
        }

        .btn-outline:hover {
            background: #f8fafc;
            color: var(--text-dark);
            border-color: var(--text-gray);
        }

        /* Topic List */
        .topic-preview {
            margin-top: 2rem;
            max-height: 300px;
            overflow-y: auto;
            border-top: 1px solid var(--border-color);
            padding-top: 1rem;
        }

        .topic-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 6px;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            border: 1px solid transparent;
        }

        .topic-item:hover {
            border-color: var(--border-color);
            background: white;
        }

        .topic-info span {
            display: block;
        }

        .topic-subject {
            font-weight: 600;
            color: var(--primary-blue);
            font-size: 0.85rem;
        }

        .topic-name {
            color: var(--text-dark);
        }

        .delete-btn {
            color: var(--text-gray);
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
        }

        .delete-btn:hover {
            color: var(--danger);
            background: #fee2e2;
        }

        /* Timetable Grid */
        .timetable-section {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .timetable-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .controls {
            display: flex;
            gap: 1rem;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1rem;
            overflow-x: auto;
            padding-bottom: 1rem;
        }

        .day-column {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            border: 1px solid var(--border-color);
            min-height: 400px;
            display: flex;
            flex-direction: column;
        }

        .day-header {
            background: var(--light-blue);
            padding: 1rem;
            text-align: center;
            font-weight: 700;
            color: var(--primary-blue);
            border-bottom: 1px solid var(--border-color);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .day-content {
            padding: 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            flex: 1;
            background: #fafafa;
        }

        .schedule-card {
            background: white;
            border: 1px solid var(--border-color);
            border-left: 4px solid var(--secondary-blue);
            padding: 0.75rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .schedule-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: #f0f9ff;
            border-left-color: var(--primary-blue);
        }

        .schedule-card h4 {
            font-size: 0.85rem;
            margin-bottom: 0.25rem;
            color: var(--primary-blue);
            font-weight: 700;
        }

        .schedule-card p {
            font-size: 0.8rem;
            color: var(--text-dark);
            font-weight: 500;
            line-height: 1.3;
        }

        .slot-badge {
            font-size: 0.7rem;
            background: #e2e8f0;
            color: var(--text-gray);
            padding: 2px 6px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .pdf-badge {
            font-size: 0.7rem;
            background: #fee2e2;
            color: #ef4444;
            padding: 2px 6px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-top: 6px;
        }

        /* PDF Viewer Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .modal.show {
            opacity: 1;
        }

        .modal-content {
            background: white;
            width: 90%;
            height: 90%;
            border-radius: var(--radius);
            position: relative;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .modal-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8fafc;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-gray);
            transition: color 0.2s;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .close-btn:hover {
            color: var(--danger);
            background: #fee2e2;
        }

        .pdf-frame {
            flex: 1;
            width: 100%;
            border: none;
            background: #e2e8f0;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .container {
                grid-template-columns: 1fr;
            }

            .schedule-grid {
                grid-template-columns: repeat(2, 1fr);
                /* 2 columns on tablet */
            }
        }

        @media (max-width: 600px) {
            .schedule-grid {
                grid-template-columns: 1fr;
                /* 1 column on mobile */
            }
        }
    </style>
</head>

<body>

    <header>
        <h1><i class="fa-solid fa-graduation-cap"></i> Smart Study Planner</h1>
        <a href="index.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> Back to Dashboard</a>
    </header>

    <div class="container">
        <!-- Input Section -->
        <div class="input-section">
            <div class="card">
                <div class="input-header">
                    <h2>Add Course Content</h2>
                    <span style="font-size: 0.8rem; color: var(--text-gray);"><span id="topicCount">0</span>
                        added</span>
                </div>
                <form id="topicForm">
                    <div class="form-group">
                        <label for="subject">Subject Name</label>
                        <input type="text" id="subject" placeholder="e.g. Computer Science" required>
                    </div>
                    <div class="form-group">
                        <label for="topic">Topic Name</label>
                        <input type="text" id="topic" placeholder="e.g. Data Structures" required>
                    </div>
                    <div class="form-group">
                        <label for="pdfUpload">Material (PDF)</label>
                        <input type="file" id="pdfUpload" accept="application/pdf" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i> Add Topic
                    </button>
                    <p id="storageWarning"
                        style="color: darkorange; font-size: 0.8rem; margin-top: 10px; display: none;">
                        <i class="fa-solid fa-triangle-exclamation"></i> Large file detected. LocalStorage may fill up.
                    </p>
                </form>

                <div class="topic-preview">
                    <div id="topicList">
                        <!-- Items go here -->
                        <div style="text-align: center; color: var(--text-gray); padding: 1rem; font-size: 0.9rem;">
                            No topics added yet.
                        </div>
                    </div>
                </div>

                <div style="margin-top: 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                        <button id="saveBtn" class="btn btn-success">
                            <i class="fa-solid fa-save"></i> Save All
                        </button>
                        <button id="clearBtn" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i> Clear All
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timetable Section -->
        <div class="timetable-section">
            <div class="timetable-header">
                <h2><i class="fa-regular fa-calendar-days"></i> Your Weekly Schedule</h2>
                <div class="controls">
                    <button id="generateBtn" class="btn btn-primary"
                        style="margin:0; width: auto; padding: 0.5rem 1.5rem;">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> Generate Timetable
                    </button>
                </div>
            </div>

            <div class="schedule-grid" id="scheduleGrid">
                <!-- Days Generated via JS -->
            </div>
        </div>
    </div>

    <!-- PDF Viewer Modal -->
    <div id="pdfModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="pdfTitle">Document Viewer</h3>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <iframe id="pdfFrame" class="pdf-frame" src=""></iframe>
        </div>
    </div>

    <script>
        // --- State Management ---
        let topics = [];
        const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        const timeSlots = ['Morning Session', 'Afternoon Session', 'Evening Session'];

        // --- DOM Elements ---
        const topicForm = document.getElementById('topicForm');
        const topicList = document.getElementById('topicList');
        const topicCount = document.getElementById('topicCount');
        const saveBtn = document.getElementById('saveBtn'); // Now effectively "Refresh" or removed
        const clearBtn = document.getElementById('clearBtn');
        const generateBtn = document.getElementById('generateBtn');
        const scheduleGrid = document.getElementById('scheduleGrid');
        const modal = document.getElementById('pdfModal');
        const pdfFrame = document.getElementById('pdfFrame');
        const pdfTitle = document.getElementById('pdfTitle');
        const storageWarning = document.getElementById('storageWarning');

        // Initial Load
        document.addEventListener('DOMContentLoaded', () => {
            initGridStructure();
            loadData();
        });

        // --- Core Functions ---

        function initGridStructure() {
            scheduleGrid.innerHTML = '';
            days.forEach((day, index) => {
                const col = document.createElement('div');
                col.className = 'day-column';
                col.innerHTML = `
                    <div class="day-header">${day}</div>
                    <div class="day-content" id="day-${index}"></div>
                `;
                scheduleGrid.appendChild(col);
            });
        }

        // Add Topic (Upload to Server)
        topicForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const subject = document.getElementById('subject').value.trim();
            const topicName = document.getElementById('topic').value.trim();
            const fileInput = document.getElementById('pdfUpload');

            if (!fileInput.files.length) {
                alert("Please select a PDF file.");
                return;
            }

            const formData = new FormData();
            formData.append('subject', subject);
            formData.append('topicName', topicName);
            formData.append('pdfFile', fileInput.files[0]);

            const submitBtn = topicForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Uploading...';
            submitBtn.disabled = true;

            try {
                const response = await fetch('api.php?action=add_schedule_item', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();

                if (result.error) {
                    throw new Error(result.error);
                }

                // Refresh data
                await loadData();
                topicForm.reset();
                storageWarning.style.display = 'none';

            } catch (error) {
                console.error("Error uploading:", error);
                alert("Failed to upload: " + error.message);
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });

        // Delete Topic
        async function deleteTopic(id) {
            if (!confirm("Are you sure you want to delete this topic?")) return;

            try {
                const response = await fetch('api.php?action=delete_schedule_item', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id })
                });
                const result = await response.json();
                if (result.error) throw new Error(result.error);
                
                loadData(); // Refresh UI
            } catch (error) {
                console.error("Delete failed:", error);
                alert("Failed to delete item.");
            }
        }

        function updateTopicListUI() {
            topicList.innerHTML = '';
            topicCount.innerText = topics.length;

            if (topics.length === 0) {
                topicList.innerHTML = '<div style="text-align: center; color: var(--text-gray); padding: 1rem;">No topics added yet.</div>';
                return;
            }

            topics.forEach(t => {
                const div = document.createElement('div');
                div.className = 'topic-item';
                div.innerHTML = `
                    <div class="topic-info">
                        <span class="topic-subject">${t.subject}</span>
                        <span class="topic-name">${t.topic_name}</span> 
                    </div>
                    <i class="fa-solid fa-trash delete-btn" onclick="deleteTopic(${t.id})"></i>
                `;
                topicList.appendChild(div);
            });
        }

        // --- Persistence (Load from Server) ---

        // Function currently bound to "Save All" button - we can repurpose or hide it
        // Since we save on add, this is less useful, but maybe "Refresh"?
        saveBtn.style.display = 'none'; // Hide Save button as it's auto-saved now

        async function loadData() {
            try {
                const response = await fetch('api.php?action=get_schedule');
                const data = await response.json();
                topics = data; // Array of objects from DB
                updateTopicListUI();
                generateTimetable(); // Auto-regenerate on load
            } catch (error) {
                console.error("Failed to load schedule:", error);
            }
        }

        // Clear All
        clearBtn.addEventListener('click', async () => {
            if (confirm('Are you sure you want to delete ALL data and clear the schedule? This cannot be undone.')) {
                try {
                    const response = await fetch('api.php?action=clear_schedule');
                    const result = await response.json();
                    if (result.status === 'success') {
                        loadData(); // Will clear UI
                    }
                } catch (e) {
                    alert("Failed to clear schedule.");
                }
            }
        });

        // --- Timetable Generation ---

        generateBtn.addEventListener('click', generateTimetable);

        function generateTimetable() {
            // Reset current grid content
            const dayContents = document.querySelectorAll('.day-content');
            dayContents.forEach(dc => dc.innerHTML = '');

            if (topics.length === 0) return;

            // Distribution Logic
            topics.forEach((topic, index) => {
                // Day Cycle: 0-6
                const dayIndex = index % 7;

                // Slot Cycle
                const slotIndex = Math.floor(index / 7) % timeSlots.length;

                const dayContent = document.getElementById(`day-${dayIndex}`);

                const card = document.createElement('div');
                card.className = 'schedule-card';
                card.onclick = () => openPdf(topic);
                
                // Note: DB returns 'topic_name', local JS used 'topicName'
                // We'll use database keys now: topic_name, subject, file_path
                card.innerHTML = `
                    <div class="slot-badge">${timeSlots[slotIndex]}</div>
                    <h4>${topic.subject}</h4>
                    <p>${topic.topic_name}</p>
                    <div class="pdf-badge"><i class="fa-solid fa-file-pdf"></i> View PDF</div>
                `;

                dayContent.appendChild(card);
            });
        }

        // --- PDF Viewer ---

        function openPdf(topic) {
            pdfTitle.innerText = `${topic.subject} - ${topic.topic_name}`;
            
            // topic.file_path is relative "uploads/filename.pdf"
            console.log("Opening:", topic.file_path);
            
            if (topic.file_path) {
                pdfFrame.src = topic.file_path + "#toolbar=0&view=FitH";
                modal.style.display = 'flex';
                setTimeout(() => modal.classList.add('show'), 10);
            } else {
                alert("No PDF file found for this topic.");
            }
        }

        function closeModal() {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
                pdfFrame.src = '';
            }, 300);
        }

        window.onclick = (event) => {
            if (event.target == modal) closeModal();
        }
    </script>
</body>

</html>