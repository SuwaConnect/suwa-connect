  
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
    <link rel="stylesheet" href="assets/css/lab/userManagement.css">


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
            <li class="nav-item active">
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
    
  <div class="container">
    <header >
      <h1>Lab Requests</h1>
      <p>Manage and process all laboratory test requests efficiently.</p>
    </header>

    <section class="overview">
      <div class="card">
        <h3>Total Requests</h3>
        <p>8,950</p>
      </div>
      <div class="card">
        <h3>Upcoming Appointments</h3>
        <p>1,200</p>
      </div>
      <div class="card">
        <h3>Completed Appointments</h3>
        <p>7,300</p>
      </div>
      <div class="card">
        <h3>Canceled Appointments</h3>
        <p>450</p>
      </div>
      <div class="card">
        <h3>No-Show Appointments</h3>
        <p>100</p>
      </div>
    </section>

    <section class="requests-table">
      <h2>Test Requests</h2>
      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>Patient Name</th>
              <th>Appointment Date & Time</th>
              <th>Type of test</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if(isset($data['lab_appointment_requests']) && is_array($data['lab_appointment_requests'])): ?>
                <?php foreach($data['lab_appointment_requests'] as $request): ?>
                    <tr>
                        <td><?= $request->patient_name?></td>
                        <td><?= date('Y-m-d h:i A', strtotime($request->requested_date )) ?></td>
                        <td><?= $request->test_type ?></td>
                        <td>
                        <a href="labtestrequests/change/<?= $request->id ?>" class="view-btn">Accept</a>
                        <a href="labtestrequests/cancel/<?= $request->id ?>" class="cancel-btn">Cancel</a>
                        </td>

                      </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>

    <section class="filters">
      <h2>Filter Requests</h2>
      <form>
        <label for="status-filter">Filter by Status:</label>
        <select id="status-filter">
          <option value="all">All</option>
          <option value="scheduled">Scheduled</option>
          <option value="in-progress">In Progress</option>
          <option value="completed">Completed</option>
        </select>

        <label for="doctor-filter">Filter by Doctor:</label>
        <select id="doctor-filter">
          <option value="all">All</option>
          <!-- Add doctor options here -->
        </select>

        <label for="date-filter">Filter by Date:</label>
        <input type="date" id="date-filter">

        <button type="submit">Apply Filters</button>
      </form>
    </section>

    <section class="notifications">
      <h2>Notifications</h2>
      <ul>
        <li><strong>High Priority:</strong> Blood Test for Jane Smith due in 2 hours.</li>
        <li><strong>Pending:</strong> X-Ray request for Peter Johnson has been pending for 24 hours.</li>
      </ul>
    </section>

    <section class="feedback">
      <h2>Submit Feedback</h2>
      <textarea placeholder="Let us know your thoughts..."></textarea>
      <button>Submit</button>
    </section>
    <footer>
            <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
            <a href="#"></a>
        </footer> 
  </div>

  <script src="assets/js/doctor/navbar.js"></script>
</body>
</html>