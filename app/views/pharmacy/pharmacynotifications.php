
<!DOCTYPE html>
<html lang="en">
<>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/pharmacyhome.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/css/doctor/navbarcssbhagya.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/pharmacy/pharmacydashboard.css">

    <title>Pharmacies Home - Suwa-Connect</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f7ff;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            margin-right: 20px;
        }

        .logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #0057d8;
        }

        .title h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 5px;
        }

        .title p {
            color: #555;
            font-size: 1rem;
        }

        .search-bar {
            margin: 20px 0;
            position: relative;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 20px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .search-bar button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #777;
            cursor: pointer;
        }

        .content-section {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .filter-section {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 25px;
        }

        .filter-btn {
            background-color: #f0f7ff;
            border: 1px solid #0057d8;
            border-radius: 20px;
            padding: 8px 15px;
            font-size: 0.9rem;
            color: #0057d8;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .filter-btn.active {
            background-color: #0057d8;
            color: white;
        }

        .filter-btn span {
            margin-left: 5px;
        }

        .notifications-list {
            margin-top: 20px;
        }

        .notification-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            display: grid;
            grid-template-columns: 180px 1fr 100px 100px;
            gap: 15px;
            align-items: center;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item.unread {
            background-color: #f0f7ff;
        }

        .notification-date {
            font-size: 0.9rem;
            color: #777;
        }

        .notification-content {
            display: flex;
            align-items: center;
        }

        .notification-icon {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .notification-text {
            font-size: 0.95rem;
        }

        .notification-text strong {
            font-weight: bold;
        }

        .notification-status {
            font-size: 0.85rem;
            padding: 4px 10px;
            border-radius: 12px;
            text-align: center;
        }

        .status-unread {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .status-read {
            background-color: #e0f2f1;
            color: #14b8a6;
        }

        .notification-actions {
            display: flex;
            justify-content: flex-end;
        }

        .action-btn {
            background-color: #0057d8;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            font-size: 0.85rem;
            cursor: pointer;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .left-actions {
            display: flex;
            gap: 10px;
        }

        .right-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .btn-primary {
            background-color: #0057d8;
            color: white;
            border: none;
        }

        .btn-outline {
            background-color: transparent;
            color: #0057d8;
            border: 1px solid #0057d8;
        }

        .btn span {
            margin-left: 5px;
        }

        .empty-state {
            text-align: center;
            padding: 50px 0;
            display: none;
        }

        .empty-state-icon {
            font-size: 3rem;
            color: #aaa;
            margin-bottom: 15px;
        }

        .empty-state-text {
            color: #777;
            font-size: 1.1rem;
            max-width: 400px;
            margin: 0 auto;
        }

        .preferences-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            display: none;
        }

        .modal-content {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            width: 500px;
            max-width: 90%;
        }

        .modal-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .close-modal {
            cursor: pointer;
            font-size: 1.5rem;
            color: #777;
        }

        .preference-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .preference-item:last-child {
            border-bottom: none;
        }

        .preference-title {
            font-weight: bold;
        }

        .toggle-options {
            display: flex;
            gap: 15px;
        }

        .toggle-item {
            display: flex;
            align-items: center;
        }

        .toggle-label {
            margin-left: 5px;
            font-size: 0.9rem;
            color: #555;
        }

        .modal-actions {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Toggle switch styling */
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #0057d8;
        }

        input:checked + .slider:before {
            transform: translateX(16px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .notification-item {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .notification-actions {
                justify-content: flex-start;
            }

            .action-buttons {
                flex-direction: column;
                gap: 10px;
            }

            .left-actions, .right-actions {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
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

    <li class="nav-item active">
            <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyHome" class="nav-link">
            <i class="material-icons-round">home</i> <span>Home</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyOrders" class="nav-link">
            <i class="material-icons-round">medical_services</i> <span> Orders </span>
        </a>

    <li class="nav-item">
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


    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="/api/placeholder/80/80" alt="Pharmacy Connect Logo">
            </div>
            <div class="title">
                <h1>Notifications Center</h1>
                <p>Stay informed about new prescription orders, order updates, and system alerts in real-time.</p>
            </div>
        </div>

        <div class="search-bar">
            <input type="text" placeholder="🔍 Search notifications by order ID, patient name, or doctor name...">
        </div>

        <div class="content-section">
            <h2 class="section-title">Notification Categories</h2>
            
            <div class="filter-section">
                <button class="filter-btn active">All</button>
                <button class="filter-btn">🆕 New Orders</button>
                <button class="filter-btn">✅ Order Confirmations</button>
                <button class="filter-btn">❌ Order Cancellations</button>
                <button class="filter-btn">💰 Payment Updates</button>
                <button class="filter-btn">⚙️ System Updates</button>
            </div>
            
            <div class="notifications-list">
                <div class="notification-item unread">
                    <div class="notification-date">2024-12-03, 10:30 AM</div>
                    <div class="notification-content">
                        <div class="notification-icon">🆕</div>
                        <div class="notification-text">
                            <strong>New Order Received</strong> - Prescription from Dr. Nimal Fernando for Dinithi Silva.
                        </div>
                    </div>
                    <div class="notification-status status-unread">Unread</div>
                    <div class="notification-actions">
                        <button class="action-btn">View Order</button>
                    </div>
                </div>
                
                <div class="notification-item">
                    <div class="notification-date">2024-12-03, 09:45 AM</div>
                    <div class="notification-content">
                        <div class="notification-icon">✅</div>
                        <div class="notification-text">
                            <strong>Order Confirmed</strong> - Order RX0012 has been successfully processed.
                        </div>
                    </div>
                    <div class="notification-status status-read">Read</div>
                    <div class="notification-actions">
                        <button class="action-btn">View Details</button>
                    </div>
                </div>
                
                <div class="notification-item unread">
                    <div class="notification-date">2024-12-02, 04:15 PM</div>
                    <div class="notification-content">
                        <div class="notification-icon">❌</div>
                        <div class="notification-text">
                            <strong>Order Canceled</strong> - Patient Dinithi Silva canceled RX0015.
                        </div>
                    </div>
                    <div class="notification-status status-unread">Unread</div>
                    <div class="notification-actions">
                        <button class="action-btn">View Details</button>
                    </div>
                </div>
                
                <div class="notification-item">
                    <div class="notification-date">2024-12-01, 01:30 PM</div>
                    <div class="notification-content">
                        <div class="notification-icon">💰</div>
                        <div class="notification-text">
                            <strong>Payment Received</strong> - LKR 3,500 for RX0010.
                        </div>
                    </div>
                    <div class="notification-status status-read">Read</div>
                    <div class="notification-actions">
                        <button class="action-btn">View Transaction</button>
                    </div>
                </div>
                
                <div class="notification-item unread">
                    <div class="notification-date">2024-11-30, 11:00 AM</div>
                    <div class="notification-content">
                        <div class="notification-icon">⚙️</div>
                        <div class="notification-text">
                            <strong>System Update</strong> - Platform maintenance scheduled for 2024-12-05, 02:00 AM.
                        </div>
                    </div>
                    <div class="notification-status status-unread">Unread</div>
                    <div class="notification-actions">
                        <button class="action-btn">View Details</button>
                    </div>
                </div>
            </div>
            
            <div class="empty-state" id="emptyState">
                <div class="empty-state-icon">📭</div>
                <div class="empty-state-text">
                    No new notifications at the moment. Check back later or update your notification preferences.
                </div>
            </div>
            
            <div class="action-buttons">
                <div class="left-actions">
                    <button class="btn btn-outline" id="markAllReadBtn">✅ Mark All as Read</button>
                    <button class="btn btn-outline">❌ Delete Selected</button>
                </div>
                <div class="right-actions">
                    <button class="btn btn-outline">📥 Export Notifications</button>
                    <button class="btn btn-primary" id="preferencesBtn">📅 Set Notification Preferences</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Notification Preferences Modal -->
    <div class="preferences-modal" id="preferencesModal">
        <div class="modal-content">
            <div class="modal-title">
                <span>Notification Preferences</span>
                <span class="close-modal" id="closeModal">&times;</span>
            </div>
            
            <div class="preference-item">
                <div class="preference-title">New Orders</div>
                <div class="toggle-options">
                    <div class="toggle-item">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                        <span class="toggle-label">Email</span>
                    </div>
                    <div class="toggle-item">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                        <span class="toggle-label">SMS</span>
                    </div>
                </div>
            </div>
            
            <div class="preference-item">
                <div class="preference-title">Order Confirmations</div>
                <div class="toggle-options">
                    <div class="toggle-item">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                        <span class="toggle-label">Email</span>
                    </div>
                    <div class="toggle-item">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                        <span class="toggle-label">SMS</span>
                    </div>
                </div>
            </div>
            
            <div class="preference-item">
                <div class="preference-title">Order Cancellations</div>
                <div class="toggle-options">
                    <div class="toggle-item">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                        <span class="toggle-label">Email</span>
                    </div>
                    <div class="toggle-item">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                        <span class="toggle-label">SMS</span>
                    </div>
                </div>
            </div>
            
            <div class="preference-item">
                <div class="preference-title">Payment Updates</div>
                <div class="toggle-options">
                    <div class="toggle-item">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                        <span class="toggle-label">Email</span>
                    </div>
                    <div class="toggle-item">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                        <span class="toggle-label">SMS</span>
                    </div>
                </div>
            </div>
            
            <div class="preference-item">
                <div class="preference-title">System Updates</div>
                <div class="toggle-options">
                    <div class="toggle-item">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                        <span class="toggle-label">Email</span>
                    </div>
                    <div class="toggle-item">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                        <span class="toggle-label">SMS</span>
                    </div>
                </div>
            </div>
            
            <div class="preference-item">
                <div class="preference-title">Sound & Pop-up Alerts</div>
                <div class="toggle-options">
                    <div class="toggle-item">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                        <span class="toggle-label">Enable</span>
                    </div>
                </div>
            </div>
            
            <div class="modal-actions">
                <button class="btn btn-outline">Cancel</button>
                <button class="btn btn-primary">Save Preferences</button>
            </div>
        </div>
    </div>

    <script>
        // Toggle filter buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Simulate filtering (in a real app, this would filter the notifications)
                // For demonstration, we'll show the empty state when clicking on certain filters
                if (this.textContent.includes('Order Cancellations')) {
                    document.querySelector('.notifications-list').style.display = 'none';
                    document.getElementById('emptyState').style.display = 'block';
                } else {
                    document.querySelector('.notifications-list').style.display = 'block';
                    document.getElementById('emptyState').style.display = 'none';
                }
            });
        });
        
        // Mark all as read functionality
        document.getElementById('markAllReadBtn').addEventListener('click', function() {
            document.querySelectorAll('.notification-item.unread').forEach(item => {
                item.classList.remove('unread');
                const status = item.querySelector('.notification-status');
                status.textContent = 'Read';
                status.classList.remove('status-unread');
                status.classList.add('status-read');
            });
        });
        
        // Individual notification status toggle
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function(e) {
                // Don't toggle if clicking on the action button
                if (e.target.classList.contains('action-btn')) return;
                
                const status = this.querySelector('.notification-status');
                if (this.classList.contains('unread')) {
                    this.classList.remove('unread');
                    status.textContent = 'Read';
                    status.classList.remove('status-unread');
                    status.classList.add('status-read');
                }
            });
        });
        
        // Preferences modal functionality
        const modal = document.getElementById('preferencesModal');
        const openModalBtn = document.getElementById('preferencesBtn');
        const closeModalBtn = document.getElementById('closeModal');
        
        openModalBtn.addEventListener('click', function() {
            modal.style.display = 'flex';
        });
        
        closeModalBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
        
        // Close modal if clicking outside of it
        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
        
        // Search functionality
        const searchInput = document.querySelector('.search-bar input');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const notificationItems = document.querySelectorAll('.notification-item');
            
            notificationItems.forEach(item => {
                const text = item.querySelector('.notification-text').textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show empty state if no results
            const hasVisibleItems = Array.from(notificationItems).some(item => item.style.display !== 'none');
            if (!hasVisibleItems) {
                document.getElementById('emptyState').style.display = 'block';
            } else {
                document.getElementById('emptyState').style.display = 'none';
            }
        });
    </script>
</body>
</html>