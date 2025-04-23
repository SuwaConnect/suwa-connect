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
        <li class="nav-item active">
            <a href="<?php echo URLROOT?>doctor/home" class="nav-link">
                <i class="material-icons-round">home</i> <span>Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URLROOT?>doctor/searchPatient" class="nav-link">
                <i class="material-icons-round">group</i> <span>search patient</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URLROOT?>doctor/appointments" class="nav-link">
                <i class="material-icons-round">medical_services</i> <span>Appointments</span>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a href="revenue.html" class="nav-link">
                <i class="material-icons-round">paid</i> <span>Revenue</span>
            </a>
        </li> -->
        <!-- <li class="nav-item">
            <a href="reports.html" class="nav-link">
                <i class="material-icons-round">trending_up</i> <span>Reports</span>
            </a>
        </li> -->
        <li class="nav-item">
            <a href="<?php echo URLROOT?>notificationsController/index" class="nav-link">
                <i class="material-icons-round">notifications</i> <span>Notifications</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URLROOT?>doctor/updateProfile" class="nav-link">
                <i class="material-icons-round">settings</i> <span>Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="support.html" class="nav-link">
                <i class="material-icons-round">contact_support</i> <span>Support</span>
            </a>
        </li>
    </ul>
    
        <div class="sidebar-footer">
        <a href="<?php echo URLROOT?>logincontroller/logout" class="btn-user">Log-Out</a>
        </div>

    
</div>

