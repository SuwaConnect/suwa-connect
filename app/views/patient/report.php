<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/report.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <title>Settings</title>
</head>

<body>

<?php include  "navbar-patient.php";?> 


    <div class="main-content">
        <!-- Header -->
        <header>
            <div class="user-info">
                <img src="" alt="User Profile" class="user-profile">
                <div class="user-details">
                    <h1>John Doe</h1>
                    <p>Patient ID: 12345</p>
                </div>
            </div>
            <div class="header-actions">
                <span id="current-date"></span>
            </div>
        </header>

        <!-- Filters Section -->
        <section class="filters">
            <h2>Filter Reports</h2>
            <div class="filter-options">
                <label>
                    Date Range:
                    <input type="date" id="start-date">   to    
                    <input type="date" id="end-date">
                </label>
                <label>
                    Report Type:
                    <select id="report-type">
                        <option value="all">All</option>
                        <option value="blood-test">Blood Test</option>
                        <option value="x-ray">X-Ray</option>
                        <option value="mri">MRI</option>
                    </select>
                </label>
                <button id="apply-filters">Apply Filters</button>
            </div>
            <!-- Request Scan Button -->
            <button id="request-scan" onclick="window.location.href='labschedule'">Request a Scan</button>
            <!-- Upload Report Button -->
            <button id="upload-report">Upload Report</button>
        </section>

        <!-- Reports List -->
        <section class="reports-list">
            <h2>Medical Reports</h2>
            <table>
                <thead>
                    <tr>
                        <th>Report Name</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="reports-table">
                    <!-- Content will be injected here -->
                </tbody>
            </table>
        </section>
    </div>

    
    <script src="<?php echo URLROOT?>public\js\doctor\js\navbar.js"></script>
    <script src="<?php echo URLROOT?>public/assets/js/report.js"></script>
</body>

</html>
