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
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/admin/notification.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/admin/dashboard.css">


    <title>Suwa-Connect</title>
</head>

<body>
    
    <?php include 'adminNavbar.php'?>

    <div class="main-content">  
        <!-- Header Section -->
        <header class="header">
            <h1>Notifications</h1>
            <p>Manage and view all system-generated notifications related to platform activity, appointments, user actions, and performance.</p>
            <input type="text" placeholder="Search notifications by type, date, or user..." id="searchBar">
        </header>
    
        <!-- Filters Section -->
        <section class="filters">
            <h2>Filters</h2>
            <div class="filter-options">
                <select id="dateRange">
                    <option value="today">Today</option>
                    <option value="7days">Last 7 Days</option>
                    <option value="30days">Last 30 Days</option>
                    <option value="custom">Custom Date Range</option>
                </select>
    
                <select id="notificationType">
                    <option value="all">All Types</option>
                    <option value="appointment">Appointment</option>
                    <option value="payment">Payment</option>
                    <option value="feedback">Feedback</option>
                    <option value="system">System</option>
                </select>
    
                <select id="priority">
                    <option value="all">All Priorities</option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
    
                <select id="status">
                    <option value="all">All Status</option>
                    <option value="read">Read</option>
                    <option value="unread">Unread</option>
                    <option value="archived">Archived</option>
                </select>
    
                <button id="applyFilters">Apply Filters</button>
            </div>
        </section>
    
        <!-- Notifications Overview Section -->
        <section class="notifications-overview">
            <h2>Recent Notifications</h2>
            <ul id="notificationsList">
                <li>
                    <p><strong>Appointment Booked:</strong> Patient X has booked an appointment with Dr. Y for Sep 20, 2024.</p>
                    <button class="mark-read">Mark as Read</button>
                    <button class="archive">Archive</button>
                    <button class="delete">Delete</button>
                </li>
                <!-- Add more notifications here -->
            </ul>
        </section>
    
        <!-- Archived Notifications Section -->
        <section class="archived-notifications">
            <h2>Archived Notifications</h2>
            <ul id="archivedList">
                <!-- Archived notifications will be displayed here -->
            </ul>
        </section>
    
       <!-- Footer Section -->
       <footer>
        <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
        <a href="#"></a>
    </footer> 
    </div>
        <script src="./js/notifications.js"></script>
    
        <script src="<?php echo URLROOT?>public/assets/js/navbar.js"></script>

</body>

</html>
