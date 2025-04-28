<link rel="stylesheet" href="<?php echo URLROOT; ?>public/css/doctor/navbarcssbhagya.css">

    <div class="sideBar">

    <div class="logo">
        <img src="<?php echo URLROOT; ?>public/images/doctor/Images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
        <h2>සුව CONNECT</h2>

        <button class="toggle-btn" id="toggleSideBar"> 
            <i class="material-icons-round">chevron_left</i>
        </button>
    </div>
    
    <ul class="nav-menu">
        <li class="nav-item ">
            <a href="<?php echo URLROOT?>labController/labHomePage" class="nav-link">
                <i class="material-icons-round">home</i> <span>Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URLROOT?>labController/labTestRequests" class="nav-link">
                <i class="material-icons-round">group</i> <span>Test requests</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URLROOT?>labcontroller/labAppointments" class="nav-link">
                <i class="material-icons-round">medical_services</i> <span>Appointments</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URLROOT?>labcontroller/labRevenue" class="nav-link">
                <i class="material-icons-round">paid</i> <span>Billings</span>
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
        <!-- <li class="nav-item">
            <a href="doctor/updateProfile" class="nav-link">
                <i class="material-icons-round">settings</i> <span>Settings</span>
            </a>
        </li> -->
        <!-- <li class="nav-item">
            <a href="support.html" class="nav-link">
                <i class="material-icons-round">contact_support</i> <span>Support</span>
            </a>
        </li> -->
    
        <li class="nav-item" id="logout">
                <a href="<?php echo URLROOT?>logincontroller/logout" class="nav-link">
                    <i class="material-icons-round">logout</i> <span>Log Out</span>
                </a>
            </li>
        

        </ul>

    
</div>

