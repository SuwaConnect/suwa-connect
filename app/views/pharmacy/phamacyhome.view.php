<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/pharmacyhome.css">
    <title>Pharmacies Home - Suwa-Connect</title>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">
            <img src="assets/images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
        </div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="pharmacypresmanagement">Prescription Management</a></li>
            <li><a href="pharmacyprescriptionhistory">Prescription History</a></li>
            <li><a href="pharmacypromotions">Promotions</a></li>
            <li><a href="pharmacyprofile">Profile</a></li>
            <li><button class="login-signup-btn" onclick="window.location.href='home'">Logout</button></li>
        </ul>
    </nav>

    <!-- Main Section -->
    <section class="main-section">
        <!-- Left Side - Image -->
        <div class="image-container">
            <img src="assets/images/pharmacy/pharma.png" alt="Pharmacy Image" style="width: 100%; height: auto; object-fit: cover;">
        </div>

        <!-- Right Side - Content -->
        <div class="content-container">
            <h1>Welcome to the Pharmacies Section</h1>
            <p>Manage patient prescriptions, process orders, and keep track of your pharmacy's activities seamlessly.</p>
        </div>
    </section>

    <footer class="footer">
        <p style="text-align: end;">&copy; 2024 Suwa-Connect. All rights reserved.</p>
    </footer>
</body>
</html>
