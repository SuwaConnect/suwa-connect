<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        
        
        <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/noti.css">

        <title>Suwa-Connect</title>
    </head>

    <body> 

    <?php include  "navbar-patient.php";?>

    <div class="main-container">
        <h1>Notifications</h1>
        <div class="notifications-section">
        <div class="notification-card">
                <h2 class="notification-title">Appointment Reminder</h2>
                <p class="notification-message">
                    You have an appointment scheduled with Dr. John Smith on 2024-12-01 at 10:00 AM.
                </p>
                <span class="notification-timestamp">Received: 2024-11-26</span>
            </div>
            <div class="notification-card">
                <h2 class="notification-title">Lab Report Ready</h2>
                <p class="notification-message">
                    Your blood test report is now available. Please log in to view your report.
                </p>
                <span class="notification-timestamp">Received: 2024-11-25</span>
            </div>
            <div class="notification-card">
                <h2 class="notification-title">New Health Tip</h2>
                <p class="notification-message">
                    Stay hydrated! Drink at least 8 glasses of water daily to maintain good health.
                </p>
                <span class="notification-timestamp">Received: 2024-11-24</span>
            </div>
            <div class="notification-card">
                <h2 class="notification-title">Vaccination Update</h2>
                <p class="notification-message">
                    Your next vaccination is due on 2024-12-05. Please schedule an appointment.
                </p>
                <span class="notification-timestamp">Received: 2024-11-23</span>
            </div>
            <div class="notification-card">
                <h2 class="notification-title">Prescription Refill</h2>
                <p class="notification-message">
                    Your prescription for medication is due for a refill. Visit your pharmacy soon.
                </p>
                <span class="notification-timestamp">Received: 2024-11-22</span>
            </div>
            <div class="notification-card">
                <h2 class="notification-title">Annual Checkup</h2>
                <p class="notification-message">
                    It’s time for your annual checkup. Book an appointment with your primary doctor.
                </p>
                <span class="notification-timestamp">Received: 2024-11-21</span>
            </div>
            <div class="notification-card">
                <h2 class="notification-title">Upcoming Event</h2>
                <p class="notification-message">
                    Join us for the Health Awareness Seminar on 2024-12-10 at 2:00 PM.
                </p>
                <span class="notification-timestamp">Received: 2024-11-20</span>
            </div>
        </div>
    </div>  
        
        <script src="assets/js/navbartwo.js"></script>
        <script src="assets/js/appoimt.js"></script>
    </body>

    </html>

    