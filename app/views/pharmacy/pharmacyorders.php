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
    <!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/pharmacy/pharmacydashboard.css"> -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/pharmacy/pharmacyorders.css">
    <style>
        /* Modal styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border-radius: 8px;
    width: 70%;
    max-width: 800px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.close-modal {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close-modal:hover {
    color: #000;
}

#modal-prescription-content {
    margin-top: 20px;
}

.prescription-detail-row {
    display: flex;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.prescription-detail-label {
    width: 40%;
    font-weight: bold;
}

.prescription-detail-value {
    width: 60%;
}
    </style>

    <title>Pharmacies Home - Suwa-Connect</title>
</head>
<body>
  <?php include 'pharmacyNavBar.php'?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            
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
                <div class="stat-value"><?php if (isset($data['total_orders'])) {echo $data['total_orders'];} else {echo '0';}?></div>
                <div class="stat-label">Total Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Pending Orders</div>
                <div class="stat-value"><?php if (isset($data['orders_pending'])) {echo $data['orders_pending'];} else {echo '0';}?></div>
                <div class="stat-label">Pending Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Confirmed Orders</div>
                <div class="stat-value"><?php if (isset($data['completed_orders'])) {echo $data['completed_orders'];} else {echo '0';}?></div>
                <div class="stat-label">Confirmed Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Declined Orders</div>
                <div class="stat-value"><?php if (isset($data['cancelled_orders'])) {echo $data['cancelled_orders'];} else {echo '0';}?></div>
                <div class="stat-label">Declined Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Today's Orders</div>
                <div class="stat-value"><?php if (isset($data['today_orders'])) {echo $data['today_orders'];} else {echo '0';}?></div>
                <div class="stat-label">Today's Orders</div>
            </div>
        </div>

        <!-- Orders List Section -->
        <div class="orders-list-section">
            <div class="orders-list-header">
                <h2>Orders List</h2>
                
            </div>

            <!-- Desktop View: Orders Table -->
            <div class="desktop-orders-view">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Patient Name</th>
                            <!-- <th>Doctor Name</th> -->
                           
                            <th>contact no</th>
                             <th>Delivery method</th>
                             <th>Address</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
    <?php if(isset($data['orders']) && !empty($data['orders'])): ?>
        <?php foreach($data['orders'] as $order): ?>
            <tr>
                <td><?php echo $order->order_id; ?></td>
                <td><?php echo $order->first_name.' '.$order->last_name; ?></td>
                <td><?php echo $order->address; ?></td>
                <td><?php echo $order->delivery_method?></td>
                <td><?php echo $order->contact_no;?></td>
                <td>
                    <span class="status-badge status-">
                        
                    </span>
                </td>
                <td>
                    <div class="action-buttons-cell">
                        <button class="action-btn action-btn-view" data-order-id="<?php echo $order->order_id; ?>">View</button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7" class="no-orders-message">No orders available</td>
        </tr>
    <?php endif; ?>
</tbody>
                    </tbody>
                </table>
            </div>
            <div id="prescriptionModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2>Prescription Details</h2>
        <div id="modal-prescription-content">
            <!-- Prescription details will be loaded here -->
        </div>
    </div>
</div>

           

            <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('prescriptionModal');
    const modalContent = document.getElementById('modal-prescription-content');
    const closeModalBtn = document.querySelector('.close-modal');
    
    // Close modal when clicking on X
    closeModalBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    
    // Close modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
    
    // Add event listeners to all view buttons
    const viewButtons = document.querySelectorAll('.action-btn-view');
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            fetchPrescriptionDetails(orderId);
        });
    });
    
    // Function to fetch prescription details via AJAX
    function fetchPrescriptionDetails(orderId) {
        // Show loading indicator
        modalContent.innerHTML = '<p>Loading prescription details...</p>';
        modal.style.display = 'block';
        
        // Fetch prescription details from server
        fetch(`<?php echo URLROOT; ?>pharmacyController/getPrescriptionDetails/${orderId}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            displayPrescriptionDetails(data);
        })
        .catch(error => {
            modalContent.innerHTML = `<p class="error">Error loading prescription details: ${error.message}</p>`;
        });
    }
    
    // Function to display prescription details in the modal
    function displayPrescriptionDetails(data) {
        let html = `
            <div class="prescription-details">
                <div class="prescription-detail-row">
                    <div class="prescription-detail-label">Order ID:</div>
                    <div class="prescription-detail-value">${data.order_id}</div>
                </div>
                <div class="prescription-detail-row">
                    <div class="prescription-detail-label">Patient:</div>
                    <div class="prescription-detail-value">${data.patient_details.first_name} ${data.patient_details.last_name}</div>
                </div>
                <div class="prescription-detail-row">
                    <div class="prescription-detail-label">Address:</div>
                    <div class="prescription-detail-value">${data.patient_details.address}</div>
                </div>
                <div class="prescription-detail-row">
                    <div class="prescription-detail-label">Status:</div>
                    <div class="prescription-detail-value">${data.order_details.order_status}</div>
                </div>
                <div class="prescription-detail-row">
                    <div class="prescription-detail-label">Date:</div>
                    <div class="prescription-detail-value">${data.order_details.created_at}</div>
                </div>
                <h3>Medications</h3>
        `;
        
        // Add medications if available
        if (data.medicines && data.medicines.length > 0) {
            html += '<ul class="medications-list">';
            data.medicines.forEach(med => {
                html += `<li>${med.name} - ${med.dosage} </li>`;
            });
            html += '</ul>';
        } else {
            html += '<p>No medication details available</p>';
        }
        
        // Add action buttons if needed
        html += `
            <div class="modal-actions">
                <button class="btn btn-primary" id="confirm-order" data-order-id="${data.order_id}">Confirm Order</button>
                <button class="btn btn-danger" id="decline-order" data-order-id="${data.order_id}">Decline Order</button>
            </div>
        `;
        
        html += '</div>';
        
        modalContent.innerHTML = html;
        
        // Add event listeners for new action buttons
        document.getElementById('confirm-order').addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            updateOrderStatus(orderId, 'confirmed');
        });
        
        document.getElementById('decline-order').addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            updateOrderStatus(orderId, 'declined');
        });
    }
    
    // Function to update order status
    function updateOrderStatus(orderId, status) {
        fetch(`<?php echo URLROOT; ?>pharmacyController/updateOrderStatus`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ orderId, status })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Close modal
                modal.style.display = 'none';
                // Refresh page to show updated status
                location.reload();
            } else {
                throw new Error(data.message || 'Failed to update order status');
            }
        })
        .catch(error => {
            alert(`Error: ${error.message}`);
        });
    }
});
            </script>

            </div>
            </div>
            </body>
            </html>


  