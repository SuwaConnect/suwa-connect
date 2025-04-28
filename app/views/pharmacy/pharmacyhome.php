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
                        <h3><?php if (isset($data['total_orders'])) {echo $data['total_orders'];} else {echo 'no orders';}
                        ?></h3>
                            <p>Total Orders Received</p>
                            <small>Total prescriptions received via Suwa Connect.</small>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon pending"><i class="fas fa-clock"></i></div>
                        <div class="stat-info">
                            <h3><?php if (isset($data['pending_orders'])) {echo $data['pending_orders'];} else {echo 'no orders';}?></h3>
                            <p>Pending Orders</p>
                            <small>Awaiting confirmation.</small>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon completed"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info">
                            <h3><?php if (isset($data['completed_orders'])) {echo $data['completed_orders'];} else {echo 'no orders';}?></h3>
                            <p>Completed Orders</p>
                            <small>Successfully dispensed medications.</small>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon declined"><i class="fas fa-times-circle"></i></div>
                        <div class="stat-info">
                            <h3><?php if (isset($data['cancelled_orders'])) {echo $data['cancelled_orders'];} else {echo 'no orders';}?></h3>
                            <p>Declined Orders</p>
                            <small>Orders declined due to unavailability or other reasons.</small>
                        </div>
                    </div>
                </div>

                

                <div class="recent-orders">
                    <h2>Recent Orders</h2>
                    <table class="orders-table">
                    <thead>
            <tr>
                <th>Order ID</th>
                <th>Patient Name</th>
                <th>Delivery method</th>
               
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($data)): ?>
                <tr>
                    <td colspan="6" class="text-center">No orders found</td>
                </tr>
            <?php else: ?>
                <?php foreach($data['unprocessed_orders'] as $order): ?>
                    <tr data-order-id="<?php echo $order->order_id; ?>"
                        data-patient-id="<?php echo $order->patient_id; ?>"
                        data-record-id="<?php echo $order->record_id; ?>">
                        <td><?php echo $order->order_id; ?></td>
                        <td><?php echo $order->first_name.' '.$order->last_name; ?></td>
                        <td><?php echo $order->delivery_method; ?></td>
                        <td>
                            <span class="status <?php echo $order->order_status; ?>">
                                <?php echo $order->order_status; ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn-sm view" onclick="viewPrescription('<?php echo $order->record_id; ?>', '<?php echo $order->order_id; ?>')">
                                <i class="fas fa-eye"></i> View
                            </button>
                            
                            
                                <button class="btn-sm process" onclick="markAsProcessed('<?php echo $order->order_id; ?>')">
                                    <i class="fas fa-check"></i> Process
                                </button>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
                    </table>
                </div>

                
            </section>

    <footer class="footer">
        <p style="text-align: end;">&copy; 2024 Suwa-Connect. All rights reserved.</p>
    </footer>
    </div>

    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
    <script>

                  /**
 * Simple function to view a prescription
 * @param {string} recordId - The ID of the medical record
 * @param {string} orderId - The ID of the order
 */
function viewPrescription(recordId, orderId) {
  alert("Loading prescription for Order #" + orderId);
  
  fetch("<?php echo URLROOT?>/pharmacyController/getPrescriptionDetails/" + orderId)
    .then(function(response) {
      return response.json();
    })
    .then(function(data) {
      // Create a simple message with prescription details
      var message = "Prescription Details for Order #" + orderId + "\n\n";
      
      // Add patient information if available
      if (data.patient_details) {
        message += "Patient: " + data.patient_details.first_name + " " + data.patient_details.last_name + "\n\n";
      }
      
      message += "Medications:\n";
      
      // Add each medication to the message
      for (var i = 0; i < data.medicines.length; i++) {
        var med = data.medicines[i];
        message += "- " + med.name + "\n";
      }
      
      // Show the prescription details
      alert(message);
    })
    .catch(function(error) {
      console.error("Error loading prescription:", error);
      alert("Could not load the prescription. Please try again.");
    });
}

/**
 * Simple function to mark an order as processed
 * @param {string} orderId - The ID of the order to process
 */
function markAsProcessed(orderId) {
  var confirmed = confirm("Are you sure you want to mark Order #" + orderId + " as processed?");
  
  if (confirmed) {
    var data = new FormData();
    data.append("order_id", orderId);
    
    fetch("<?php echo URLROOT;?>pharmacyController/markOrderAsProcessed", {
      method: "POST",
      body: data
    })
    .then(function(response) {
      return response.json();
    })
    .then(function(result) {
      if (result.success) {
        alert("Order #" + orderId + " has been processed successfully!");
        
        var orderRow = document.querySelector("tr[data-order-id='" + orderId + "']");
        if (orderRow) {
          var statusCell = orderRow.querySelector("td:nth-child(4) .status");
          if (statusCell) {
            statusCell.textContent = "Processed";
            statusCell.className = "status completed";
          }
          
          var processButton = orderRow.querySelector(".process");
          if (processButton) {
            processButton.remove();
          }
        }
      } else {
        alert("Could not process the order. Please try again.");
      }
    })
    .catch(function(error) {
      console.error("Error processing order:", error);
      alert("Could not process the order. Please try again.");
    });
  }
}


    </script>

</body>
</html>
