<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="description" content="Admin approval system" />
        <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/admin/pendingDoctorapproval.css" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <title>Pending Approvals</title>
        <style>
            /* Tab styling */
            .tabs {
                display: flex;
                margin-bottom: 20px;
                border-bottom: 1px solid #ddd;
            }
            
            .tab-button {
                padding: 12px 24px;
                background: #f5f5f5;
                border: none;
                cursor: pointer;
                font-size: 16px;
                font-family: 'Poppins', sans-serif;
                transition: background-color 0.3s;
                border-radius: 8px 8px 0 0;
                margin-right: 5px;
            }
            
            .tab-button.active {
                background: rgb(14, 74, 255);
                color: white;
                border-bottom: none;
            }
            
            .tab-content {
                display: none;
            }
            
            .tab-content.active {
                display: block;
            }

            /* Table styling */
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            
            th, td {
                padding: 12px 15px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            
            th {
                background-color: #f2f2f2;
                font-weight: 600;
            }
            
            tr:hover {
                background-color: #f5f5f5;
            }
            
            #approve-btn {
                padding: 6px 12px;
                background-color:rgb(14, 74, 255);
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-right: 5px;
            }
            
            #reject-btn {
                padding: 6px 12px;
                background-color: #f44336;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            
            h2 {
                color: #333;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <?php include 'adminNavbar.php'?>

        <div class="main-content">
            <h2>Pending Approvals</h2>
            
            <div class="tabs">
                <button class="tab-button active" onclick="openTab(event, 'doctors')">Doctors</button>
                <button class="tab-button" onclick="openTab(event, 'pharmacies')">Pharmacies</button>
                <button class="tab-button" onclick="openTab(event, 'labs')">Labs</button>
            </div>
            
            <!-- Doctors Tab -->
            <div id="doctors" class="tab-content active">
                <div class="table">
                    <h3>Pending Doctor Approvals</h3>
                    <?php if (!empty($data['doctors'])): ?>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>License No.</th>
                                <th>Contact No.</th>
                                <th>License</th>
                                <th>Actions</th>
                            </tr>
                            <?php foreach ($data['doctors'] as $doctor): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($doctor->firstName.' '.$doctor->lastName); ?></td>
                                    <td><?php echo htmlspecialchars($doctor->email); ?></td>
                                    <td><?php echo htmlspecialchars($doctor->slmc_no); ?></td>
                                    <td><?php echo htmlspecialchars($doctor->contact_no); ?></td>
                                    <td>
                                         <a href="<?php echo URLROOT.'uploads/medical_licenses/doctor_license'.$doctor->medicalLicenseCopyName;?>" target="_blank"> 
                                            View License
                                        </a>
                                    </td>
                                    <td>
                                        <button id="approve-btn" onclick="approveDoctor(<?php echo $doctor->doctor_id; ?>)">Approve</button>
                                        <button id="reject-btn" onclick="rejectDoctor(<?php echo $doctor->doctor_id; ?>)">Reject</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php else: ?>
                        <p>No pending doctors to approve</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Pharmacies Tab -->
            <div id="pharmacies" class="tab-content">
                <div class="table">
                    <h3>Pending Pharmacy Approvals</h3>
                    <?php if (!empty($data['pharmacies'])): ?>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>License No.</th>
                                <th>Contact No.</th>
                                <th>License</th>
                                <th>Actions</th>
                            </tr>
                            <?php foreach ($data['pharmacies'] as $pharmacy): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($pharmacy->pharmacy_name); ?></td>
                                    <td><?php echo htmlspecialchars($pharmacy->email); ?></td>
                                    <td><?php echo htmlspecialchars($pharmacy->pharmacy_reg_number); ?></td>
                                    <td><?php echo htmlspecialchars($pharmacy->contact_no); ?></td>
                                    <td>
                                        <a href="<?php echo URLROOT.'uploads/medical_licenses/pharmacy/'.$pharmacy->pharmacy_license_copy;?>" target="_blank">
                                            View License
                                        </a>
                                    </td>
                                    <td>
                                        <button id="approve-btn" onclick="approvePharmacy(<?php echo $pharmacy->pharmacy_id; ?>)">Approve</button>
                                        <button id="reject-btn" onclick="rejectPharmacy(<?php echo $pharmacy->pharmacy_id; ?>)">Reject</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php else: ?>
                        <p>No pending pharmacies to approve</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Labs Tab -->
            <div id="labs" class="tab-content">
                <div class="table">
                    <h3>Pending Lab Approvals</h3>
                    <?php if (!empty($data['labs'])): ?>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>License No.</th>
                                <th>Contact No.</th>
                                <th>License</th>
                                <th>Actions</th>
                            </tr>
                            <?php foreach ($data['labs'] as $lab): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($lab->name); ?></td>
                                    <td><?php echo htmlspecialchars($lab->email); ?></td>
                                    <td><?php echo htmlspecialchars($lab->lab_reg_number); ?></td>
                                    <td><?php echo htmlspecialchars($lab->contact_number); ?></td>
                                    <td>
                                        <a href="<?php echo URLROOT.'uploads/medical_licenses/lab_license/'.$lab->lab_certificate;?>" target="_blank">
                                            View License
                                        </a>
                                    </td>
                                    <td>
                                        <button id="approve-btn" onclick="approveLab(<?php echo $lab->id; ?>)">Approve</button>
                                        <button id="reject-btn" onclick="rejectLab(<?php echo $lab->id; ?>)">Reject</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php else: ?>
                        <p>No pending labs to approve</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <script>
            const URLROOT = 'http://localhost/newFramework';

            // Tab functionality
            function openTab(evt, tabName) {
                var i, tabContent, tabButtons;
                
                // Hide all tab content
                tabContent = document.getElementsByClassName("tab-content");
                for (i = 0; i < tabContent.length; i++) {
                    tabContent[i].className = tabContent[i].className.replace(" active", "");
                }
                
                // Remove active class from all tab buttons
                tabButtons = document.getElementsByClassName("tab-button");
                for (i = 0; i < tabButtons.length; i++) {
                    tabButtons[i].className = tabButtons[i].className.replace(" active", "");
                }
                
                // Show the current tab and add active class to the button
                document.getElementById(tabName).className += " active";
                evt.currentTarget.className += " active";
            }

            // Doctor approval functions
            function approveDoctor(doctorId) {
                if (confirm('Are you sure you want to approve this doctor?')) {
                    console.log('Starting approval process for doctor:', doctorId);
                    
                    fetch(`${URLROOT}/adminController/approvedoctor`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'doctor_id=' + doctorId
                    })
                    .then(async response => {
                        console.log('Response status:', response.status);
                        
                        const text = await response.text();
                        console.log('Raw response text:', text);
                        
                        if (!text) {
                            throw new Error('Empty response from server');
                        }
                        
                        try {
                            const data = JSON.parse(text);
                            console.log('Parsed response data:', data);
                            
                            if (data.success) {
                                alert('Doctor approved successfully!');
                                location.reload();
                            } else {
                                throw new Error(data.error || 'Unknown error occurred');
                            }
                        } catch (e) {
                            console.error('JSON Parse error:', e);
                            throw new Error(`Failed to parse server response: ${e.message}`);
                        }
                    })
                    .catch(error => {
                        console.error('Error in approval process:', error);
                        alert(`Error: ${error.message}`);
                    });
                }
            }

            function rejectDoctor(doctorId) {
                if (confirm('Are you sure you want to reject this doctor?')) {
                    fetch(`${URLROOT}/admincontroller/rejectdoctor`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'doctor_id=' + doctorId
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Doctor rejected successfully!');
                            location.reload();
                        } else {
                            alert(data.error || 'An error occurred');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred during rejection');
                    });
                }
            }

            // Pharmacy approval functions
            function approvePharmacy(pharmacyId) {
                if (confirm('Are you sure you want to approve this pharmacy?')) {
                    fetch(`${URLROOT}/adminController/approvepharmacy`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'pharmacy_id=' + pharmacyId
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Pharmacy approved successfully!');
                            location.reload();
                        } else {
                            alert(data.error || 'An error occurred');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred during approval');
                    });
                }
            }

            function rejectPharmacy(pharmacyId) {
                if (confirm('Are you sure you want to reject this pharmacy?')) {
                    fetch(`${URLROOT}/adminController/rejectpharmacy`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'pharmacy_id=' + pharmacyId
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Pharmacy rejected successfully!');
                            location.reload();
                        } else {
                            alert(data.error || 'An error occurred');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred during rejection');
                    });
                }
            }

            // Lab approval functions
            function approveLab(labId) {
                if (confirm('Are you sure you want to approve this lab?')) {
                    fetch(`${URLROOT}/adminController/approvelab`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'lab_id=' + labId
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Lab approved successfully!');
                            location.reload();
                        } else {
                            alert(data.error || 'An error occurred');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred during approval');
                    });
                }
            }

            function rejectLab(labId) {
                if (confirm('Are you sure you want to reject this lab?')) {
                    fetch(`${URLROOT}/adminController/rejectlab`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'lab_id=' + labId
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Lab rejected successfully!');
                            location.reload();
                        } else {
                            alert(data.error || 'An error occurred');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred during rejection');
                    });
                }
            }
        </script>
        <script src="<?php echo URLROOT?>public/assets/js/navbar.js"></script>
    </body>
</html>