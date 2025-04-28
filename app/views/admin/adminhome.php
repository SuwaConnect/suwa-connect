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

<?php include 'adminNavbar.php'?>
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
