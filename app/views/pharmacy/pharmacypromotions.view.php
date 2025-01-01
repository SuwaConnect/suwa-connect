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
    <link rel="stylesheet" href="assets/css/pharmacypromotions.css">
  <link rel="stylesheet" href="assets/css/pharmacynavbar.css">
</head>
<body>
<div class="container">
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
                    <a href="phamacyhome" class="nav-link">
                        <i class="material-icons-round">home</i> <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pharmacypresmanagement" class="nav-link">
                        <i class="material-icons-round">assignment</i> <span>Prescription Management</span>
                    </a>
                </li>
                </li>
                <li class="nav-item">
                    <a href="pharmacyprescriptionhistory" class="nav-link">
                        <i class="material-icons-round">dashboard</i> <span>Prescription History</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a href="pharmacypromotions" class="nav-link">
                        <i class="material-icons-round">local_offer</i> <span>Promotions</span>
                </a>
                <li class="nav-item">
                    <a href="pharmacyprofile" class="nav-link">
                        <i class="material-icons-round">group</i> <span>Profile</span>
                    </a>
                </li>
                <li class="nav-item" id="logout">
                    <a href="home" class="nav-link">
                        <i class="material-icons-round">logout</i> <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        
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
    <script src="assets/js/pharmacynavbar.js"></script>
</body>
</html>
