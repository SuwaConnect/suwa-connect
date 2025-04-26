<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/admin/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/admin/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/admin/support.css">

    <title>Suwa-Connect</title>
</head>

<body>

    <?php include 'adminNavbar.php'?>

    <div class="main-content">
    <!-- Header Section -->
        <header>
            <h1>Support Center</h1>
            <p>Manage and resolve issues related to the platform, users, and services.</p>
            <input type="text" id="searchBar" placeholder="Search for tickets, issues, or users...">
        </header>
    
        <!-- Support Overview Section -->
        <section class="overview">
            <div class="tickets-overview">
                <h2>Tickets Overview</h2>
                <ul>
                    <li>Open Tickets: 15</li>
                    <li>In-Progress Tickets: 8</li>
                    <li>Resolved Tickets: 23</li>
                </ul>
            </div>
    
            <div class="summary-categories">
                <h2>Summary of Categories</h2>
                <ul>
                    <li>System Issues</li>
                    <li>Payment & Billing</li>
                    <li>User Complaints</li>
                    <li>Account Issues</li>
                </ul>
            </div>
        </section>
    
        <!-- Support Ticket Filters Section -->
        <section class="filters">
            <h2>Filter Tickets</h2>
            <div class="filter-group">
                <label for="status">Status:</label>
                <select id="status">
                    <option>Open</option>
                    <option>In-Progress</option>
                    <option>Resolved</option>
                </select>
    
                <label for="category">Category:</label>
                <select id="category">
                    <option>System</option>
                    <option>Billing</option>
                    <option>User Complaint</option>
                    <option>Account Issue</option>
                </select>
    
                <label for="priority">Priority:</label>
                <select id="priority">
                    <option>High</option>
                    <option>Medium</option>
                    <option>Low</option>
                </select>
    
                <label for="date-range">Date Range:</label>
                <input type="date" id="date-range">
    
                <label for="assigned-to">Assigned To:</label>
                <input type="text" id="assigned-to" placeholder="Agent/Team">
            </div>
        </section>
    
        <!-- Support Tickets List Section -->
        <section class="tickets-list">
            <h2>Support Tickets</h2>
            <table>
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Category</th>
                        <th>User</th>
                        <th>Date Created</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="ticket-list">
                    <!-- Dynamically generated tickets will appear here -->
                </tbody>
            </table>
        </section>
    
        <!-- Footer Section -->
        <footer>
            <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
            <a href="#"></a>
        </footer> 
        
    </div>
    <script src="<?php echo URLROOT?>public\js\doctor\js\navbar.js"></script>
    <script src="<?php echo URLROOT?>public/assets/js/support.js"></script>
</body>

</html>
