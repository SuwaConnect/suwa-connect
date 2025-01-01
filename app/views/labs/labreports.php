<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/css/lab/navbar.css">
    <link rel="stylesheet" href="assets/css/lab/dashboard.css">
    <link rel="stylesheet" href="assets/css/lab/reports.css">

    <title>Suwa-Connect</title>
</head>

<body>
<div class="sidebar">
        <div class="logo">
            <img src="assets/images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
            <h2>සුව CONNECT</h2>

            <button class="toggle-btn" id="toggleSidebar"> 
                <i class="material-icons-round">chevron_left</i>
            </button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="<labhome" class="nav-link">
                    <i class="material-icons-round">home</i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<labtestRequests" class="nav-link">
                    <i class="material-icons-round">group</i> <span>Test Requests</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<labappointments" class="nav-link">
                    <i class="material-icons-round">medical_services</i> <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<labrevenue" class="nav-link">
                    <i class="material-icons-round">paid</i> <span>Billing</span>
                </a>
            </li>
            <li class="nav-item active">
                <a href="<labreports" class="nav-link">
                    <i class="material-icons-round">trending_up</i> <span>Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<labnotifications" class="nav-link">
                    <i class="material-icons-round">notifications</i> <span>Notifications</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<labsettings" class="nav-link">
                    <i class="material-icons-round">settings</i> <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<labsupport" class="nav-link">
                    <i class="material-icons-round">contact_support</i> <span>Support</span>
                </a>
            </li>
            <li class="nav-item" id="logout">
                <a href="<home" class="nav-link">
                    <i class="material-icons-round">logout</i> <span>Logout</span>
                </a>
            </li>
            <div class="profile-section">
            <a href="profile.php" class="profile-icon" id="logoutButton">
                <img src="assets/images/navbar/user.png" alt="Profile Picture">
            </a>
            <div class="profile-text">
                <p>Welcome Back,<br> <span class="user-name">Sahan</span></p>
            </div>
            </div>
        </ul>
        
    </div>


    <div class="main-content">   
        <!-- Header Section -->
        <header>
            <h1>Reports & Analytics</h1>
            <p>Generate, download, and analyze reports to gain insights into the platform’s performance.</p>
    
            <!-- Search and Filters -->
            <div class="search-container">
                <div class="search-box">
                    <input type="text" placeholder="Search by report type, date, or healthcare provider...">
                    <i class="material-icons-round">search</i>
                </div>
                
            </div>  
            <div class="actions">
                <button id="generateReportBtn">Generate New Report</button>
                <button id="exportReportBtn">Export Report</button>
            </div>
        </header>
    
        <!-- Reports Overview Section -->
        <section class="reports-overview">
            <h2>Summary of Available Reports</h2>
            <ul class="popular-reports">
                <li>Appointment History Report</li>
                <li>Revenue Summary Report</li>
                <li>Patient Feedback Report</li>
                <li>Cancellations and No-Show Trends</li>
                <li>Prescription & Lab Reports Summary</li>
                <li>Healthcare Provider Performance Report</li>
            </ul>
    
            <h3>Latest Reports</h3>
            <ul class="latest-reports">
                <li>August 2024 Appointment History | <a href="#">Download PDF</a> | Generated on: Sep 10, 2024</li>
                <!-- Add more latest reports here -->
            </ul>
        </section>
    
        <!-- Filter and Generate Reports Section -->
        <section class="filter-reports">
            <h2>Filter and Generate Reports</h2>
            <div class="filters">
                <label>Date Range:</label>
                <select id="dateRange">
                    <option>Today</option>
                    <option>Last 7 Days</option>
                    <option>Last 30 Days</option>
                    <option>Custom Date Range</option>
                </select>
    
                <label>Report Type:</label>
                <select id="reportType">
                    <option>Appointments</option>
                    <option>Revenue</option>
                    <option>Cancellations</option>
                    <option>Feedback</option>
                </select>
    
                <label>Service Category:</label>
                <select id="serviceCategory">
                    <option>Consultations</option>
                    <option>Lab Tests</option>
                    <option>Pharmacy</option>
                </select>
    
                <label>Healthcare Provider:</label>
                <select id="provider">
                    <option>Select Provider</option>
                    <option>Dr. John Doe</option>
                    <option>Pharmacy XYZ</option>
                    <!-- Add providers dynamically -->
                </select>
            </div>
    
            <button id="generateCustomReportBtn">Generate Custom Report</button>
        </section>
    
        <!-- Report Categories Section -->
        <section class="report-categories">
            <h2>Report Categories</h2>
            <div class="categories">
                <div class="category">
                    <h3>Appointments & Consultations</h3>
                    <p>Total Appointments (Last 30 Days): 500 | No-Shows: 25</p>
                </div>
                <div class="category">
                    <h3>Healthcare Provider Performance</h3>
                    <p>Dr. Ruwan Silva | 200 Consultations | Revenue: LKR 500,000 | Avg Rating: 4.8</p>
                </div>
                <div class="category">
                    <h3>User Engagement</h3>
                    <p>New User Signups (Last 30 Days): 150 | Active Users: 1,200</p>
                </div>
                <div class="category">
                    <h3>Revenue & Financial Reports</h3>
                    <p>Consultation Revenue: LKR 500,000 | Lab Tests Revenue: LKR 200,000</p>
                </div>
            </div>
        </section>
    
        <!-- Visualization Section -->
        <section class="visualization">
            <h2>Visualizations</h2>
            <div class="charts">
                <!-- Charts go here -->
            </div>
        </section>
    
        <!-- Recent Reports Table -->
        <section class="recent-reports">
            <h2>Recent Reports</h2>
            <table>
                <thead>
                    <tr>
                        <th>Report Name</th>
                        <th>Date Created</th>
                        <th>Report Type</th>
                        <th>Generated By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Revenue Report</td>
                        <td>Sep 10, 2024</td>
                        <td>Revenue</td>
                        <td>Admin</td>
                        <td><a href="#">Download PDF</a> | <a href="#">View Report</a></td>
                    </tr>
                    <!-- More reports can be added dynamically -->
                </tbody>
            </table>
        </section>
    
        <!-- Notifications Section -->
        <section class="notifications">
            <h2>Report Notifications</h2>
            <p>Your Custom Revenue Report for Aug 2024 is Ready to Download.</p>
        </section>
    
        <!-- Footer Section -->
        <footer>
            <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
            <a href="#"></a>
        </footer> 
    </div>
    
    
    <script src="assets/js/doctor/navbar.js"></script>
    <script src="assets/js/doctor/reports.js"></script>
</body>

</html>
