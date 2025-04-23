<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Doctor Access</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c75e4;
            --danger-color: #e74c3c;
            --success-color: #2ecc71;
            --light-gray: #f5f5f5;
            --dark-gray: #333;
            --border-color: #ddd;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    list-style: none;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
    
}

body{
    display: flex;
    /* height: 100vh; */
    overflow-x: hidden;
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
}

.sideBar.collapsed + .main-content{

margin-left:80px;
width: calc(100% - 80px);
overflow-y: auto;
}
        
        body {
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .page-header {
            margin-bottom: 30px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 15px;
        }
        
        h1 {
            color: var(--dark-gray);
            font-weight: 500;
        }
        
        .info-text {
            color: #666;
            margin-bottom: 20px;
        }
        
        .search-container {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        
        .search-box {
            flex-grow: 1;
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
            outline: none;
            transition: border 0.3s;
        }
        
        .search-box:focus {
            border-color: var(--primary-color);
        }
        
        .doctor-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 15px;
            overflow: hidden;
            transition: transform 0.2s;
        }
        
        .doctor-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .doctor-info {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .doctor-details {
            flex-grow: 1;
        }
        
        .doctor-name {
            font-size: 18px;
            font-weight: 500;
            color: var(--dark-gray);
            margin-bottom: 5px;
        }
        
        .doctor-specialty {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }
        
        .access-details {
            color: #888;
            font-size: 13px;
        }
        
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 100;
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background-color: white;
            max-width: 450px;
            width: 90%;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .modal-header {
            background-color: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .modal-title {
            font-size: 18px;
            font-weight: 500;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        
        .doctor-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #777;
            font-size: 24px;
            font-weight: bold;
        }
        
        .status-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }
        
        .status-active {
            background-color: var(--success-color);
        }
        
        .no-doctors {
            text-align: center;
            padding: 40px 0;
            color: #666;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            display: none;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-close {
            float: right;
            font-size: 20px;
            font-weight: bold;
            line-height: 18px;
            cursor: pointer;
        }
        
        @media (max-width: 768px) {
            .doctor-info {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .action-btns {
                margin-top: 15px;
                align-self: flex-end;
            }
        }
    </style>
</head>
<body>
    <?php include "navbar-patient.php"; ?>
    <div class="main-content">
    <div class="container">
        <div class="page-header">
            <h1>Manage Doctor Access</h1>
        </div>
        
        <p class="info-text">Below is a list of doctors who currently have access to your health records. You can revoke access at any time.</p>
        
        <div class="alert alert-success" id="successAlert">
            Doctor access has been successfully revoked.
            <span class="alert-close" onclick="closeAlert()">&times;</span>
        </div>
        
        <!-- <div class="search-container">
            <input type="text" class="search-box" id="doctorSearch" placeholder="Search doctors by name or specialty...">
        </div> -->
        
        <div id="doctorsList">
            <!-- Loop through doctors with PHP foreach -->
            <!-- This is where you'll integrate your PHP loop -->
            
            <!-- Example doctor card that you can modify for your PHP loop -->
            <?php foreach($data['doctors'] as $doctor): ?>
                <div class="doctor-card" data-doctor-id="<?php echo $doctor->doctor_id; ?>">
                    <div class="doctor-info">
                        <div class="doctor-avatar"><?php echo substr($doctor->firstName, 0, 1) . substr($doctor->lastName, 0, 1); ?></div>
                        <div class="doctor-details">
                            <h3 class="doctor-name">Dr. <?php echo $doctor->firstName . ' ' . $doctor->lastName; ?></h3>
                            <p class="doctor-specialty"><?php echo $doctor->specialization; ?></p>
                            <p class="access-details">
                                <span class="status-indicator status-active"></span>
                                Access granted on: <?php echo date('F j, Y', strtotime($doctor->requested_at)); ?>
                            </p>
                        </div>
                        <div class="action-btns">
                            <button class="btn btn-danger revoke-btn" 
                                data-doctor-id="<?php echo $doctor->doctor_id; ?>" 
                                data-doctor-name="Dr. <?php echo $doctor->firstName . ' ' . $doctor->lastName; ?>">
                                Revoke Access
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <?php if(count($data['doctors']) == 0): ?>
                <div class="no-doctors" id="noDoctors">
                    <p>No doctors currently have access to your health records.</p>
                </div>
                <?php endif; ?>
            
    </div>
    
    <!-- Confirmation Modal -->
    <div class="modal" id="confirmModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm Access Revocation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to revoke access for <span id="doctorNameConfirm"></span>?</p>
                <p>They will no longer be able to view your health records or make updates to your profile.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelRevoke">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmRevoke">Revoke Access</button>
            </div>
        </div>
    </div>
    </div>

    <script>
        // Doctor Search Functionality
        // document.getElementById('doctorSearch').addEventListener('input', function() {
        //     const searchTerm = this.value.toLowerCase();
        //     const doctorCards = document.querySelectorAll('.doctor-card');
        //     let visibleCount = 0;
            
        //     doctorCards.forEach(card => {
        //         const doctorName = card.querySelector('.doctor-name').textContent.toLowerCase();
        //         const doctorSpecialty = card.querySelector('.doctor-specialty').textContent.toLowerCase();
                
        //         if (doctorName.includes(searchTerm) || doctorSpecialty.includes(searchTerm)) {
        //             card.style.display = 'block';
        //             visibleCount++;
        //         } else {
        //             card.style.display = 'none';
        //         }
        //     });
            
        //     // Show/hide no doctors message
        //     document.getElementById('noDoctors').style.display = visibleCount === 0 ? 'block' : 'none';
        // });
        
        // Modal and Revocation Functionality
        const modal = document.getElementById('confirmModal');
        const doctorNameConfirm = document.getElementById('doctorNameConfirm');
        let currentDoctorId = null;
        
        // Open modal when revoke button is clicked
        document.querySelectorAll('.revoke-btn').forEach(button => {
            button.addEventListener('click', function() {
                const doctorId = this.getAttribute('data-doctor-id');
                const doctorName = this.getAttribute('data-doctor-name');
                
                currentDoctorId = doctorId;
                doctorNameConfirm.textContent = doctorName;
                modal.style.display = 'flex';
            });
        });
        
        // Close modal when cancel button is clicked
        document.getElementById('cancelRevoke').addEventListener('click', function() {
            modal.style.display = 'none';
        });
        
        // Handle access revocation when confirmed
        document.getElementById('confirmRevoke').addEventListener('click', function() {
            // Here you would typically make an AJAX request to your PHP backend
            // For example:
            
            if (currentDoctorId) {
                // Example AJAX request
                fetch('<?php echo URLROOT?>/patientController/revokeAccess', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'revoke_access',
                        doctor_id: currentDoctorId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the doctor card from the list
                        const doctorCard = document.querySelector(`.doctor-card[data-doctor-id="${currentDoctorId}"]`);
                        if (doctorCard) {
                            doctorCard.remove();
                        }
                        
                        // Show success message
                        document.getElementById('successAlert').style.display = 'block';
                        
                        // Check if any doctors are left
                        const remainingDoctors = document.querySelectorAll('.doctor-card');
                        if (remainingDoctors.length === 0) {
                            document.getElementById('noDoctors').style.display = 'block';
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                })
                .finally(() => {
                    // Close the modal
                    modal.style.display = 'none';
                });
                
                // For demo purposes, simulate a successful response
                const doctorCard = document.querySelector(`.doctor-card[data-doctor-id="${currentDoctorId}"]`);
                if (doctorCard) {
                    doctorCard.remove();
                }
                
                // Show success message
                document.getElementById('successAlert').style.display = 'block';
                
                // Check if any doctors are left
                const remainingDoctors = document.querySelectorAll('.doctor-card');
                if (remainingDoctors.length === 0) {
                    document.getElementById('noDoctors').style.display = 'block';
                }
                
                // Close the modal
                modal.style.display = 'none';
            }
        });
        
        // Close alert
        function closeAlert() {
            document.getElementById('successAlert').style.display = 'none';
        }
        
        // Close modal if clicked outside
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
        <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

</body>
</html>