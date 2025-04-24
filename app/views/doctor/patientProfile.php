<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile</title>
    <meta name="description" content="Medical patient profile view for doctors" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/css/doctor/navbarcssbhagya.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #f5f8fa;
            display: flex;
        }
        .main-content {
            flex: 1;
            margin-left: 250px; /* Initial space for sidebar */
            padding: 20px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        .main-content.sidebar-collapsed {
            margin-left: 80px; /* Adjusted space when sidebar is collapsed */
        }
        .patient-header {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
        }
        .patient-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #e0e0e0;
            margin-right: 20px;
            overflow: hidden;
            flex-shrink: 0;
        }
        .patient-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .patient-info {
            flex: 1;
        }
        .patient-info h2 {
            margin-bottom: 5px;
            color: #333;
        }
        .patient-info .age {
            color: #666;
            margin-bottom: 10px;
        }
        .patient-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .detail-item {
            background-color: #f8f9fa;
            border-radius: 6px;
            padding: 10px;
            border-left: 3px solid #0066cc;
        }
        .detail-item h4 {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }
        .detail-item p {
            font-size: 15px;
            color: #333;
        }
        .medications {
            margin-top: 15px;
        }
        .medications h3 {
            font-size: 16px;
            margin-bottom: 5px;
            color: #444;
        }
        .medications ul {
            list-style-type: none;
        }
        .medications li {
            padding: 5px 0;
            color: #555;
        }
        
        /* Previous Appointments Table */
        .appointments-section {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .appointments-section h3 {
            margin-bottom: 15px;
            color: #333;
            font-size: 18px;
        }
        .appointments-table {
            width: 100%;
            border-collapse: collapse;
        }
        .appointments-table th {
            padding: 12px 15px;
            text-align: left;
            background-color: #f9f9f9;
            color: #333;
            font-weight: 500;
            border-bottom: 1px solid #eee;
        }
        .appointments-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        .appointments-table tr:last-child td {
            border-bottom: none;
        }
        .appointments-container {
            max-height: 300px;
            overflow-y: auto;
        }
        .appointment-status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            display: inline-block;
            min-width: 80px;
        }
        .completed {
            background-color: #e6f4ea;
            color: #1e7e34;
        }
        .scheduled {
            background-color: #e3f2fd;
            color: #0277bd;
        }
        .canceled {
            background-color: #ffebee;
            color: #c62828;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }
        .action-button {
            border: none;
            height: 50px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .action-button:hover {
            transform: translateY(-2px);
        }
        #view-history {
            background-color: #e6f7ff;
            color: #0066cc;
            border: 1px solid #b3d9ff;
        }
        #add-record {
            background-color: #e6f0e6;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }
        
        /* Records Section */
        .records-section {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .records-table {
            width: 100%;
            border-collapse: collapse;
        }
        .records-table th {
            padding: 12px 15px;
            text-align: left;
            background-color: #f9f9f9;
            color: #333;
            font-weight: 500;
            border-bottom: 1px solid #eee;
        }
        .records-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        .records-table tr:last-child td {
            border-bottom: none;
        }
        .records-container {
            max-height: 400px;
            overflow-y: auto;
        }
        .btn-action {
            padding: 6px 12px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s;
            margin-right: 5px;
        }
        .btn-view {
            background-color: #e6f7ff;
            color: #0066cc;
        }
        .btn-delete {
            background-color: #ffebee;
            color: #d32f2f;
        }
        .btn-action:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sideBar">
        <div class="logo">
            <img src="<?php echo URLROOT; ?>public/images/doctor/Images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
            <h2>සුව CONNECT</h2>

            <button class="toggle-btn" id="toggleSideBar"> 
                <i class="material-icons-round">chevron_left</i>
            </button>
        </div>
        
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="<?php echo URLROOT?>doctor/home" class="nav-link">
                    <i class="material-icons-round">home</i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item active">
                <a href="<?php echo URLROOT?>doctor/searchPatient" class="nav-link">
                    <i class="material-icons-round">group</i> <span>search patient</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT?>doctor/appointments" class="nav-link">
                    <i class="material-icons-round">medical_services</i> <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT?>notificationsController/index" class="nav-link">
                    <i class="material-icons-round">notifications</i> <span>Notifications</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT?>doctor/updateProfile" class="nav-link">
                    <i class="material-icons-round">settings</i> <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="support.html" class="nav-link">
                    <i class="material-icons-round">contact_support</i> <span>Support</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-footer">
            <a href="<?php echo URLROOT?>logincontroller/logout" class="btn-user">Log-Out</a>
        </div>
    </div>

    <div class="main-content" id="mainContent">
        <!-- Patient Header with Basic Info -->
        <div class="patient-header">
            <div class="patient-image">
                <img src="<?php echo URLROOT;?>public/images/doctor/images/profile.png" alt="Patient Photo">
            </div>
            <div class="patient-info">
                <h2><?php echo $data['patient']->first_name.' '.$data['patient']->last_name;?></h2>
                <div class="age">Age: <?php echo $data['patient']->age ?? '25';?></div>
                
                <!-- Additional Patient Details -->
                <div class="patient-details">
                    <div class="detail-item">
                        <h4>Blood Type</h4>
                        <p><?php echo $data['patient']->blood_type ?? 'O+'; ?></p>
                    </div>
                    <div class="detail-item">
                        <h4>Allergies</h4>
                        <p><?php echo $data['patient']->allergies ?? 'None reported'; ?></p>
                    </div>
                    <div class="detail-item">
                        <h4>Chronic Illnesses</h4>
                        <p><?php echo $data['patient']->chronic_illnesses ?? 'None reported'; ?></p>
                    </div>
                    <div class="detail-item">
                        <h4>Health Habits</h4>
                        <p><?php echo $data['patient']->health_habits ?? 'Regular exercise, non-smoker'; ?></p>
                    </div>
                </div>
                
                <!-- Current Medications Section -->
                <div class="medications">
                    <h3>Current Medications</h3>
                    <ul>
                        <?php if(!empty($data['medications'])): ?>
                            <?php foreach($data['medications'] as $med): ?>
                                <li><?php echo $med->name; ?> - <?php echo $med->dosage; ?> (<?php echo $med->frequency; ?>)</li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No current medications</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button id="view-history" class="action-button" onclick="viewPatientHistory(<?php echo $data['patient']->patient_id?>)">
                View History
            </button>
            <button id="add-record" class="action-button" onclick="addHealthRecord(<?php echo $data['patient']->patient_id?>)">
                Add New Record
            </button>
        </div>

       

        <!-- Health Records Section -->
        <div class="records-section">
            <h3>Previous Appointments</h3>
            <div class="records-container">
                <table class="records-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Doctor</th>
                            <th>Diagnosis</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="healthRecordsTableBody">
                        <tr>
                            <td colspan="4" style="text-align: center;">Loading health records...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    const URLROOT = "<?php echo URLROOT;?>";

    function addHealthRecord(patientId) {
        window.location.href = `${URLROOT}/visitRecordController/addHealthRecord/${patientId}`;
    }

    function viewPatientHistory(patientId) {
        window.location.href = `${URLROOT}/patientController/viewPatientHistory/${patientId}`;
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Toggle sidebar functionality
        const toggleBtn = document.getElementById('toggleSideBar');
        const sideBar = document.querySelector('.sideBar');
        const mainContent = document.getElementById('mainContent');
        
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                sideBar.classList.toggle('collapsed');
                mainContent.classList.toggle('sidebar-collapsed');
                
                // Change chevron direction
                const chevronIcon = this.querySelector('i');
                if (sideBar.classList.contains('collapsed')) {
                    chevronIcon.innerHTML = 'chevron_right';
                } else {
                    chevronIcon.innerHTML = 'chevron_left';
                }
            });
        }
        
        // Load health records on page load
        fetchHealthRecords();

        // Fetch records from PHP backend
        function fetchHealthRecords() {
            const patientId = "<?php echo $data['patient']->patient_id; ?>";
            let apiUrl = `${URLROOT}/visitRecordController/getHealthRecords/${patientId}`;
            const tableBody = document.getElementById('healthRecordsTableBody');

            tableBody.innerHTML = '<tr><td colspan="4" style="text-align:center;padding:20px;">Loading health records...</td></tr>';

            fetch(apiUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    displayRecords(data);
                })
                .catch(error => {
                    tableBody.innerHTML = `<tr><td colspan="4" style="text-align:center;padding:20px;color:#d32f2f;">Error loading records: ${error.message}</td></tr>`;
                    console.error('Fetch error:', error);
                });
        }

        // Display records in table format
        function displayRecords(records) {
            const tableBody = document.getElementById('healthRecordsTableBody');
            
            if (records.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="4" style="text-align:center;padding:20px;">No records found.</td></tr>';
                return;
            }

            let html = '';
            records.forEach(record => {
                const dateOnly = new Date(record.created_at).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: '2-digit'
                });

                html += `
                    <tr>
                        <td>${dateOnly}</td>
                        <td>Dr. ${record.doctor_name}</td>
                        <td>${record.diagnosis}</td>
                        <td>
                            <button class="btn-action btn-view" onclick="seeMoreInfo('${record.record_id}')">View</button>
                            <button class="btn-action btn-delete" onclick="deleteRecord('${record.record_id}')">Delete</button>
                        </td>
                    </tr>
                `;
            });

            tableBody.innerHTML = html;
        }
    });

    // Global functions for buttons
    function seeMoreInfo(recordId) {
        window.location.href = `${URLROOT}/visitRecordController/viewHealthRecord/${recordId}`;
    }

    function deleteRecord(recordId) {
        if (confirm('Are you sure you want to delete this record?')) {
            fetch(`${URLROOT}/visitRecordController/deleteHealthRecord/${recordId}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Record deleted successfully!');
                    // Refresh records
                    location.reload();
                } else {
                    alert('Error deleting record: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting record: ' + error.message);
            });
        }
    }
    </script>
</body>
</html>