// Data State
let studyData = {
    weeklyHours: [2, 3.5, 4, 1.5, 5, 3, 4.5], // Default dummy data (Mon-Sun)
    topicsCompleted: 12,
    mockScores: [75, 82, 88, 79, 91], // Default dummy scores
    totalHours: 23.5
};

// Initialization
document.addEventListener('DOMContentLoaded', () => {
    loadData();
    initCharts();
    updateDashboard();
    initModal();
});

// Chart Instances
let hoursChartInstance;
let scoresChartInstance;

// Load Data from LocalStorage
function loadData() {
    const storedData = localStorage.getItem('eduDashData');
    if (storedData) {
        studyData = JSON.parse(storedData);
    }
}

// Save Data to LocalStorage
function saveData() {
    localStorage.setItem('eduDashData', JSON.stringify(studyData));
}

// Initialize Charts
function initCharts() {
    // 1. Line Chart: Weekly Study Activity
    const ctxHours = document.getElementById('studyHoursChart').getContext('2d');
    hoursChartInstance = new Chart(ctxHours, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Hours Studied',
                data: studyData.weeklyHours,
                borderColor: '#00d4ff',
                backgroundColor: 'rgba(0, 212, 255, 0.2)',
                borderWidth: 3,
                tension: 0.4,
                pointBackgroundColor: '#ffffff',
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { labels: { color: 'white' } }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: 'rgba(255,255,255,0.7)' },
                    grid: { color: 'rgba(255,255,255,0.1)' }
                },
                x: {
                    ticks: { color: 'rgba(255,255,255,0.7)' },
                    grid: { color: 'transparent' }
                }
            }
        }
    });

    // 2. Bar Chart: Mock Test Scores
    const ctxScores = document.getElementById('scoresChart').getContext('2d');
    scoresChartInstance = new Chart(ctxScores, {
        type: 'bar',
        data: {
            labels: studyData.mockScores.map((_, i) => `Test ${i + 1}`),
            datasets: [{
                label: 'Score (%)',
                data: studyData.mockScores,
                backgroundColor: 'rgba(37, 117, 252, 0.6)',
                borderColor: '#2575fc',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { labels: { color: 'white' } }
            },
            scales: {
                y: {
                    max: 100,
                    beginAtZero: true,
                    ticks: { color: 'rgba(255,255,255,0.7)' },
                    grid: { color: 'rgba(255,255,255,0.1)' }
                },
                x: {
                    ticks: { color: 'rgba(255,255,255,0.7)' },
                    grid: { color: 'transparent' }
                }
            }
        }
    });
}

// Update Dashboard UI
function updateDashboard() {
    // Update Stats
    document.getElementById('totalHoursDisplay').innerText = studyData.totalHours.toFixed(1);
    document.getElementById('topicsHelperDisplay').innerText = studyData.topicsCompleted;

    const avgScore = studyData.mockScores.length > 0
        ? Math.round(studyData.mockScores.reduce((a, b) => a + b, 0) / studyData.mockScores.length)
        : 0;
    document.getElementById('avgScoreDisplay').innerText = `${avgScore}%`;

    // Update Circular Progress (Simple logic: based on avg score or arbitrary goal)
    // Let's make it reflect the Avg Score for now as "Skill Growth"
    const circle = document.querySelector('.circular-progress');
    const value = document.getElementById('skillGrowthValue');
    let progressValue = 0;
    const progressEndValue = avgScore;

    // Animate the circle
    if (progressEndValue > 0) {
        let speed = 20;
        let progress = setInterval(() => {
            progressValue++;
            value.textContent = `${progressValue}%`;
            circle.style.background = `conic-gradient(#00d4ff ${progressValue * 3.6}deg, rgba(255,255,255,0.1) 0deg)`;
            if (progressValue == progressEndValue) {
                clearInterval(progress);
            }
        }, speed);
    } else {
        value.textContent = `0%`;
        circle.style.background = `conic-gradient(#00d4ff 0deg, rgba(255,255,255,0.1) 0deg)`;
    }

    // Update Charts
    hoursChartInstance.data.datasets[0].data = studyData.weeklyHours;
    hoursChartInstance.update();

    scoresChartInstance.data.labels = studyData.mockScores.map((_, i) => `Test ${i + 1}`);
    scoresChartInstance.data.datasets[0].data = studyData.mockScores;
    scoresChartInstance.update();
}

// Modal Logic
function initModal() {
    const modal = document.getElementById('entryModal');
    const btn = document.getElementById('openModalBtn');
    const span = document.getElementsByClassName('close-btn')[0];
    const form = document.getElementById('progressForm');

    btn.onclick = () => {
        modal.style.display = "flex";
    }

    span.onclick = () => {
        modal.style.display = "none";
    }

    window.onclick = (event) => {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    form.onsubmit = (e) => {
        e.preventDefault();

        // Get Values
        const hours = parseFloat(document.getElementById('studyHoursInput').value);
        const topics = parseInt(document.getElementById('topicsInput').value);
        const score = document.getElementById('mockScoreInput').value;

        // Update Data Model
        // 1. Update Total hours
        studyData.totalHours += hours;

        // 2. Update Weekly Hours (Pop oldest, push new) - Simple rotation
        // For a real app, we'd map this to actual days. Here we just rotate the array.
        studyData.weeklyHours.shift();
        studyData.weeklyHours.push(hours);

        // 3. Update Topics
        studyData.topicsCompleted += topics;

        // 4. Update Scores
        if (score) {
            studyData.mockScores.push(parseInt(score));
        }

        // Save & Render
        saveData();
        updateDashboard();

        // Close & Reset
        modal.style.display = "none";
        form.reset();
    }
}
