<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/pharmacyprofile.css">
  <link rel="stylesheet" href="assets/css/pharmacynavbar.css">
    <title>Pharmacy Registration</title>
</head>

<body>
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
                <li class="nav-item">
                    <a href="pharmacypromotions" class="nav-link">
                        <i class="material-icons-round">local_offer</i> <span>Promotions</span>
                </a>
                <li class="nav-item active">
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
            <div class="form-container">
                <h1>Pharmacy Registration</h1>
                <p>Please fill in the details below to register your pharmacy with our system.</p>

                <form action="#" method="POST" enctype="multipart/form-data">
                    <!-- User Account Details -->
                    <section>
                        <h2>1. Account Details</h2>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required placeholder="Enter username">

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required placeholder="Enter email">
                    </section>

                    <!-- General Pharmacy Details -->
                    <section>
                        <h2>2. General Details</h2>
                        <label for="pharmacy-name">Pharmacy Name:</label>
                        <input type="text" id="pharmacy-name" name="pharmacy-name" required placeholder="Enter pharmacy name">

                        <label for="address">Address:</label>
                        <textarea id="address" name="address" required placeholder="Enter pharmacy address"></textarea>

                        <label for="telephone">Telephone:</label>
                        <input type="tel" id="telephone" name="telephone" required placeholder="Enter telephone number">

                        <label for="pharmacy-reg">Pharmacy Registration Number:</label>
                        <input type="text" id="pharmacy-reg" name="pharmacy-reg" required placeholder="Enter registration number">

                        <label for="pharmacy-certificate">Upload Pharmacy Registration Certificate (JPEG/PNG):</label>
                        <input type="file" id="pharmacy-certificate" name="pharmacy-certificate" accept=".jpeg, .png" required>
                    </section>

                    <!-- Pharmacist in Charge Details -->
                    <section>
                        <h2>3. Pharmacist in Charge Details</h2>
                        <label for="pharmacist-name">Pharmacist Name:</label>
                        <input type="text" id="pharmacist-name" name="pharmacist-name" required placeholder="Enter pharmacist name">

                        <label for="nic">NIC Number:</label>
                        <input type="text" id="nic" name="nic" required placeholder="Enter NIC number">

                        <label for="contact">Contact Number:</label>
                        <input type="tel" id="contact" name="contact" required placeholder="Enter contact number">

                        <label for="pharmacist-reg">Pharmacist Registration Number:</label>
                        <input type="text" id="pharmacist-reg" name="pharmacist-reg" required placeholder="Enter registration number">

                        <label for="pharmacist-certificate">Upload Pharmacist Registration Certificate (JPEG/PNG):</label>
                        <input type="file" id="pharmacist-certificate" name="pharmacist-certificate" accept=".jpeg, .png" required>
                    </section>

                    <button type="submit">Register Pharmacy</button>
                </form>
            </div>
        </main>
    </div>
    <script>
        // JavaScript for toggling the sidebar
document.getElementById("toggleSidebar").addEventListener("click", function () {
    document.querySelector(".sidebar").classList.toggle("collapsed");
    
    // Rotate the chevron icon based on sidebar state
    const toggleIcon = document.querySelector('.toggle-btn i');
    toggleIcon.textContent = toggleIcon.textContent === 'chevron_left' ? 'chevron_right' : 'chevron_left';
});
    </script>
</body>

</html>
