<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/pharmacyhome.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/pharmacy/dashboard.css">

    <title>Pharmacies Home - Suwa-Connect</title>
</head>
<body>
  
<?php include 'pharmacyNavBar.php'?>

    
     <div class="main-content">
       <main class="content">
            <!-- Dashboard Page -->
            <section id="dashboard" class="page active">
                <header class="page-header">
                    <h1>Welcome to Your Pharmacy Dashboard</h1>
                    <p>Manage your prescription orders and pharmacy profile with ease.</p>
                </header>

                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-prescription"></i></div>
                        <div class="stat-info">
                            <h3>120</h3>
                            <p>Total Orders Received</p>
                            <small>Total prescriptions received via Suwa Connect.</small>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon pending"><i class="fas fa-clock"></i></div>
                        <div class="stat-info">
                            <h3>35</h3>
                            <p>Pending Orders</p>
                            <small>Awaiting confirmation.</small>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon completed"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info">
                            <h3>80</h3>
                            <p>Completed Orders</p>
                            <small>Successfully dispensed medications.</small>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon declined"><i class="fas fa-times-circle"></i></div>
                        <div class="stat-info">
                            <h3>5</h3>
                            <p>Declined Orders</p>
                            <small>Orders declined due to unavailability or other reasons.</small>
                        </div>
                    </div>
                </div>

                <div class="quick-actions">
                    <div class="search-bar">
                        <input type="text" placeholder="Search orders by patient name or prescription ID">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                    <div class="action-buttons">
                        <button class="btn primary"><i class="fas fa-calendar-day"></i> View Today's Orders</button>
                        <button class="btn secondary"><i class="fas fa-file-export"></i> Export Order History</button>
                    </div>
                </div>

                <div class="recent-orders">
                    <h2>Recent Orders</h2>
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Prescription Summary</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>RX0012</td>
                                <td>Dinithi Silva</td>
                                <td>Dr. Nimal Fernando</td>
                                <td>Amoxil 500mg x 14 days</td>
                                <td><span class="status pending">Pending</span></td>
                                <td>
                                    <button class="btn-sm view"><i class="fas fa-eye"></i></button>
                                    <button class="btn-sm confirm"><i class="fas fa-check"></i></button>
                                    <button class="btn-sm decline"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>RX0011</td>
                                <td>Kumar Perera</td>
                                <td>Dr. Samanthi Dias</td>
                                <td>Metformin 500mg x 30 days</td>
                                <td><span class="status confirmed">Confirmed</span></td>
                                <td>
                                    <button class="btn-sm view"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>RX0010</td>
                                <td>Anura Bandara</td>
                                <td>Dr. Nimal Fernando</td>
                                <td>Atorvastatin 20mg x 30 days</td>
                                <td><span class="status completed">Completed</span></td>
                                <td>
                                    <button class="btn-sm view"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

    <footer class="footer">
        <p style="text-align: end;">&copy; 2024 Suwa-Connect. All rights reserved.</p>
    </footer>
    </div>

    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

</body>
</html>
