<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Prescription to Pharmacy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            /* max-width: 800px; */
            margin: 0 auto;
            /* padding: 20px; */
            color: #333;
        }

        /* *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    list-style: none;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
    
} */

        body{
    display: flex;
    /* height: 100vh; */
    overflow-x: hidden;
    overflow-y: auto;
}
        
       

        .sideBar.collapsed + .main-content{
            margin-left:80px;
            width: calc(100% - 80px);
            overflow-y: auto;
            }

            .main-content {
    background-color: #e6f2ff;
    color:#2e2e2e;
    padding: 20px;
    margin-left: 250px; /* To make space for the sidebar */
    padding: 20px;
    width: calc(100% - 250px); /* Take the remaining width */
    overflow-y: auto; /* Enable scrolling if content overflows vertically */
    flex-grow: 1;
    transition: margin-left 0.3s ease, width 0.3s ease; /* Smooth transition for content resize */
    display: flex;
    justify-content: center;
}
   
        .container {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 80%;
            
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        
        .medication-list {
            margin-bottom: 30px;
        }
        
        .medication-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 5px;
        }
        
        .medication-info {
            flex-grow: 1;
        }
        
        .medication-name {
            font-weight: bold;
            color: #2980b9;
        }
        
        .medication-dosage {
            color: #555;
            font-size: 0.9em;
        }
        
        .remove-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
        }
        
        .remove-btn:hover {
            background-color: #c0392b;
        }
        
        .notes-section {
            margin-bottom: 20px;
        }
        
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
            min-height: 80px;
        }
        
        .delivery-options {
            margin-bottom: 20px;
        }
        
        .option-label {
            display: block;
            margin-bottom: 10px;
        }
        
        .submit-btn {
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        
        .submit-btn:hover {
            background-color: #219653;
        }
        
        .empty-list {
            padding: 20px;
            text-align: center;
            color: #777;
            font-style: italic;
        }

        #popup {
  display: none;
  position: fixed;
  top: 20px;
  right: 20px;
  background:rgb(63, 111, 255);
  color: white;
  padding: 15px 20px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.2);
  font-family: Arial, sans-serif;
  z-index: 9999;
}
    </style>
</head>
<body>
    <?php include 'navbar-patient.php'?>
    <div class="main-content">
    <div class="container">
        <h1>Send Prescription to Pharmacy</h1>
        
        <div class="medication-list">
            <h2>Your Medications</h2>
          
            <?php foreach ($data['medicines'] as $medicine): ?>
                <div class="medication-item" >
                    <div class="medication-info">
                        <div class="medication-name"><?= htmlspecialchars($medicine->name) ?></div>
                        <div class="medication-dosage"><?= htmlspecialchars($medicine->dosage) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if (empty($data['medicines'])): ?>
                <div class="empty-list">No medications in the prescription</div>
            <?php endif; ?>
        </div>
        
        <div class="notes-section">
            <h2>Special Instructions for Pharmacist</h2>
            <textarea placeholder="Add any special notes or instructions for the pharmacist here..."></textarea>
        </div>
        
        <div class="delivery-options">
            <h2>Delivery Method</h2>
            <label class="option-label">
                <input type="radio" name="delivery" value="pickup" checked> I will pick up my medications
            </label>
            <label class="option-label">
                <input type="radio" name="delivery" value="delivery"> Please deliver my medications
            </label>
        </div>
        
        <button class="submit-btn" onclick="submitPrescription()">Send to Pharmacy</button>
    </div>
    </div>
    <div id="popup">Order placed successfully!</div>
    

    <script>
        
        
        function checkEmptyList() {
            let list = document.querySelector('.medication-list');
            let items = list.querySelectorAll('.medication-item');
            
            if (items.length === 0) {
                let emptyMessage = document.createElement('div');
                emptyMessage.className = 'empty-list';
                emptyMessage.textContent = 'No medications selected';
                list.appendChild(emptyMessage);
            }
        }
        
        

        function submitPrescription() {
    
    
    let specialInstructions = document.querySelector('.notes-section textarea').value;
    let deliveryMethod = document.querySelector('input[name="delivery"]:checked').value;
    
    
    let data = {
        specialInstructions: specialInstructions,
        deliveryMethod: deliveryMethod,
        recordId: <?php echo $data['record_id']?>,    
        pharmacyId: <?php echo $data['pharmacy_id']?> 
    };
    
    // Send data to server using fetch API
    fetch('<?php echo URLROOT?>patientController/addToOrder', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const popup = document.getElementById('popup');
  popup.style.display = 'block';

  // Hide after 2 seconds and redirect
  setTimeout(() => {
    popup.style.display = 'none';
    window.location.href = '<?php echo URLROOT?>patientController/dashboard'; // your PHP redirection
  }, 3000);
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error sending prescription:', error);
        alert('There was an error sending your prescription. Please try again.');
    });

   
}
    </script>
        <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

</body>
</html>