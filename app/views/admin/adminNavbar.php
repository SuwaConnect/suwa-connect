 <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/admin/navbar.css">
    
   
<div class="sidebar">
        <div class="logo">
            <img src="<?php echo URLROOT;?>public/assets/images/suwa-connect logo.png" alt="Suwa-Connect Logo">
            <h2>සුව CONNECT</h2>

            <button class="toggle-btn" id="toggleSidebar"> 
                <i class="material-icons-round">chevron_left</i>
            </button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item ">
                <a href="<?php echo URLROOT;?>adminController/home" class="nav-link">
                    <i class="material-icons-round">home</i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>adminController/pendingUsers" class="nav-link">
                    <i class="material-icons-round">group</i> <span>User Approval</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>admincontroller/appointments" class="nav-link">
                    <i class="material-icons-round">medical_services</i> <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>admincontroller/usermanagement" class="nav-link">
                <i class="material-icons-round">group</i> <span>User management</span>
                </a>
            </li>
            <li class="nav-item">
                
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>admincontroller/notifications" class="nav-link">
                    <i class="material-icons-round">notifications</i> <span>Notifications</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT;?>logincontroller/logout" class="nav-link">
                    <i class="material-icons-round">logout</i> <span>log-out</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <button class="btn-user">Log in as user</button>
        </div>
    </div>