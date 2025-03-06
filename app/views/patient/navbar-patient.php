
<link rel="stylesheet" href="<?php echo URLROOT; ?>public/css/doctor/navbarcssbhagya.css">


<div class="sideBar">
        <div class="logo">
            <img src="<?php echo URLROOT?>public/assets/images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
            <h2>සුව CONNECT</h2>

            <button class="toggle-btn" id="toggleSideBar"> 
                <i class="material-icons-round">chevron_left</i>
            </button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="<?php echo URLROOT?>patientcontroller/records" class="nav-link">
                    <i class="material-icons-round">home</i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT?>patientcontroller/appointments" class="nav-link">
                    <i class="material-icons-round">medical_services</i> <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT?>patientcontroller/dashboard" class="nav-link">
                    <i class="material-icons-round">file_copy</i> <span>Health Records</span>
                </a>
            </li>
            <li class="nav-item  active">
                <a href="<?php echo URLROOT?>patientcontroller/report" class="nav-link">
                    <i class="material-icons-round">monitor</i> <span>Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT?>patientcontroller/notifications" class="nav-link">
                    <i class="material-icons-round">notifications</i> <span>Notifications</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT?>patientcontroller/settings" class="nav-link">
                    <i class="material-icons-round">settings</i> <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT?>patientcontroller/support" class="nav-link">
                    <i class="material-icons-round">contact_support</i> <span>Support</span>
                </a>
            </li>
            <li class="nav-item" id="logout">
                <a href="<?php echo URLROOT?>logincontroller/logout" class="nav-link">
                    <i class="material-icons-round">logout</i> <span>Logout</span>
                </a>
            </li>
            
        </ul>
        <div class="sidebar-footer">
            <button class="btn-user" href="dashboard"></button>
        </div>
    </div>