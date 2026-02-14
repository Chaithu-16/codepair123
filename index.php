<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Progress Dashboard</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="background-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <div class="main-container">
        <!-- Sidebar / Navigation -->
        <nav class="glass-sidebar">
            <div class="logo">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>EduDash</span>
            </div>
            <ul class="nav-links">
                <li class="active"><a href="./index.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li><a href="./schedule.php"><i class="fa-solid fa-calendar-check"></i> Schedule</a></li>
                <li><a href="./mocktest.php"><i class="fa-solid fa-book-open"></i> Mock Test</a></li>
                <li><a href="#"><i class="fa-solid fa-gear"></i> Settings</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="dashboard-content">
            <header class="glass-header">
                <div class="greeting">
                    <h1>Welcome back, <span class="highlight">Student</span>! 🚀</h1>
                    <p>Track your progress and crush your goals.</p>
                </div>
                <div class="add-entry-btn">
                    <button id="openModalBtn" class="btn-primary"><i class="fa-solid fa-plus"></i> Add Progress</button>
                </div>
            </header>

            <!-- Stats Cards -->
            <section class="stats-grid">
                <div class="glass-card stat-card" id="hours-card">
                    <div class="icon-box hours-icon">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Study Hours</h3>
                        <p class="stat-value" id="totalHoursDisplay">0</p>
                        <span class="stat-subtitle">Min this week</span>
                    </div>
                </div>

                <div class="glass-card stat-card" id="topics-card">
                    <div class="icon-box topics-icon">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Topics Completed</h3>
                        <p class="stat-value" id="topicsHelperDisplay">0</p>
                        <span class="stat-subtitle">Topics mastered</span>
                    </div>
                </div>

                <div class="glass-card stat-card" id="score-card">
                    <div class="icon-box score-icon">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Avg Mock Score</h3>
                        <p class="stat-value" id="avgScoreDisplay">0%</p>
                        <span class="stat-subtitle">Across all tests</span>
                    </div>
                </div>
            </section>

            <!-- Charts Section -->
            <section class="charts-grid">
                <div class="glass-card chart-container">
                    <h3><i class="fa-solid fa-chart-area"></i> Weekly Study Activity</h3>
                    <canvas id="studyHoursChart"></canvas>
                </div>
                <div class="glass-card chart-container">
                    <h3><i class="fa-solid fa-chart-bar"></i> Mock Test Performance</h3>
                    <canvas id="scoresChart"></canvas>
                </div>
            </section>

            <!-- Bottom Section: Circular Progress + Recent Activity (Optional filler) -->
            <section class="bottom-grid">
                <div class="glass-card progress-ring-container">
                    <h3>Skill Growth Meter</h3>
                    <div class="circular-progress">
                        <div class="value-container" id="skillGrowthValue">0%</div>
                    </div>
                    <p class="encouragement">Keep pushing! You're doing great.</p>
                </div>

                <!-- Simple Input Form (Initially hidden, or side panel. Using Modal instead for cleaner UI) -->
            </section>
        </main>
    </div>

    <!-- Modal for Input -->
    <div id="entryModal" class="modal">
        <div class="modal-content glass-card">
            <span class="close-btn">&times;</span>
            <h2>Update Progress</h2>
            <form id="progressForm">
                <div class="form-group">
                    <label for="studyHoursInput">Study Hours (Today)</label>
                    <input type="number" id="studyHoursInput" step="0.5" placeholder="e.g., 2.5" required>
                </div>
                <div class="form-group">
                    <label for="topicsInput">Topics Completed (Count)</label>
                    <input type="number" id="topicsInput" placeholder="e.g., 3" required>
                </div>
                <div class="form-group">
                    <label for="mockScoreInput">Mock Test Score (%) - Optional</label>
                    <input type="number" id="mockScoreInput" min="0" max="100" placeholder="e.g., 85">
                </div>
                <!-- Hidden date input if we want to get fancy with specific dates, defaulting to 'today' logic in JS -->
                <button type="submit" class="btn-primary">Save Progress</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>