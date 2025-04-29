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

    <li class="nav-item active">
            <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyHome" class="nav-link">
            <i class="material-icons-round">home</i> <span>Home</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/viewPendingOrders" class="nav-link">
            <i class="material-icons-round">medical_services</i> <span> Orders </span>
        </a>
        </li>

    <li class="nav-item">
        <a href="<?php echo URLROOT?>notificationsController/index" class="nav-link">
            <i class="material-icons-round">assignment</i> <span>Notifications </span>
        </a>
    </li>

    



    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyProfile" class="nav-link">
            <i class="material-icons-round">group</i> <span>Profile</span>
        </a>
    </li>

    <li class="nav-item" id="logout">
        <a href="<?php echo URLROOT?>logincontroller/logout" class="nav-link">
            <i class="material-icons-round">logout</i> <span>Logout</span>
        </a>
    </li>

</ul>
</div>
