<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/admin/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/admin/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/admin/appointments.css">

    <title>Suwa-Connect</title>
</head>

<body>
    <?php include 'adminNavbar.php'?>
    <div class="main-content">
        <!-- Header Section -->
        <header class="header">
            <h1>Appointments Management</h1>
            <p>Monitor and manage all appointments scheduled between patients and healthcare providers.</p>
            
            <!-- Search and Filters -->
            <div class="search-container">
                <div class="search-box">
                    <input type="text" placeholder="Search by patient name, doctor name, appointment date, or status...">
                    <i class="material-icons-round">search</i>
                </div>
                
            </div>  
                
        </header>

        <!-- Appointments Overview Section -->
        <section class="overview">
            <div class="overview-card">
                <h3>Total Appointments</h3>
                <p>8,950 Total Appointments</p>
            </div>
            <div class="overview-card">
                <h3>Upcoming Appointments</h3>
                <p>1,200 Upcoming Appointments</p>
            </div>
            <div class="overview-card">
                <h3>Completed Appointments</h3>
                <p>7,300 Completed Appointments</p>
            </div>
            <div class="overview-card">
                <h3>Canceled Appointments</h3>
                <p>450 Canceled Appointments</p>
            </div>
            <div class="overview-card">
                <h3>No-Show Appointments</h3>
                <p>100 No-Show Appointments</p>
            </div>
        </section>

        <!-- Appointments Table -->
        <section class="appointments-table">
            <h2>Appointments List</h2>
            

            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Appointment Date & Time</th>
                        <th>Status</th>
                        <th>Type of Consultation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="appointmentsBody">
                </tbody>
            </table>

            
        </section>

        <!-- Statistics & Trends Section -->
        <!-- <section class="statistics">
            <h2>Appointment Statistics</h2>
            <div class="stats-chart">
                <canvas id="appointmentsTrendsChart"></canvas>
            </div>
            <div class="stats-list">
                <h3>Most Booked Doctors</h3>
                <ul>
                    <li>Dr. Anil Perera - 150 Appointments in Last 30 Days</li>
                    <li>Dr. Samara - 130 Appointments in Last 30 Days</li>
                </ul>
            </div>
        </section> -->

        <!-- Footer Section -->
        <footer>
            <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
            <a href="#"></a>
        </footer> 

    </div>


    <script src="./js/appointments.js"></script>
    <script src="<?php echo URLROOT?>public/assets/js/navbar.js"></script>
</body>

</html>