<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/lab/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/lab/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/lab/appointments.css">
    <title>Suwa-Connect | Appointments</title>
</head>

<body>
<div class="sidebar">
        <div class="logo">
            <img src="<?php echo URLROOT?>public/assets/images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
            <h2>සුව CONNECT</h2>

            <button class="toggle-btn" id="toggleSidebar"> 
                <i class="material-icons-round">chevron_left</i>
            </button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="labhome" class="nav-link">
                    <i class="material-icons-round">home</i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="labtestRequests" class="nav-link">
                    <i class="material-icons-round">group</i> <span>Test Requests</span>
                </a>
            </li>
            <li class="nav-item active">
                <a href="labappointments" class="nav-link">
                    <i class="material-icons-round">medical_services</i> <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="labrevenue" class="nav-link">
                    <i class="material-icons-round">paid</i> <span>Billing</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="labreports" class="nav-link">
                    <i class="material-icons-round">trending_up</i> <span>Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="labnotifications" class="nav-link">
                    <i class="material-icons-round">notifications</i> <span>Notifications</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="labsettings" class="nav-link">
                    <i class="material-icons-round">settings</i> <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="labsupport" class="nav-link">
                    <i class="material-icons-round">contact_support</i> <span>Support</span>
                </a>
            </li>
            <li class="nav-item" id="logout">
                <a href="home" class="nav-link">
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
        <header>
            <h1>Appointments</h1>
            <p>View, manage, and schedule patient appointments for laboratory tests and consultations.</p>
        </header>

        <section class="overview">
            <div class="card">
                <h3>Total Appointments Today</h3>
                <p>25</p>
            </div>
            <div class="card">
                <h3>Upcoming Appointments</h3>
                <p>15</p>
            </div>
            <div class="card">
                <h3>Missed Appointments</h3>
                <p>2</p>
            </div>
            <div class="card">
                <h3>Cancellations</h3>
                <p>3</p>
            </div>
        </section>

        <section class="appointments-table">
            <h2>Appointment List</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Appointment ID</th>
                            <th>Patient Name</th>
                            <th>Date & Time</th>
                            <th>Test Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>APT001</td>
                            <td>John Doe</td>
                            <td>2024-11-29 | 10:00 AM</td>
                            <td>Blood Test</td>
                            <td>Scheduled</td>
                            <td>
                                <button class="view-btn">View</button>
                                <button class="reschedule-btn">Reschedule</button>
                            </td>
                        </tr>
                        <tr>
                            <td>APT002</td>
                            <td>Jane Smith</td>
                            <td>2024-11-29 | 11:30 AM</td>
                            <td>Urine Analysis</td>
                            <td>Completed</td>
                            <td>
                                <button class="view-btn">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="filters">
            <h2>Filter Appointments</h2>
            <form>
                <label for="date-range">Date Range:</label>
                <input type="date" id="start-date"> to <input type="date" id="end-date">

                <label for="status">Status:</label>
                <select id="status">
                    <option value="all">All</option>
                    <option value="scheduled">Scheduled</option>
                    <option value="completed">Completed</option>
                    <option value="missed">Missed</option>
                    <option value="canceled">Canceled</option>
                </select>

                <label for="test-type">Test Type:</label>
                <select id="test-type">
                    <option value="all">All</option>
                    <option value="blood-test">Blood Test</option>
                    <option value="x-ray">X-Ray</option>
                    <option value="mri">MRI</option>
                </select>

                <button type="submit">Apply Filters</button>
            </form>
        </section>

        <section class="calendar-view">
            <h2>Appointment Calendar</h2>
            <div id="calendar"></div>
        </section>

        <div class="modal" id="appointment-details">
            <h3>Appointment Details</h3>
            <p><strong>Patient Name:</strong> John Doe</p>
            <p><strong>Date & Time:</strong> 2024-11-29 | 10:00 AM</p>
            <p><strong>Test Type:</strong> Blood Test</p>
            <p><strong>Status:</strong> Scheduled</p>
            <p><strong>Doctor's Notes:</strong> Fasting required before the test.</p>
            <button>Close</button>
        </div>

        <section class="notifications">
            <h2>Notifications</h2>
            <ul>
                <li><strong>Upcoming:</strong> Blood Test for John Doe in 30 minutes.</li>
                <li><strong>Missed:</strong> Urine Analysis for Jane Smith at 9:00 AM today.</li>
            </ul>
        </section>

        <section class="appointment-tools">
            <h2>Manage Appointment</h2>
            <button class="reschedule-btn">Reschedule</button>
            <button class="cancel-btn">Cancel</button>
            <button class="complete-btn">Mark as Completed</button>
        </section>

        <section class="feedback">
            <h2>Submit Feedback</h2>
            <textarea placeholder="Enter your feedback here..."></textarea>
            <button>Submit</button>
        </section>

        <!-- Footer Section -->
        <footer>
            <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
            <a href="#"></a>
        </footer> 
    </div>

    <script src="<?php echo URLROOT?>public/assets/js/doctor/navbar.js"></script>
    <script src="<?php echo URLROOT?>public/assets/js/doctor/appointments.js"></script>
</body>

</html>
