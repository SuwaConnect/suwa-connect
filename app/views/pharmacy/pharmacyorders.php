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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/css/doctor/navbarcssbhagya.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/pharmacy/pharmacydashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/pharmacy/pharmacyorders.css">

    <title>Pharmacies Home - Suwa-Connect</title>
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

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <button class="back-button">
                <span>←</span>
            </button>
            <div class="header-text">
                <h1>Prescription Orders</h1>
                <p>Manage incoming orders from patients through Suwa Connect.</p>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Search by patient name, doctor name, or order ID...">
            <span class="search-icon">🔍</span>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="btn btn-primary">
                <span>➕</span>
                <span>Create New Order</span>
            </button>
            <button class="btn btn-outline">
                <span>📥</span>
                <span>Export Orders</span>
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-title">Total Orders</div>
                <div class="stat-value">3,450</div>
                <div class="stat-label">Total Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Pending Orders</div>
                <div class="stat-value">582</div>
                <div class="stat-label">Pending Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Confirmed Orders</div>
                <div class="stat-value">2,758</div>
                <div class="stat-label">Confirmed Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Declined Orders</div>
                <div class="stat-value">110</div>
                <div class="stat-label">Declined Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Today's Orders</div>
                <div class="stat-value">45</div>
                <div class="stat-label">Today's Orders</div>
            </div>
        </div>

        <!-- Orders List Section -->
        <div class="orders-list-section">
            <div class="orders-list-header">
                <h2>Orders List</h2>
                <div class="filters-row">
                    <select class="filter-select">
                        <option>Filter by Status</option>
                        <option>Pending</option>
                        <option>Confirmed</option>
                        <option>Declined</option>
                    </select>
                    <select class="filter-select">
                        <option>Filter by Doctor</option>
                        <option>Dr. Nimal Fernando</option>
                        <option>Dr. Kumari Silva</option>
                        <option>Dr. Anura Perera</option>
                    </select>
                    <input type="date" class="date-input" placeholder="Select Date">
                    <select class="filter-select">
                        <option>Sort by</option>
                        <option>Most Recent</option>
                        <option>Doctor Name</option>
                        <option>Patient Name</option>
                    </select>
                </div>
            </div>

            <!-- Desktop View: Orders Table -->
            <div class="desktop-orders-view">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Patient Name</th>
                            <th>Doctor Name</th>
                            <th>Prescription Summary</th>
                            <th>Address</th>
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
                            <td>No. 44, Kandy Rd, Gampaha</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <div class="action-buttons-cell">
                                    <button class="action-btn action-btn-view">View</button>
                                    <button class="action-btn action-btn-confirm">Confirm</button>
                                    <button class="action-btn action-btn-decline">Decline</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>RX0013</td>
                            <td>Saman Perera</td>
                            <td>Dr. Kumari Silva</td>
                            <td>Metformin 500mg x 30 days</td>
                            <td>34/2, Main St, Colombo 5</td>
                            <td><span class="status-badge status-confirmed">Confirmed</span></td>
                            <td>
                                <div class="action-buttons-cell">
                                    <button class="action-btn action-btn-view">View</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>RX0014</td>
                            <td>Malini Gunasekara</td>
                            <td>Dr. Anura Perera</td>
                            <td>Atorvastatin 20mg x 28 days</td>
                            <td>72, Beach Road, Negombo</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <div class="action-buttons-cell">
                                    <button class="action-btn action-btn-view">View</button>
                                    <button class="action-btn action-btn-confirm">Confirm</button>
                                    <button class="action-btn action-btn-decline">Decline</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>RX0015</td>
                            <td>Rohan Fernando</td>
                            <td>Dr. Nimal Fernando</td>
                            <td>Omeprazole 20mg x 14 days</td>
                            <td>12/A, Temple Lane, Dehiwala</td>
                            <td><span class="status-badge status-declined">Declined</span></td>
                            <td>
                                <div class="action-buttons-cell">
                                    <button class="action-btn action-btn-view">View</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>RX0016</td>
                            <td>Nadeeka Jayawardena</td>
                            <td>Dr. Kumari Silva</td>
                            <td>Amlodipine 5mg x 30 days</td>
                            <td>55, Hill Road, Kandy</td>
                            <td><span class="status-badge status-confirmed">Confirmed</span></td>
                            <td>
                                <div class="action-buttons-cell">
                                    <button class="action-btn action-btn-view">View</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile View: Order Cards -->
            <div class="mobile-orders-container">
                <div class="order-card">
                    <div class="order-card-header">
                        <div class="order-id">RX0012</div>
                        <div class="order-status status-badge status-pending">Pending</div>
                    </div>
                    <div class="order-info-row">
                        <div class="order-info-label">Patient Name:</div>
                        <div class="order-info-value">Dinithi Silva</div>
                    </div>
                    <div class="order-info-row">
                        <div class="order-info-label">Doctor Name:</div>
                        <div class="order-info-value">Dr. Nimal Fernando</div>
                    </div>
                    <div class="order-medicines">
                        <div class="medicine-item">• Amoxil 500mg – 14 tabs</div>
                        <div class="medicine-item">• Paracetamol 500mg – 10 tabs</div>
                    </div>
                    <div class="order-info-row">
                        <div class="order-info-label">Delivery Address:</div>
                        <div class="order-info-value">No. 44, Kandy Rd, Gampaha</div>
                    </div>
                    <div class="order-info-row">
                        <div class="order-info-label">Prescription Date:</div>
                        <div class="order-info-value">2024-12-03</div>
                    </div>
                    <div class="order-card-actions">
                        <button class="action-btn action-btn-view">View Full</button>
                        <button class="action-btn action-btn-confirm">Confirm</button>
                        <button class="action-btn action-btn-decline">Decline</button>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-card-header">
                        <div class="order-id">RX0013</div>
                        <div class="order-status status-badge status-confirmed">Confirmed</div>
                    </div>
                    <div class="order-info-row">
                        <div class="order-info-label">Patient Name:</div>
                        <div class="order-info-value">Saman Perera</div>
                    </div>
                    <div class="order-info-row">
                        <div class="order-info-label">Doctor Name:</div>
                        <div class="order-info-value">Dr. Kumari Silva</div>
                    </div>
                    <div class="order-medicines">
                        <div class="medicine-item">• Metformin 500mg – 30 tabs</div>
                    </div>
                    <div class="order-info-row">
                        <div class="order-info-label">Delivery Address:</div>
                        <div class="order-info-value">34/2, Main St, Colombo 5</div>
                    </div>
                    <div class="order-info-row">
                        <div class="order-info-label">Prescription Date:</div>
                        <div class="order-info-value">2024-12-02</div>
                    </div>
                    <div class="order-card-actions">
                        <button class="action-btn action-btn-view">View Full</button>
                    </div>
                </div>
            </div>

            <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

            </div>
            </div>
            </body>
            </html>


  