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

        <title>Suwa-Connect</title>
    </head>

    <body> 
        
    <?php include "labNavbar.php";?>


    <div class="main-container">
        <h1>Notifications</h1>
        <?php 
$notificationsCount = 0; // Counter for the notifications
// Loop through the notifications and display up to 15
foreach ($notifications as $notification): 
    if ($notificationsCount >= 15) break; // Stop after 15 notifications
    $notificationsCount++;
?>
<div class="notifications-section">
    <div class="notification-card">
        <h2 class="notification-title">Appointment Reminder</h2>
        <p class="notification-message">
            <?= $notification ?>
        </p>
        <span class="notification-timestamp">Received: <?= date('Y-m-d') ?></span>
    </div>
</div>
<?php endforeach; ?>


    </div>  
        
        <script src="<?php echo URLROOT;?>public/assets/js/navbartwo.js"></script>
        <script src="<?php echo URLROOT;?>public/assets/js/appoimt.js"></script>
    </body>

    </html>

    