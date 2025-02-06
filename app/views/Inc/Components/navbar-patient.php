<link rel="stylesheet" href="<?php echo URLROOT?>assets/css/navbartwo.css">

<div class="sidebar">
        <div class="logo">
            <img src="<?php echo URLROOT?>assets/images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
            <h2>සුව CONNECT</h2>

            <button class="toggle-btn" id="toggleSidebar"> 
                <i class="material-icons-round">chevron_left</i>
            </button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="record" class="nav-link">
                    <i class="material-icons-round">home</i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="appointments" class="nav-link">
                    <i class="material-icons-round">medical_services</i> <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="dashboard" class="nav-link">
                    <i class="material-icons-round">file_copy</i> <span>Health Records</span>
                </a>
            </li>
            <li class="nav-item  active">
                <a href="report" class="nav-link">
                    <i class="material-icons-round">monitor</i> <span>Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="notifications" class="nav-link">
                    <i class="material-icons-round">notifications</i> <span>Notifications</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="settings" class="nav-link">
                    <i class="material-icons-round">settings</i> <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="support" class="nav-link">
                    <i class="material-icons-round">contact_support</i> <span>Support</span>
                </a>
            </li>
            <li class="nav-item" id="logout">
                <a href="home" class="nav-link">
                    <i class="material-icons-round">logout</i> <span>Logout</span>
                </a>
            </li>
            
        </ul>
        <div class="sidebar-footer">
            <button class="btn-user" href="dashboard"></button>
        </div>
    </div>