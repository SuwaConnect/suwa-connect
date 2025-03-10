<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/navbartwo.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/appoi.css">

    <title>Suwa-Connect</title>
</head>

<body>
    <?php include  "navbar-patient.php";?>

    <div class="main-content">
        <header>
            <h1>Good Morning, !</h1>
        </header>
        <div class="messages">
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success_message']; ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error_message']; ?>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>
</div>

        <div class="tabs">
            <button class="tab-link active" onclick="showTab('upcoming')">Upcoming</button>
            
            <button class="schedule-btn" onclick="window.location.href='<?php echo URLROOT;?>patientcontroller/searchDoctorToMakeAppointment'">Schedule an Appointment</button>
        </div>
          <div class="content-container">
    <div class="appointments">
        <div id="upcoming" class="tab-content active">
            <?php if (isset($data['appointments']) && !empty($data['appointments'])): ?>
                <?php foreach ($data['appointments'] as $appointment): ?>
                    <div class="appointment-card">
                        <div class='appointment-details'><p class="appdate"><strong> <?= date('F j, Y', strtotime($appointment->appointment_date)) ?></strong></p>
                            <p class="apptime"><strong> <?= date('g:i A', strtotime($appointment->appointment_time)) ?></strong></p>
                            <p class="doctorname"><strong>Dr. <?= $appointment->doctor_first_name . ' ' . $appointment->doctor_last_name ?></strong></p>
                            <p class="reason"><strong>Reason: <?= $appointment->reason ?></strong></p>
                        </div>
                        <div class="appointment-actions">
                            <button class="btn change-btn" onclick="window.location.href='/changeApp/index/<?=$appointment->appointment_id?>'">Change</button>
                            <button class="btn cancel-btn" onclick="if(confirm('Are you sure you want to cancel this appointment?')) window.location.href='/delApp/index/<?= $appointment->appointment_id ?>'">Cancel</button>
                        </div>
                </div>
  
                <?php endforeach; ?>
            <?php else: ?>
                <p>No appointments found.</p>
            <?php endif; ?>
        </div>

        <!-- Calendar Container -->
    </div>
    <div class="calendar-container">
                <div class="calendar-header">
                    <button id="prevYear" class="nav-button">«</button>
                    <button id="prevMonth" class="nav-button">‹</button>
                    <span id="currentDate" class="current-date"></span>
                    <button id="nextMonth" class="nav-button">›</button>
                    <button id="nextYear" class="nav-button">»</button>
                </div>
                <div class="calendar-grid">
                    <div class="day-name">Sun</div>
                    <div class="day-name">Mon</div>
                    <div class="day-name">Tue</div>
                    <div class="day-name">Wed</div>
                    <div class="day-name">Thu</div>
                    <div class="day-name">Fri</div>
                    <div class="day-name">Sat</div>
                    <div id="calendarDays" class="calendar-days"></div>
                </div>  
                </div>
        </div>
</div>
    <script src="<?php echo URLROOT?>assets/js/navbartwo.js"></script>
    <script src="<?php echo URLROOT?>assets/js/appoi.js"></script>
</body>

</html>

<!-- Add this right after the header -->
<div class="messages">
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success_message']; ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error_message']; ?>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>
</div>
