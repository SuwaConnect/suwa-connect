<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/setting.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/admin/dashboard.css">


    <title>Suwa-Connect</title>
</head>

<body>
    <!-- <div class="sidebar">
        <div class="logo">
            <img src="./Images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
            <h2>සුව CONNECT</h2>

            <button class="toggle-btn" id="toggleSidebar"> 
                <i class="material-icons-round">chevron_left</i>
            </button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="home.html" class="nav-link">
                    <i class="material-icons-round">home</i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="userManagement.html" class="nav-link">
                    <i class="material-icons-round">group</i> <span>User Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="appointments.html" class="nav-link">
                    <i class="material-icons-round">medical_services</i> <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="revenue.html" class="nav-link">
                    <i class="material-icons-round">paid</i> <span>Revenue</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="reports.html" class="nav-link">
                    <i class="material-icons-round">trending_up</i> <span>Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="notifications.html" class="nav-link">
                    <i class="material-icons-round">notifications</i> <span>Notifications</span>
                </a>
            </li>
            <li class="nav-item active">
                <a href="settings.html" class="nav-link">
                    <i class="material-icons-round">settings</i> <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="support.html" class="nav-link">
                    <i class="material-icons-round">contact_support</i> <span>Support</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <button class="btn-user">Login as User</button>
        </div>
    </div> -->

    <?php include 'adminNavbar.php'?>

    <div class="main-content">

    <header>
            <h1>System Settings</h1>
            <p>Manage system-wide configurations, user preferences, and platform settings.</p>
    </header>
    
        <section class="settings-section" id="general-settings">
            <h2>General Settings</h2>
            <div class="setting-item">
                <label>Platform Name:</label>
                <input type="text" value="Suwa Connect" disabled>
            </div>
            <div class="setting-item">
                <label>Platform Version:</label>
                <input type="text" value="v1.0.3" disabled>
            </div>
            <div class="setting-item">
                <label>Timezone:</label>
                <select id="timezone">
                    <option value="utc5-30">UTC+5:30 - Sri Lanka Standard Time</option>
                    <option value="utc0">UTC+0 - Coordinated Universal Time</option>
                </select>
            </div>
            <div class="setting-item">
                <label>Date Format:</label>
                <select id="date-format">
                    <option value="dd-mm-yyyy">DD/MM/YYYY</option>
                    <option value="mm-dd-yyyy">MM/DD/YYYY</option>
                </select>
            </div>
            <div class="setting-item">
                <label>Time Format:</label>
                <select id="time-format">
                    <option value="24hr">24-hour</option>
                    <option value="12hr">12-hour</option>
                </select>
            </div>
            <div class="setting-item">
                <label>Platform Language:</label>
                <select id="language">
                    <option value="english">English</option>
                    <option value="sinhala">Sinhala</option>
                    <option value="tamil">Tamil</option>
                </select>
            </div>
        </section>
    
        <section class="settings-section" id="user-management-settings">
            <h2>User Management Settings</h2>
            <div class="setting-item">
                <label>Enable New Registrations:</label>
                <input type="checkbox" id="new-registrations" checked>
            </div>
            <div class="setting-item">
                <label>Require Account Verification:</label>
                <input type="checkbox" id="account-verification" checked>
            </div>
            <div class="setting-item">
                <label>Password Policy:</label>
                <input type="text" id="password-policy" placeholder="Minimum 8 characters, 1 special character">
            </div>
        </section>
    
        <section class="settings-section" id="notifications-settings">
            <h2>Notifications & Alerts</h2>
            <div class="setting-item">
                <label>Email Notifications:</label>
                <input type="checkbox" id="email-notifications" checked>
            </div>
            <div class="setting-item">
                <label>SMS Notifications:</label>
                <input type="checkbox" id="sms-notifications">
            </div>
            <div class="setting-item">
                <label>In-App Alerts:</label>
                <input type="checkbox" id="in-app-alerts" checked>
            </div>
            <div class="setting-item">
                <label>Push Notifications:</label>
                <input type="checkbox" id="push-notifications">
            </div>
        </section>
    
        <section class="settings-section" id="security-settings">
            <h2>Security Settings</h2>
            <div class="setting-item">
                <label>Data Encryption:</label>
                <input type="checkbox" id="data-encryption" checked>
            </div>
            <div class="setting-item">
                <label>Two-Factor Authentication (2FA):</label>
                <input type="checkbox" id="two-factor-auth" checked>
            </div>
            <div class="setting-item">
                <label>Password Reset Policies:</label>
                <input type="text" id="password-reset-policy" placeholder="Email Verification, Security Questions">
            </div>
        </section>
    
        <section class="settings-section" id="billing-settings">
            <h2>Payments & Billing</h2>
            <div class="setting-item">
                <label>Payment Gateway:</label>
                <input type="text" value="Stripe" disabled>
            </div>
            <div class="setting-item">
                <label>Currency:</label>
                <select id="currency">
                    <option value="lkr">Sri Lankan Rupee - LKR</option>
                    <option value="usd">US Dollar - USD</option>
                </select>
            </div>
        </section>
    
        <div class = "buttons">
            <button id="save-settings">Save Changes</button>
            <button id="reset-settings">Reset to Defaults</button>
        </div>

         <!-- Footer Section -->
         <footer>
            <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
            <a href="#"></a>
        </footer>

    </div>
    
        <script src="./js/settings.js"></script>  
        <script src="<?php echo URLROOT?>public/assets/js/navbar.js"></script>
        </body>

</html>
