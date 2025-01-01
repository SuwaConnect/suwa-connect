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
    <link rel="stylesheet" href="assets/css/lab/notification.css">

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
                <a href="labhome" class="nav-link">
                    <i class="material-icons-round">home</i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="labtestRequests" class="nav-link">
                    <i class="material-icons-round">group</i> <span>Test Requests</span>
                </a>
            </li>
            <li class="nav-item">
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
            <li class="nav-item  active">
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
    <div class="container">
    <header>
      <h1>Appointments Management</h1>
      <p>Monitor and manage all appointments scheduled between patients and healthcare providers.</p>
    </header>

    <div class="search-bar">
      <input type="text" placeholder="Search by patient name, doctor name, appointment date, or status...">
      <button class="search-btn">Search</button>
    </div>

    <div class="actions">
      <button class="create-appointment">Create New Appointment</button>
      <button class="export-appointments">Export Appointments</button>
    </div>

    <div class="appointments-summary">
      <div class="total-appointments">
        <h2>Total Appointments</h2>
        <p>8,950 Total Appointments</p>
      </div>
      <div class="upcoming-appointments">
        <h2>Upcoming Appointments</h2>
        <p>1,200 Upcoming Appointments</p>
      </div>
      <div class="completed-appointments">
        <h2>Completed Appointments</h2>
        <p>7,300 Completed Appointments</p>
      </div>
      <div class="canceled-appointments">
        <h2>Canceled Appointments</h2>
        <p>450 Canceled Appointments</p>
      </div>
      <div class="no-show-appointments">
        <h2>No-Show Appointments</h2>
        <p>100 No-Show Appointments</p>
      </div>
    </div>

    <div class="appointments-list">
      <div class="filters">
        <select class="filter-status">
          <option value="all">Filter by Status</option>
          <!-- Add more options here -->
        </select>
        <select class="filter-doctor">
          <option value="all">Filter by Doctor</option>
          <!-- Add more options here -->
        </select>
        <input type="date" class="filter-date">
        <select class="sort-by">
          <option value="default">Sort by</option>
          <!-- Add more options here -->
        </select>
      </div>
      <section class="appointments">
      <table class="appointments-table">
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
        <tbody>
          <!-- Appointment data will be dynamically added here -->
        </tbody>
      </table>
</section>
    </div>

    <div class="help-section">
      <h2>Help & Support</h2>
      <p><strong>Why am I receiving a billing alert?</strong> Billing alerts are sent for overdue or pending payments.</p>
      <p><strong>How do I clear resolved notifications?</strong> Use the "Clear Resolved Notifications" button to remove notifications marked as resolved.</p>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
    
       <!-- Footer Section -->
       <footer>
        <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
        <a href="#"></a>
    </footer> 
    </div>
    <script src="assets/js/doctor/navbar.js"></script>
    <script src="assets/js/doctor/notifications.js"></script>

</body>

</html>
