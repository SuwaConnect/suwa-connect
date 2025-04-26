<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/admin/revenue.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/admin/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>assets/css/admin/navbar.css">


    <link rel="stylesheet" href="./css/dashboard.css">

    <title>Suwa-Connect</title>
</head>

<body>
    <?php include 'adminNavbar.php'?>
    <div class="main-content">

    <!-- Header Section -->
        <header>
            <h1>Revenue Management</h1>
            <p>Monitor and manage revenue streams across healthcare providers, laboratories, and pharmacies.</p>
            <div class="search-bar">
                <input type="text" placeholder="Search by transaction ID, user, or service...">
            </div>
            <div class="quick-actions">
                <button>Export Revenue Data</button>
                <button>Generate Invoice</button>
            </div>
        </header>
    
        <!-- Revenue Overview Section -->
        <section class="overview">
            <div class="overview-item">
                <h2>LKR 5,000,000</h2>
                <p>Total Revenue Generated</p>
            </div>
            <div class="overview-item">
                <h2>LKR 3,000,000</h2>
                <p>Revenue from Appointments</p>
            </div>
            <div class="overview-item">
                <h2>LKR 1,200,000</h2>
                <p>Revenue from Laboratories</p>
            </div>
            <div class="overview-item">
                <h2>LKR 800,000</h2>
                <p>Revenue from Pharmacies</p>
            </div>
        </section>
    
        <!-- Revenue Breakdown Section -->
        <section class="breakdown">
            <h3>Revenue Breakdown</h3>
            <div class="breakdown-item">
                <h4>Revenue by Service</h4>
                <p>Consultations: LKR 3,000,000 | Lab Tests: LKR 1,200,000 | Pharmacy Sales: LKR 800,000</p>
            </div>
            <div class="breakdown-item">
                <h4>Revenue by Time Period</h4>
                <p>Revenue Generated in Last 30 Days: LKR 500,000</p>
            </div>
            <div class="breakdown-item">
                <h4>Revenue by Healthcare Provider</h4>
                <p>Dr. Ruwan Silva: LKR 1,200,000 | Dr. Saman Kumara: LKR 900,000</p>
            </div>
            <div class="breakdown-item">
                <h4>Revenue by Laboratory</h4>
                <p>Asiri Labs: LKR 500,000 | Lanka Hospitals Labs: LKR 400,000</p>
            </div>
            <div class="breakdown-item">
                <h4>Revenue by Pharmacy</h4>
                <p>ABC Pharmacy: LKR 300,000 | XYZ Pharmacy: LKR 250,000</p>
            </div>
        </section>
    
        <!-- Revenue Trends Section -->
        <section class="trends">
            <h3>Revenue Trends</h3>
            <div class="trend-chart" id="monthlyRevenueChart">
                <!-- Monthly Revenue Growth Chart -->
            </div>
            <div class="trend-chart" id="serviceSpecificRevenueChart">
                <!-- Service-Specific Revenue Trends Chart -->
            </div>
            <div class="top-services">
                <h4>Top Performing Services</h4>
                <ul>
                    <li>In-person Consultations: LKR 1,500,000</li>
                    <li>Online Consultations: LKR 1,200,000</li>
                </ul>
            </div>
        </section>
    
        <!-- Payment Details Section -->
        <section class="payment-details">
            <h3>Recent Transactions</h3>
            <table>
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Service Name</th>
                        <th>Amount Paid</th>
                        <th>User Name</th>
                        <th>Provider</th>
                        <th>Date & Time</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody id="transactionTableBody">
                    <!-- Transactions Data Will be Populated Here by JS -->
                </tbody>
            </table>
        </section>
    
        <!-- Footer Section -->
        <footer>
            <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
            <a href="#"></a>
        </footer> 
        
    </div>

    
    <script src="<?php echo URLROOT?>public\js\doctor\js\navbar.js"></script>
    <script src="./js/revenue.js"></script>
</body>

</html>
