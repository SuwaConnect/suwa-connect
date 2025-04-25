<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/lab/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/lab/labReports.css">

    <title>Suwa-Connect</title>
</head>

<body>
<?php include "labNavbar.php";?>
    <div class="container">
        <h1 class="page-title">Lab Reports</h1>

        <!-- Search Bar -->
        <input type="text" id="searchInput" placeholder="Search tests or patient..." class="search-bar" onkeyup="filterCards()">

        <!-- Lab Reports Table -->
        <div class="table-container">
            <table class="tests-table">
                <thead>
                    <tr>
                        <th>🧪 Test Name</th>
                        <th>👤 Patient Name</th>
                        <th>📅 Test Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['tests'] as $test): ?>
                        <tr>
                            <td><?= htmlspecialchars($test->test_name) ?></td>
                            <td><?= htmlspecialchars($test->first_name ?? 'Patient ID: ' . $test->first_name) ?></td>
                            <td><?= htmlspecialchars($test->test_date) ?></td>
                            <td>
                                <span class="status <?= strtolower($test->status) ?>">
                                    <?= htmlspecialchars($test->status ?? 'N/A') ?>
                                </span>
                            </td>
                            <td class="actions">
                                <?php if (!empty($test->report_path)): ?>
                                    <a href="<?= URLROOT ?>/lab/viewReport/<?= $test->test_id ?>" class="btn view">View Report</a>
                                <?php else: ?>
                                    <a href="<?php echo URLROOT ?>labController/labform" class="btn create">Create Report</a>
                                <?php endif; ?>

                                <?php if ($test->status === 'Scheduled'): ?>
                                    <a href="<?= URLROOT ?>/lab/reschedule/<?= $test->test_id ?>" class="btn reschedule">Reschedule</a>
                                <?php endif; ?>

                                <?php if ($test->status === 'In Progress' || $test->status === 'Scheduled'): ?>
                                    <a href="<?= URLROOT ?>/lab/cancelTest/<?= $test->test_id ?>" class="btn cancel">Cancel Test</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <footer>
            <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
            <a href="#"></a>
        </footer>
    </div>
    

    <!-- JavaScript -->
    <script>
        function filterCards() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const rows = document.querySelectorAll(".tests-table tbody tr");

            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(input) ? "" : "none";
            });
        }
    </script>
    <script src="<?php echo URLROOT;?>public/assets/js/doctor/navbar.js"></script>
    <script src="<?php echo URLROOT; ?>public/assets/js/lab/labReports.js"></script>
    </body>
    </html>
