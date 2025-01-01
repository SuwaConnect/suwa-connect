<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/profile.css">


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
            <li class="nav-item active">
                <a href="home.php" class="nav-link">
                    <i class="material-icons-round">home</i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="testRequests.php" class="nav-link">
                    <i class="material-icons-round">group</i> <span>Test Requests</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="appointments.php" class="nav-link">
                    <i class="material-icons-round">medical_services</i> <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="revenue.php" class="nav-link">
                    <i class="material-icons-round">paid</i> <span>Billing</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="reports.php" class="nav-link">
                    <i class="material-icons-round">trending_up</i> <span>Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="notifications.php" class="nav-link">
                    <i class="material-icons-round">notifications</i> <span>Notifications</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="settings.php" class="nav-link">
                    <i class="material-icons-round">settings</i> <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="support.php" class="nav-link">
                    <i class="material-icons-round">contact_support</i> <span>Support</span>
                </a>
            </li>
            <li class="nav-item" id="logout">
                <a href="support.php" class="nav-link">
                    <i class="material-icons-round">logout</i> <span>Logout</span>
                </a>
            </li>
            <div class="profile-section">
            <a href="profile.html" class="profile-icon">
                <img src="assets/images/profile_picture.png" alt="Profile Picture">
            </a>
            <div class="profile-text">
                <p>Welcome Back,<br> <span class="user-name">Sahan</span></p>
            </div>
            </div>
            
            
        </ul>
    </div>

    <div class="main-content"></div>

  <header class="page-header">
    <h1>Profile</h1>
    <p>View and manage your personal and laboratory details.</p>
  </header>

  <main>
    <!-- Personal Information Section -->
    <section class="personal-info">
      <h2>Personal Information</h2>
      <form id="personal-info-form">
        <label for="full-name">Full Name:</label>
        <input type="text" id="full-name" value="John Doe">

        <label for="job-title">Job Title:</label>
        <input type="text" id="job-title" value="Senior Laboratory Technician">

        <label for="contact-number">Contact Number:</label>
        <input type="tel" id="contact-number" value="+94 771234567">

        <label for="email">Email Address:</label>
        <input type="email" id="email" value="johndoe@example.com">

        <button type="button" onclick="savePersonalInfo()">Save Changes</button>
      </form>
    </section>

    <!-- Laboratory Information Section -->
    <section class="lab-info">
      <h2>Laboratory Information</h2>
      <form id="lab-info-form">
        <label for="lab-name">Laboratory Name:</label>
        <input type="text" id="lab-name" value="Healthy Labs Pvt Ltd">

        <label for="lab-address">Address:</label>
        <textarea id="lab-address">123, Main Street, Colombo</textarea>

        <label for="lab-contact">Contact Number:</label>
        <input type="tel" id="lab-contact" value="+94 1122334455">

        <label for="lab-hours">Business Hours:</label>
        <input type="text" id="lab-hours" value="Mon-Fri: 8 AM - 6 PM, Sat: 9 AM - 1 PM">

        <label for="lab-description">Description (Optional):</label>
        <textarea id="lab-description">We offer a wide range of diagnostic tests and health check-ups with modern equipment and expert staff.</textarea>

        <button type="button" onclick="updateLabInfo()">Update Laboratory Information</button>
      </form>
    </section>

    <!-- Change Password Section -->
    <section class="change-password">
      <h2>Change Password</h2>
      <form id="password-form">
        <label for="current-password">Current Password:</label>
        <input type="password" id="current-password" placeholder="Enter current password">

        <label for="new-password">New Password:</label>
        <input type="password" id="new-password" placeholder="Enter new password">

        <label for="confirm-new-password">Confirm New Password:</label>
        <input type="password" id="confirm-new-password" placeholder="Confirm new password">

        <button type="button" onclick="changePassword()">Update Password</button>
      </form>
    </section>

    <!-- Profile Picture Section -->
    <section class="profile-picture">
      <h2>Profile Picture</h2>
      <div class="profile-pic-container">
        <img src="profile-picture.jpg" alt="Profile Picture" id="profile-pic">
        <input type="file" id="upload-profile-pic" accept="image/*" onchange="uploadProfilePicture(event)">
        <button onclick="updateProfilePicture()">Upload New Picture</button>
      </div>
    </section>

    <!-- Help and Support Section -->
    <section class="help-support">
      <h2>Help & Support</h2>
      <ul>
        <li><a href="/help-center">Help Center</a></li>
        <li><a href="/contact-support">Contact Support</a></li>
        <li><a href="/user-manual">User Manual</a></li>
      </ul>
    </section>

    <!-- Delete Account Section -->
    <section class="delete-account">
      <h2>Delete Account</h2>
      <p>Deleting your account is permanent and cannot be undone. All associated data will be lost.</p>
      <button class="delete-account-button" onclick="deleteAccount()">Delete Account</button>
    </section>
  </main>

  <script src="assets/js/profile.js"></script>">
</body>
</html>

