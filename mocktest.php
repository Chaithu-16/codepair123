<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mock Test Arena - Smart Study Planner</title>
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
            background-color: #f8fafc;
            color: var(--text-dark);
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden; /* App-like feel */
        }

        /* Header */
        header {
            background: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            z-index: 10;
        }

        header h1 {
            color: var(--primary-blue);
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header-controls {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .score-display {
            background: var(--light-blue);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            color: var(--primary-blue);
            border: 1px solid var(--primary-blue);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-link {
            text-decoration: none;
            color: var(--text-gray);
            font-weight: 500;
            transition: color 0.2s;
            font-size: 0.9rem;
        }

        .back-link:hover {
            color: var(--primary-blue);
        }

        /* Main Layout */
        .workspace {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 300px;
            background: white;
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            color: var(--text-dark);
        }

        .file-list {
            flex: 1;
            overflow-y: auto;
            padding: 0.5rem;
        }

        .file-item {
            padding: 0.75rem 1rem;
            margin-bottom: 0.25rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--text-gray);
        }

        .file-item:hover {
            background: var(--light-blue);
            color: var(--primary-blue);
        }

        .file-item.active {
            background: var(--primary-blue);
            color: white;
        }

        .file-item i {
            font-size: 1.1rem;
        }

        .file-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .file-subject {
            font-size: 0.75rem;
            opacity: 0.8;
            font-weight: 500;
        }

        .file-name {
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 400px; /* PDF vs MCQ Panel */
            background: #e2e8f0;
        }

        /* PDF Viewer */
        .pdf-container {
            background: #525659; /* Standard PDF viewer bg color */
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .empty-state {
            text-align: center;
            color: white;
        }

        /* MCQ Panel */
        .mcq-panel {
            background: white;
            border-left: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .mcq-header {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8fafc;
        }

        .mcq-content {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .question-card {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 1rem;
            animation: fadeIn 0.3s ease-out;
        }

        .question-text {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
            line-height: 1.4;
        }

        .options-grid {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .option-btn {
            text-align: left;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.9rem;
            color: var(--text-gray);
        }

        .option-btn:hover {
            background: var(--light-blue);
            border-color: var(--secondary-blue);
            color: var(--primary-blue);
        }

        .option-btn.correct {
            background-color: #dcfce7 !important;
            border-color: var(--success) !important;
            color: #15803d !important;
        }

        .option-btn.wrong {
            background-color: #fee2e2 !important;
            border-color: var(--danger) !important;
            color: #991b1b !important;
        }

        .btn {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.2s;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .btn:disabled {
            background: var(--text-gray);
            cursor: not-allowed;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Hide Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body>

    <header>
        <h1><i class="fa-solid fa-brain"></i> Mock Test Arena</h1>
        <div class="header-controls">
            <div class="score-display">
                <i class="fa-solid fa-star"></i> Score: <span id="currentScore">0</span>
            </div>
            <a href="index.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> Exit</a>
        </div>
    </header>

    <div class="workspace">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <i class="fa-solid fa-folder-open"></i> Available Materials
            </div>
            <div class="file-list" id="fileList">
                <!-- Items populated via JS -->
                <div style="padding: 1rem; text-align: center; color: var(--text-gray);">Loading...</div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="content-area">
            <!-- PDF Viewer -->
            <div class="pdf-container" id="pdfContainer">
                <div class="empty-state" id="emptyState">
                    <i class="fa-regular fa-file-pdf" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <p>Select a topic from the sidebar to start.</p>
                </div>
                <iframe id="pdfFrame" src="" style="display: none;"></iframe>
            </div>

            <!-- MCQ Panel -->
            <div class="mcq-panel">
                <div class="mcq-header">
                    <h3><i class="fa-solid fa-clipboard-question"></i> Questions</h3>
                    <button id="startTestBtn" class="btn" disabled>
                        Start Test
                    </button>
                    <button id="restartTestBtn" class="btn btn-outline" style="background:transparent; border:1px solid #ccc; color:#666; display:none;">
                        <i class="fa-solid fa-rotate-right"></i>
                    </button>
                </div>
                <div class="mcq-content" id="mcqContent">
                    <div style="text-align: center; color: var(--text-gray); margin-top: 2rem;">
                        Select a document and click "Start Test" to generate questions.
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // State
        let score = 0;
        let currentTopic = null;
        
        // Mock Questions Database (Simulation)
        // In a real app, this would come from an AI API analyzing the specific PDF
        const mockQuestionBank = [
            {
                q: "What is the primary function of this module?",
                options: ["Data Storage", "Processing Logic", "User Interface", "Network Security"],
                ans: 1 // Index of correct answer
            },
            {
                q: "Which concept is NOT discussed in this section?",
                options: ["Polymorphism", "Inheritance", "Quantum Entanglement", "Encapsulation"],
                ans: 2
            },
            {
                q: "Determine the time complexity of the algorithm mentioned.",
                options: ["O(1)", "O(n)", "O(log n)", "O(n^2)"],
                ans: 1
            },
            {
                q: "True or False: The system requires active internet connection.",
                options: ["True", "False"],
                ans: 0
            },
            {
                q: "Identify the missing component in the diagram.",
                options: ["Controller", "View", "Model", "Database"],
                ans: 0
            }
        ];

        // Access DOM
        const fileList = document.getElementById('fileList');
        const pdfFrame = document.getElementById('pdfFrame');
        const emptyState = document.getElementById('emptyState');
        const mcqContent = document.getElementById('mcqContent');
        const currentScoreEl = document.getElementById('currentScore');
        const startTestBtn = document.getElementById('startTestBtn');
        const restartTestBtn = document.getElementById('restartTestBtn');

        // Init
        document.addEventListener('DOMContentLoaded', loadFiles);

        // Load Files from API
        async function loadFiles() {
            try {
                const response = await fetch('api.php?action=get_schedule');
                const data = await response.json();
                
                fileList.innerHTML = '';
                if (data.length === 0) {
                    fileList.innerHTML = '<div style="padding: 1rem; text-align: center; color: var(--text-gray);">No files uploaded in Schedule.</div>';
                    return;
                }

                data.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'file-item';
                    div.innerHTML = `
                        <i class="fa-regular fa-file-pdf"></i>
                        <div class="file-info">
                            <span class="file-subject">${item.subject}</span>
                            <span class="file-name">${item.topic_name}</span>
                        </div>
                    `;
                    div.onclick = () => selectFile(item, div);
                    fileList.appendChild(div);
                });

            } catch (error) {
                console.error("Error loading files:", error);
                fileList.innerHTML = '<div style="color:red; padding:1rem;">Error loading files.</div>';
            }
        }

        // Select File
        function selectFile(item, element) {
            // UI Highlight
            document.querySelectorAll('.file-item').forEach(el => el.classList.remove('active'));
            element.classList.add('active');

            // Set State
            currentTopic = item;
            
            // Load PDF
            if (item.file_path) {
                pdfFrame.src = item.file_path + "#view=FitH";
                pdfFrame.style.display = 'block';
                emptyState.style.display = 'none';
                startTestBtn.disabled = false;
            } else {
                alert("File path missing for this item.");
            }

            // Reset Test
            resetTestUI();
        }

        function resetTestUI() {
            mcqContent.innerHTML = `
                <div style="text-align: center; color: var(--text-gray); margin-top: 2rem;">
                    Ready? Click "Start Test" to begin.
                </div>
            `;
            startTestBtn.style.display = 'inline-block';
            restartTestBtn.style.display = 'none';
        }

        // Start Test Logic
        startTestBtn.addEventListener('click', () => {
            startTestBtn.style.display = 'none';
            restartTestBtn.style.display = 'inline-block';
            generateQuestions();
        });

        restartTestBtn.addEventListener('click', () => {
             if(confirm("Restart test? Score will reset.")) {
                 score = 0;
                 updateScore(0);
                 generateQuestions();
             }
        });

        function generateQuestions() {
            mcqContent.innerHTML = '';
            
            // Randomize questions for "Simulation" effect
            const questions = [...mockQuestionBank].sort(() => 0.5 - Math.random()).slice(0, 3);

            questions.forEach((qObj, index) => {
                const card = document.createElement('div');
                card.className = 'question-card';
                
                let optionsInfo = '';
                qObj.options.forEach((opt, optIndex) => {
                    optionsInfo += `<div class="option-btn" onclick="checkAnswer(this, ${optIndex === qObj.ans})">${opt}</div>`;
                });

                card.innerHTML = `
                    <div class="question-text">Q${index + 1}: ${qObj.q}</div>
                    <div class="options-grid">
                        ${optionsInfo}
                    </div>
                `;
                mcqContent.appendChild(card);
            });
        }

        // Scoring Logic
        window.checkAnswer = function(element, isCorrect) {
            // Prevent re-answering
            const parent = element.parentElement;
            if (parent.querySelector('.correct') || parent.querySelector('.wrong')) return;

            if (isCorrect) {
                element.classList.add('correct');
                score++;
                // Animation/Feedback could go here
            } else {
                element.classList.add('wrong');
                score--;
                
                // Highlight correct one? Maybe not for "Hard mode", but helpful for learning
                // Let's highlight correct answer
                 /* 
                 const buttons = parent.querySelectorAll('.option-btn');
                 // We don't have reference to index here easily without passing it, 
                 // but for simulation simple red/green is enough.
                 */
            }
            updateScore(score);
        };

        function updateScore(newScore) {
            currentScoreEl.innerText = newScore;
            // Visual feedback
            const display = document.querySelector('.score-display');
            display.style.transform = 'scale(1.1)';
            setTimeout(() => display.style.transform = 'scale(1)', 200);
        }

    </script>
</body>
</html>
