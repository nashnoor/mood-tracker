<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Tracker Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <h1>Mood Tracker Dashboard</h1>
    </header>

    <main>
        <div class="grid-container">
            <!-- Charts -->
            <div class="grid-item chart-container">
                <h2>Mood Chart</h2>
                <canvas id="moodChart"></canvas>
            </div>

            <div class="grid-item chart-container">
                <h2>Medication Chart</h2>
                <canvas id="medicationChart"></canvas>
            </div>

            <div class="grid-item chart-container">
                <h2>Sleep Chart</h2>
                <canvas id="sleepChart"></canvas>
            </div>

            <div class="grid-item chart-container">
                <h2>Journal Entries</h2>
                <canvas id="journalChart"></canvas>
            </div>

            <!-- Forms -->
            <div class="grid-item form-container">
                <form action="insert.php" method="post">
                    <h2>Track Mood</h2>
                    <input type="hidden" name="type" value="mood">
                    <label for="mood">Mood:</label>
                    <input type="text" id="mood" name="mood" required>
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                    <input type="submit" value="Submit">
                </form>
            </div>

            <div class="grid-item form-container">
                <form action="insert.php" method="post">
                    <h2>Track Medication</h2>
                    <input type="hidden" name="type" value="medication">
                    <label for="medication_name">Medication Name:</label>
                    <input type="text" id="medication_name" name="medication_name" required>
                    <label for="dosage">Dosage:</label>
                    <input type="text" id="dosage" name="dosage" required>
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                    <input type="submit" value="Submit">
                </form>
            </div>

            <div class="grid-item form-container">
                <form action="insert.php" method="post">
                    <h2>Track Sleep</h2>
                    <input type="hidden" name="type" value="sleep">
                    <label for="hours_slept">Hours Slept:</label>
                    <input type="number" id="hours_slept" name="hours_slept" step="0.1" required>
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                    <input type="submit" value="Submit">
                </form>
            </div>

            <div class="grid-item form-container">
                <form action="insert.php" method="post">
                    <h2>Track Journal Entry</h2>
                    <input type="hidden" name="type" value="journal">
                    <label for="entry">Journal Entry:</label>
                    <textarea id="entry" name="entry" rows="4" required></textarea>
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </main>

    <script>
        async function fetchData() {
            const response = await fetch('fetch_data.php');
            return response.json();
        }

        function createChart(ctx, labels, data, label) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', async () => {
            const data = await fetchData();

            // Mood Chart
            const moodDates = data.moods.map(entry => entry.date);
            const moodValues = data.moods.map(entry => entry.mood);
            createChart(document.getElementById('moodChart').getContext('2d'), moodDates, moodValues, 'Mood');

            // Medication Chart
            const medicationDates = data.medications.map(entry => entry.date);
            const medicationNames = data.medications.map(entry => entry.medication_name);
            createChart(document.getElementById('medicationChart').getContext('2d'), medicationDates, medicationNames, 'Medications');

            // Sleep Chart
            const sleepDates = data.sleep.map(entry => entry.date);
            const sleepValues = data.sleep.map(entry => entry.hours_slept);
            createChart(document.getElementById('sleepChart').getContext('2d'), sleepDates, sleepValues, 'Hours Slept');

            // Journal Chart
            const journalDates = data.journals.map(entry => entry.date);
            const journalEntries = data.journals.map(entry => entry.entry.length); // Use length of entry as a placeholder
            createChart(document.getElementById('journalChart').getContext('2d'), journalDates, journalEntries, 'Journal Entries');
        });
    </script>
</body>
</html>
