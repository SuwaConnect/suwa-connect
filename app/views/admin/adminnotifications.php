<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/navbartwo.css">
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/noti.css">

    <title>Suwa-Connect | Admin Notifications</title>
</head>

<body> 
    <?php include "adminNavbar.php";?>

    <div class="main-content">
        <h1>Admin Notifications</h1>
        
        <?php 
        $notificationsCount = 0; // Counter for the notifications
        // Loop through the notifications and display up to 15
        foreach ($notifications as $notification): 
            if ($notificationsCount >= 15) break; // Stop after 15 notifications
            $notificationsCount++;

            // Assuming 'message' is the correct property of the notification object
            $notificationMessage = $notification->message; // Adjust this based on your actual property name
        ?>
        <div class="notifications-section">
            <div class="notification-card">
                <h2 class="notification-title">Appointment Reminder</h2>
                <p class="notification-message">
                    <?= htmlspecialchars($notificationMessage) ?>  <!-- Using htmlspecialchars on the string value -->
                </p>
                <span class="notification-timestamp">Received: <?= date('Y-m-d') ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <script src="<?php echo URLROOT;?>public/assets/js/appoimt.js"></script>
    <script src="<?php echo URLROOT ?>public/assets/js/doctor/navbar.js"></script>

</body>

</html>
