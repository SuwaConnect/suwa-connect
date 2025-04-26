<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Appointment System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        .main-content {
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        header {
            margin-bottom: 30px;
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .lab-info {
            background-color: #ebf5ff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .lab-info div {
            margin-bottom: 10px;
        }
        
        .lab-info strong {
            display: block;
            color: #3498db;
            margin-bottom: 5px;
        }
        
        .appointment-form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }
        
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: 600;
            grid-column: span 2;
            justify-self: center;
            width: 200px;
        }
        
        button:hover {
            background-color: #2980b9;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        
        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .modal h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .confirmation-details {
            margin-bottom: 25px;
        }
        
        .confirmation-details p {
            margin-bottom: 10px;
            padding: 8px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        
        .confirmation-details strong {
            color: #3498db;
        }
        
        .modal-buttons {
            display: flex;
            justify-content: space-between;
        }
        
        .modal-buttons button {
            width: 48%;
        }
        
        .cancel-btn {
            background-color: #e74c3c;
        }
        
        .cancel-btn:hover {
            background-color: #c0392b;
        }
        
        .success-message {
            display: none;
            text-align: center;
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
                margin: 20px;
            }
            
            .lab-info, .appointment-form {
                grid-template-columns: 1fr;
            }
            
            button {
                grid-column: span 1;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <header>
            <h1>Lab Appointment Booking</h1>
        </header>
        
        <section class="lab-info">
            <div>
                <strong>Lab Name</strong>
                <span><?php echo $data['lab']->name?></span>
            </div>
            <div>
                <strong>Lab Registration Number</strong>
                <span><?php echo $data['lab']->lab_reg_number?></span>
            </div>
            <div>
                <strong>Address</strong>
                <span><?php echo $data['lab']->contact_person?></span>
            </div>
            <div>
                <strong>Contact Number</strong>
                <span><?php echo $data['lab']->contact_number?></span>
            </div>
        </section>
        
        <form id="appointmentForm" class="appointment-form">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required value ="<?php echo $data['patient']->first_name . ' ' . $data['patient']->last_name?>" disabled>
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required value="<?php echo $data['patient']->contact_no?>" disabled>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required value="<?php echo $data['patient']->email?>" disabled>
            </div>
            
            <div class="form-group">
                <label for="testType">Lab Test Type</label>
                <select id="testType" name="testType" required>
                    <option value="">Select a test</option>
                    <option value="Blood Test - Complete Blood Count">Blood Test - Complete Blood Count</option>
                    <option value="Blood Test - Lipid Profile">Blood Test - Lipid Profile</option>
                    <option value="Blood Test - Liver Function">Blood Test - Liver Function</option>
                    <option value="Urine Analysis">Urine Analysis</option>
                    <option value="Blood Sugar Test">Blood Sugar Test</option>
                    <option value="Thyroid Function Test">Thyroid Function Test</option>
                    <option value="PCR Test">PCR Test</option>
                    <option value="X-Ray">X-Ray</option>
                    <option value="Ultrasound">Ultrasound</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="date">Appointment Date</label>
                <input type="date" id="date" name="date" required>
            </div>
            
            <div class="form-group">
                <label for="time">Appointment Time</label>
                <select id="time" name="time" required>
                    <option value="">Select a time</option>
                    <option value="09:00 AM">09:00 AM</option>
                    <option value="09:30 AM">09:30 AM</option>
                    <option value="10:00 AM">10:00 AM</option>
                    <option value="10:30 AM">10:30 AM</option>
                    <option value="11:00 AM">11:00 AM</option>
                    <option value="11:30 AM">11:30 AM</option>
                    <option value="12:00 PM">12:00 PM</option>
                    <option value="02:00 PM">02:00 PM</option>
                    <option value="02:30 PM">02:30 PM</option>
                    <option value="03:00 PM">03:00 PM</option>
                    <option value="03:30 PM">03:30 PM</option>
                    <option value="04:00 PM">04:00 PM</option>
                    <option value="04:30 PM">04:30 PM</option>
                </select>
            </div>
            
            <button type="submit">Book Appointment</button>
        </form>
        
        <!-- <div class="success-message" id="successMessage">
            <h3>Appointment Confirmed!</h3>
            <p>You will receive a confirmation email shortly. Thank you for choosing HealthTech Diagnostics.</p>
        </div> -->
    </div>
    
    <div class="modal" id="confirmationModal">
        <div class="modal-content">
            <h2>Confirm Your Appointment</h2>
            <div class="confirmation-details" id="confirmationDetails">
                <!-- Details will be filled by JavaScript -->
            </div>
            <div class="modal-buttons">
                <button class="cancel-btn" id="cancelBtn">Cancel</button>
                <button id="confirmBtn" >Confirm</button>
            </div>
        </div>
    </div>
    
    <script>
        // Get today's date and set it as the minimum date for the appointment
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const todayFormatted = `${yyyy}-${mm}-${dd}`;
        document.getElementById('date').min = todayFormatted;
        
        // Get elements
        const appointmentForm = document.getElementById('appointmentForm');
        const modal = document.getElementById('confirmationModal');
        const confirmationDetails = document.getElementById('confirmationDetails');
        const cancelBtn = document.getElementById('cancelBtn');
        const confirmBtn = document.getElementById('confirmBtn');
        const successMessage = document.getElementById('successMessage');
        
        // Show confirmation modal when form is submitted
        appointmentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Get form values
            const name = document.getElementById('name').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            const testType = document.getElementById('testType').value;
            const date = document.getElementById('date').value;
            const time = document.getElementById('time').value;
            
            // Format date for display
            const appointmentDate = new Date(date);
            const formattedDate = appointmentDate.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            
            // Update confirmation details in the modal
            confirmationDetails.innerHTML = `
                <p><strong>Patient:</strong> ${name}</p>
                <p><strong>Contact:</strong> ${phone}</p>
                <p><strong>Email:</strong> ${email}</p>
                <p><strong>Test Type:</strong> ${testType}</p>
                <p><strong>Date:</strong> ${formattedDate}</p>
                <p><strong>Time:</strong> ${time}</p>
                <p><strong>Lab:</strong> HealthTech Diagnostics</p>
            `;
            
            // Show modal
            modal.style.display = 'flex';
        });
        
        // Handle cancel button click
        cancelBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
        
        // Handle confirm button click
        confirmBtn.addEventListener('click', function() {
    // Show loading state
    confirmBtn.textContent = "Processing...";
    confirmBtn.disabled = true;
    
    fetch(`<?php echo URLROOT ?>patientController/createLabAppointment`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            lab_id: <?php echo $data['lab']->lab_id?>,
            testName: document.getElementById('testType').value,
            date: document.getElementById('date').value,
            time: document.getElementById('time').value
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Hide modal
        modal.style.display = 'none';
        
        // Clear form
        appointmentForm.reset();
        
        if (data.success) {
        window.location.href = '<?php echo URLROOT ?>patientController/appointments';
    } else {
        alert(data.message || 'Failed to book appointment.');
    }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to book appointment. Please try again.');
    })
    .finally(() => {
        // Reset button state
        confirmBtn.textContent = "Confirm";
        confirmBtn.disabled = false;
    });
});
        
        // Close modal if user clicks outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });



    </script>
</body>
</html>