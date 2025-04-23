<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo URLROOT ?>public/assets/css/lab/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>public/assets/css/lab/dashboard.css">

    <title>Suwa-Connect</title>
</head>

<body>
    <div class="page-wrapper">
        <?php include "labNavbar.php"; ?>

        <div class="content-area">
            <div class="main-content">
                <header>
                    <h1>Welcome to Laboratory Dashboard <?php echo $_SESSION['user_name']; ?></h1>
                    <p>Welcome Back! Here's an overview of your platform's latest activities and performance.</p><br>
                </header>

                <div class="grid-container">
                    <!-- Left Column -->
                    <div class="left-column">
                        <!-- Left Column Cards -->
                        <div class="card">
                            <h3>Today's Summary</h3>
                            <p>Total Tests Today: <?= $data['totalTestsToday'] ?? 'Not Available' ?></p>
                        </div>
                        <div class="card">
                            <h3>Tests In Progress</h3>
                            <p><?= $data['testsInProgress'] ?? '0' ?></p>
                        </div>
                        <div class="bottom-left-cards">
                            <div class="card">
                                <h3>Completed Tests</h3>
                                <p><?= $data['completedTests'] ?? '0' ?></p>
                            </div>
                            <div class="card">
                                <h3>Average Turnaround Time</h3>
                                <p><?= $data['avgTurnaroundTime'] ?? 'N/A' ?> minutes</p>
                            </div>
                        </div>
                        <div class="card notifications-card">
                            <h3>Notifications</h3>
                            <div class="notifications">
                                <dl>
                                     <?php 
                                        $notificationsCount = 0; // Counter for the notifications
                                        // Loop through the notifications and display only the first 5
                                        foreach ($notifications as $notification): 
                                            if ($notificationsCount >= 3) break; // Stop after 5 notifications
                                            $notificationsCount++;
                                            ?>
                                            <dt><div class="notification"><?= $notification ?></dt>
                                            <?php endforeach; ?>
                                </dl>
                             </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="right-column">
                        <!-- Bottom Right Column -->
                        <div class="bottom-right-cards">
                            <div class="card">
                                <h3>Upcoming Appointments</h3>
                                <dl>
                                <div class="appointments">
                                    <?php foreach ($data['upcomingAppointments'] as $appt): ?>
                                        <div class="appointment">
                                            <div class="name"><dt><?= $appt->patient_name ?></dt></div>
                                            <div class="date"><dd><?= $appt->date ?></dd></div>
                                            <div class="time"><dd><?= $appt->time ?></dd></div>
                                         </div>
                                    <?php endforeach; ?>
                                </div>
                                </dl>
                                
                            </div>

                            <div class="card calendar">
                                <div class="calendar-header">
                                    <button onclick="changeMonth(-1)">&#8249;</button>
                                    <span id="month-year"></span>
                                    <button onclick="changeMonth(1)">&#8250;</button>
                                </div>

                                <div class="calendar-days">
                                    <div class="calendar-day">Sun</div>
                                    <div class="calendar-day">Mon</div>
                                    <div class="calendar-day">Tue</div>
                                    <div class="calendar-day">Wed</div>
                                    <div class="calendar-day">Thu</div>
                                    <div class="calendar-day">Fri</div>
                                    <div class="calendar-day">Sat</div>
                                </div>

                                <div class="calendar-dates" id="calendar-dates"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer>
                    <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
                </footer>
            </div>
        </div>

        <script src="<?php echo URLROOT ?>public/assets/js/doctor/navbar.js"></script>
        <script src="<?php echo URLROOT ?>public/assets/js/lab/dashboard.js"></script>
    </div>
</body>

</html>
