<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/appoi.css">



    <style>
        /* Style for days with appointments */
.appointment-day {
    background-color: rgba(208, 17, 17, 0.1);
    color: red;
    font-weight: bold;
}
    </style>

    <title>Suwa-Connect</title>
</head>

<body>
    <?php include  "navbar-patient.php";?>

    <div class="main-content">
        <header>
            <h1>Good Morning, !</h1>
        </header>
        

        <div class="tabs">
            <button class="tab-link active" onclick="showTab('upcoming')">Doctor appointments</button>
            <!-- <button class="tab-link" onclick="showTab('past')">Lab appointments</button> -->
            
            <button class="schedule-btn" onclick="window.location.href='<?php echo URLROOT;?>patientcontroller/searchDoctorToMakeAppointment'">Schedule an Appointment</button>
        </div>
          <div class="content-container">
    <div class="appointments">
        <div id="upcoming" class="tab-content active">
            <?php if (isset($data['appointments']) && !empty($data['appointments'])): ?>
                <?php foreach ($data['appointments'] as $appointment): ?>
                    <div class="appointment-card">
                        <div class='appointment-details'><p class="appdate"><strong> <?= ($appointment->appointment_date) ?></strong></p>
                            <p class="apptime">booked on:<strong> <?= ($appointment->created_at) ?></strong></p>
                            <p class="doctorname"><strong>Dr. <?= $appointment->doctor_first_name . ' ' . $appointment->doctor_last_name ?></strong></p>
                            <p class ="appointment-details"><?php echo $appointment->specialization ?></p>
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
<script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
<script src="<?php echo URLROOT?>assets/js/appoi.js"></script>
<script>
    // Add this before including your appoi.js file
    var appointmentDates = [
        <?php foreach ($data['appointments'] as $appointment): ?>
            "<?= date('Y-m-d', strtotime($appointment->appointment_date)) ?>",
        <?php endforeach; ?>
    ];
</script>
<script src="<?php echo URLROOT?>assets/js/appoi.js"></script>



</body>

</html>

<!-- Add this right after the header -->

