<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo URLROOT?>assets/css/admin/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>assets/css/admin/dashboard.css">

    <title>Suwa-Connect</title>
</head>

<body>
<div class="sidebar">
        <div class="logo">
            <img src="<?php echo URLROOT;?>public/assets/images/suwa-connect logo.png" alt="Suwa-Connect Logo">
            <h2>සුව CONNECT</h2>

            <button class="toggle-btn" id="toggleSidebar"> 
                <i class="material-icons-round">chevron_left</i>
            </button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item active">
                <a href="<?php echo URLROOT;?>admincontroller/home" class="nav-link">
                    <i class="material-icons-round">home</i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>admincontroller/pendingdoctors" class="nav-link">
                    <i class="material-icons-round">group</i> <span>User Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>admincontroller/appointments" class="nav-link">
                    <i class="material-icons-round">medical_services</i> <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>admincontroller/revenue" class="nav-link">
                    <i class="material-icons-round">paid</i> <span>Revenue</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>admincontroller/reports" class="nav-link">
                    <i class="material-icons-round">trending_up</i> <span>Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>admincontroller/notifications" class="nav-link">
                    <i class="material-icons-round">notifications</i> <span>Notifications</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>admincontroller/settings" class="nav-link">
                    <i class="material-icons-round">settings</i> <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>admincontroller/support" class="nav-link">
                    <i class="material-icons-round">contact_support</i> <span>Support</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>logincontroller/logout" class="nav-link">
                    <i class="material-icons-round">logout</i> <span>Log Out</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <button class="btn-user"onclick="window.location.href='<?php echo URLROOT; ?>homecontroller/patientSignIn';">Log in as user</button>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <header>
            <h1>Admin Dashboard</h1><br>
            <p>Welcome Back! Here's an overview of your platform's latest activities and performance. </p>
        </header>

        <div class="grid-container">
           
            <!-- Notifications Card -->
            <div class="card large-card">
                <h3>Notifications & Alerts</h3>
                <p class ="description"></p>
                <p></p>
            </div>
            
            <div class="card">
                <h3>Total Users</h3>
                <p class ="description">Number of registered users</p>
                <p>23</p>
            </div>

            <!-- Total Active Users Card -->
            <div class="card">
                <h3>Active Users</h3>
                <p class ="description">Number of users who logged in within the last 24hrs</p>
                <p>2</p>
            </div>

            <!-- New Sign Ups Card -->
            <div class="card">
                <h3>New Signups</h3>
                <p class ="description">Last 7 Days</p>
                <p>9</p>
            </div>

            <!-- Appointment Card -->
            <div class="card large-card">
                <h3>Total Appointments Booked</h3>
                <p class ="description">Count of appointments scheduled via the platform</p>
                <p>9</p>
            </div>

            <!-- Revenue Card -->
            <div class="card">
                <h3>Total Revenue</h3>
                <p class ="description">Revenue generated</p>
                <p>9</p>
            </div>

             <!-- Revenue Card -->
             <div class="card">
                <h3>Total Revenue Month</h3>
                <p class ="description">Revenue generatedfor  the current month </p>
                <p>9</p>
            </div>

            <!-- User Growth Card -->
            <div class="card large-card">
                <h3>User Growth</h3>
                <p class ="description"></p>
                <p>9</p>
            </div>

             <!-- Revenue Analysis Card -->
             <div class="card">
                <h3>Revenue Analysis</h3>
                <p class ="description">Breakdown by Services </p>
                <p>9</p>
            </div>

            <!-- User Growth Card -->
            <div class="card large-card">
                <h3>User Growth</h3>
                <p class ="description"></p>
                <p>9</p>
            </div>
        </div>
        

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
        <a href="#"></a>
    </footer> 
            
    </div>

    
    <script src="<?php echo URLROOT?>public/assets/js/navbar.js"></script>

</body>

</html>
