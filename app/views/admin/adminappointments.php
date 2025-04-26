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
<div class="sidebar">
        <div class="logo">
            <img src="<?php echo URLROOT;?>public/assets/images/suwa-connect logo.png" alt="Suwa-Connect Logo">
            <h2>සුව CONNECT</h2>

            <button class="toggle-btn" id="toggleSidebar"> 
                <i class="material-icons-round">chevron_left</i>
            </button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item ">
                <a href="<?php echo URLROOT;?>admincontroller/home" class="nav-link">
                    <i class="material-icons-round">home</i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>admincontroller/pendingdoctors" class="nav-link">
                    <i class="material-icons-round">group</i> <span>User Management</span>
                </a>
            </li>
            <li class="nav-item active">
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
                <div>
                <button class="create-btn">Create New Appointment</button>
                <button class="export-btn">Export Appointments</button>
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
            <div class="filters">
                <select>
                    <option value="">Filter by Status</option>
                    <option value="scheduled">Scheduled</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                    <option value="no-show">No-Show</option>
                </select>
                <select>
                    <option value="">Filter by Doctor</option>
                    <option value="doctor1">Dr. Anil Perera</option>
                    <option value="doctor2">Dr. Samara</option>
                </select>
                <input type="date" id="filterDate">
                <select>
                    <option value="">Sort by</option>
                    <option value="appointment-date">Appointment Date</option>
                    <option value="patient-name">Patient Name</option>
                    <option value="doctor-name">Doctor Name</option>
                    <option value="status">Status</option>
                </select>
            </div>

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
                    <!-- Rows dynamically populated by JS -->
                </tbody>
            </table>

            <div class="pagination">
                <button>Previous</button>
                <button>Next</button>
            </div>
        </section>

        <!-- Statistics & Trends Section -->
        <section class="statistics">
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
        </section>

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