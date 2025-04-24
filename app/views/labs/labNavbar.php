<div class="sidebar">
        <div class="logo">
            <img src="<?php echo URLROOT;?>public/assets/images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
            <h2>සුව CONNECT</h2>

            <button class="toggle-btn" id="toggleSidebar"> 
                <i class="material-icons-round">chevron_left</i>
            </button>
        </div>

        <ul class="nav-menu">

            <li class="nav-item">
                <a href="<?php echo URLROOT?>labController/labHomePage" class="nav-link">
                    <i class="material-icons-round">home</i> <span>Home</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo URLROOT?>labController/labTestRequests" class="nav-link">
                    <i class="material-icons-round">group</i> <span>Test Requests</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo URLROOT?>labcontroller/labAppointments" class="nav-link">
                    <i class="material-icons-round">medical_services</i> <span>Appointments</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo URLROOT?>labcontroller/labRevenue" class="nav-link">
                    <i class="material-icons-round">paid</i> <span>Billing</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo URLROOT?>labcontroller/labReports" class="nav-link">
                    <i class="material-icons-round">trending_up</i> <span>Reports</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo URLROOT?>labcontroller/labNotifications" class="nav-link">
                    <i class="material-icons-round">notifications</i> <span>Notifications</span>
                </a>
            </li>

            <li class="nav-item active">
                <a href="<?php echo URLROOT?>labcontroller/labSettings" class="nav-link">
                    <i class="material-icons-round">settings</i> <span>Settings</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo URLROOT?>labcontroller/labSupport" class="nav-link">
                    <i class="material-icons-round">contact_support</i> <span>Support</span>
                </a>
            </li>

            <li class="nav-item" id="logout">
                <a href="" class="nav-link">
                    <i class="material-icons-round">logout</i> <span>Logout</span>
                </a>
            </li>

            <!-- <div class="profile-section">
            <a href="profile.php" class="profile-icon" id="logoutButton">
                <img src="assets/images/navbar/user.png" alt="Profile Picture">
            </a>
            <div class="profile-text">
                <p>Welcome Back,<br> <span class="user-name">Sahan</span></p>
            </div>
            </div>
        </ul> -->
        
    </div>