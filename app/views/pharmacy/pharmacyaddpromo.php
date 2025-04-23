<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <title>Add/Edit Promotion</title>
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/pharmacy/pharmacyaddpromo.css">
    
</head>
<body>
<div class="sideBar">

<div class="logo">
    <img src="<?php echo URLROOT?>public/assets/images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
    <h2>සුව CONNECT</h2>
    <button class="toggle-btn" id="toggleSideBar">
        <i class="material-icons-round">chevron_left</i>
    </button>
</div>

<ul class="nav-menu">

    <li class="nav-item ">
            <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyHome" class="nav-link">
            <i class="material-icons-round">home</i> <span>Home</span>
        </a>
    </li>

    <li class="nav-item active">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyOrders" class="nav-link">
            <i class="material-icons-round">medical_services</i> <span> Orders </span>
        </a>

    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyAddPromo" class="nav-link">
            <i class="material-icons-round">assignment</i> <span>Promotions </span>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyAddPromo" class="nav-link">
            <i class="material-icons-round">assignment</i> <span>Notifications </span>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyAddPromo" class="nav-link">
            <i class="material-icons-round">assignment</i> <span>Revenue </span>
        </a>
    </li>



    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyPresManagement" class="nav-link">
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

    <div class="main-content">
    <!-- <div class="container"> -->
        <!-- Sidebar code remains same as pharmacypromotions.php -->
       
            <div class="form-container">
                <div class="form-header">
                    <h1 id="formTitle">Add New Promotion</h1>
                    <button class="back-btn" onclick="history.back()">
                        <i class="material-icons-round">arrow_back</i> Back
                    </button>
                </div>
                <form id="promotionForm" method="POST" action="phamacyaddpromo/phamacyaddpromo">
                    <div class="form-group">
                        <label for="promotionTitle">Promotion Title*</label>
                        <input type="text" id="promotionTitle" name="promotionTitle" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="startDate">Start Date*</label>
                            <input type="date" id="startDate" name="startDate" required>
                        </div>
                        <div class="form-group">
                            <label for="endDate">End Date*</label>
                            <input type="date" id="endDate" name="endDate" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description*</label>
                        <textarea id="description" name="description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="discountAmount">Discount Amount (%)*</label>
                        <input type="number" id="discountAmount" name="discountAmount" min="0" max="100" required>
                    </div>

                    <div class="form-group">
                        <label for="terms">Terms and Conditions</label>
                        <textarea id="terms" name="terms"></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="cancel-btn" onclick="history.back()">Cancel</button>
                        <button type="submit" class="save-btn">Save Promotion</button>
                    </div>
                </form>
            </div>
        
    <!-- </div> -->
    </div>
    <script src="<?php echo URLROOT?>public/assets/js/pharmacyaddpromo.js"></script>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

</body>
</html>
