<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <title>Pharmacy Promotions</title>
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/pharmacypromotions.css">
  <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/pharmacynavbar.css">
</head>
<body>

<div class="sideBar">

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
            <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyHome" class="nav-link">
            <i class="material-icons-round">home</i> <span>Home</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyOrders" class="nav-link">
            <i class="material-icons-round">medical_services</i> <span> Orders </span>
        </a>

    <li class="nav-item active">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyAddPromo" class="nav-link">
            <i class="material-icons-round">assignment</i> <span>Promotions </span>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyNotifications" class="nav-link">
            <i class="material-icons-round">assignment</i> <span>Notifications </span>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyAddPromo" class="nav-link">
            <i class="material-icons-round">assignment</i> <span>Revenue </span>
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

<!-- <div class="container"> -->
<div class="main-content">

        
        <main class="content">
            <header>
                <div class="header-content">
                    <h1>Promotions Management</h1>
                    <p>Create and manage your pharmacy promotions</p>
                </div>
                <button id="addPromotionBtn" class="add-promotion-btn" onclick="window.location.href='phamacyaddpromo'">
                    <i class="material-icons-round">add</i> Add New Promotion
                </button>
            </header>

            <div class="promotions-grid">
                <?php if(isset($data['promotions']) && $data['promotions']): ?>
                    <?php foreach($data['promotions'] as $promotion): ?>
                        <div class="promotion-card">
                            <div class="promotion-header">
                                <h3><?= $promotion->promotion_title ?></h3>
                                <div class="promotion-actions">
                                <button class="edit-btn" onclick="window.location.href='changepromo/index/<?= $promotion->promotion_id ?>'"><i class="material-icons-round">edit</i></button>
                                    <button class="delete-btn" onclick="if(confirm('Are you sure you want to cancel this appointment?')) window.location.href='/delpromo/index/<?= $promotion->promotion_id ?>'"><i class="material-icons-round">delete</i></button>
                                </div>
                            </div>
                            <p class="promotion-dates">Valid: <?= $promotion->starting_date ?> - <?= $promotion->ending_date ?></p>
                            <p class="promotion-description"><?= $promotion->description ?></p>
                            <?php if($promotion->discount_amount > 0): ?>
                                <p class="discount-amount">Discount: <?= $promotion->discount_amount ?>%</p>
                            <?php endif; ?>
                            <p class="terms"><?= $promotion->terms_and_conditions ?></p>
                            <div class="promotion-status active">Active</div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
</body>
</html>
