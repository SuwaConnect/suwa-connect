<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        
        <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/setting.css">

        <title>Suwa-Connect</title>
    </head>

    <body> 

    <?php include  "navbar-patient.php";?>
    
    <div class="main-container">
        <h1>Settings</h1>
        <div class="settings-section">
            <div class="setting-card">
                <div class="setting-title">Notification Settings</div>
                <div class="setting-description">Manage your notification preferences below.</div>
                <div class="setting-option">
                    <label for="email-notifications">Email Notifications</label>
                    <input type="checkbox" id="email-notifications" name="email-notifications">
                </div>
            </div>

            <div class="setting-card">
                <div class="setting-title">Privacy Settings</div>
                <div class="setting-description">Control your data privacy settings.</div>
                <div class="setting-option">
                    <label for="share-data">Share Data with Third Parties</label>
                    <input type="checkbox" id="share-data" name="share-data">
                </div>
        
            </div>

            <div class="setting-card">
                <div class="setting-title">Account Settings</div>
                <div class="setting-item change-password">
                <span>Change Password</span>
                <button class="popup-trigger">></button>
            </div>
                
            </div>

            <button class="setting-button">Save Settings</button>
        </div>
    </div>

    <div id="change-password-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h2>Change Password</h2>
            <form>
                <label for="current-password">Current Password</label>
                <input type="password" id="current-password" required>

                <label for="new-password">New Password</label>
                <input type="password" id="new-password" required>

                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" required>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>

    <script src="<?php echo URLROOT?>public/assets/js/navbartwo.js"></script>
    <script src="<?php echo URLROOT?>public/assets/js/setting.js"></script>

    </body>

    </html>

   