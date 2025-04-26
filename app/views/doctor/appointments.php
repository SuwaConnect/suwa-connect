<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>appointments</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/appointments.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <style>
.main-content {
    padding: 20px;
}

.search-date {
    margin-bottom: 30px;
}

.search-date form {
    display: flex;
    align-items: center;
    gap: 10px;
}

.session-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
}

.session-tab {
    padding: 10px 15px;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
}

.session-tab:hover {
    background-color: #e0e0e0;
}

.session-tab.active {
    background-color: #4CAF50;
    color: white;
    border-color: #4CAF50;
}

.patient-count {
    font-size: 0.8em;
    opacity: 0.8;
}

.session-content {
    margin-bottom: 30px;
}

.session-info {
    margin-bottom: 15px;
}

.appointments-table {
    width: 100%;
    border-collapse: collapse;
}

.appointments-table th, 
.appointments-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.appointments-table th {
    background-color: #f5f5f5;
    font-weight: bold;
}

.status-badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.8em;
}

.status-pending {
    background-color: #FFC107;
    color: #000;
}

.status-consulted {
    background-color: #4CAF50;
    color: white;
}

.status-cancelled {
    background-color: #F44336;
    color: white;
}

.button {
    padding: 8px 15px;
    border: none;
    border-radius: 4px;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #45a049;
}

.button.small {
    padding: 5px 10px;
    font-size: 0.9em;
}

.no-appointments {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 4px;
    text-align: center;
    color: #666;
}

.alert {
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 20px;
}

.alert-info {
    background-color: #e3f2fd;
    color: #0d47a1;
    border: 1px solidrgb(11, 55, 201);
}

.manage-session-btn {
  width: 200px;
  height: 40px;
    margin-left: auto;
    font-size: 15px;
    text-align: center;
    display: flex;
    align-items: center;
    
    
}

.actions{
    display: flex;
    justify-content: space-around;
}

</style>
 
</head>
<body>
    <?php include 'navbarbhagya.php'; ?>

    

    <div class="main-content">
    <h1>Appointments</h1>

    <div class="search-date">
        <form action="<?php echo URLROOT?>appointmentController/getAppointmentsByDate" method="post" id="dateSearchForm">
            <label for="date">Select a date</label>
            <input type="date" name="date" id="date" value="<?php echo isset($data['date']) ? $data['date'] : date('Y-m-d'); ?>" required>
            <button type="submit" class="button">Search</button>
        </form>

        <div class="manage-session-btn">
            <a href="<?php echo URLROOT;?>appointmentController/manageSessions" class="button">Manage Sessions</a>
        </div>
    </div>

    <?php if(isset($data['sessions']) && !empty($data['sessions'])): ?>
        <!-- Session Toggle Buttons -->
        <div class="session-tabs">
            <?php 
            $firstSession = true;
            foreach($data['sessions'] as $sessionId => $sessionData): 
                $session = $sessionData['session_info'];
                $startTime = date('g:i A', strtotime($session->start_time));
                $endTime = date('g:i A', strtotime($session->end_time));
                $activeClass = $firstSession ? 'active' : '';
            ?>
                <button class="session-tab <?php echo $activeClass; ?>" 
                        data-session="<?php echo $sessionId; ?>">
                    <?php echo $startTime . ' - ' . $endTime; ?> 
                    <span class="patient-count">(<?php echo $sessionData['current_count']; ?>/<?php echo $session->max_patients; ?>)</span>
                </button>
            <?php 
                $firstSession = false;
            endforeach; 
            ?>
        </div>

        <!-- Session Content -->
        <div class="grid-container">
            <?php 
            $firstSession = true;
            foreach($data['sessions'] as $sessionId => $sessionData): 
                $session = $sessionData['session_info'];
                $appointments = $sessionData['appointments'];
                $display = $firstSession ? 'block' : 'none';
            ?>
                <div class="session-content" id="session-<?php echo $sessionId; ?>" style="display: <?php echo $display; ?>">
                    <h2>Session: <?php echo date('g:i A', strtotime($session->start_time)); ?> - 
                        <?php echo date('g:i A', strtotime($session->end_time)); ?>
                    </h2>
                    
                    <div class="session-info">
                        <p>Appointments: <?php echo $sessionData['current_count']; ?> / <?php echo $session->max_patients; ?></p>
                    </div>
                    
                    <?php if(empty($appointments)): ?>
                        <div class="no-appointments">
                            <p>No appointments scheduled for this session.</p>
                        </div>
                    <?php else: ?>
                        <div class="appointments-table-container">
                            <table class="appointments-table">
                                <thead>
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Patient ID</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($appointments as $appointment): ?>
                                        <tr>
                                            <td><?php echo $appointment->first_name .' ' . $appointment->last_name; ?></td>
                                            <td><?php echo $appointment->patient_id; ?></td>
                                            <td><?php echo $appointment->reason; ?></td>
                                            <td>
                                                <span class="status-badge status-<?php echo strtolower($appointment->status); ?>">
                                                    <?php echo $appointment->status; ?>
                                                </span>
                                            </td>
                                            <td class="actions">
                                                <?php if($appointment->status != 'consulted'): ?>
                                                    <button class="button small mark-completed" 
                                                            data-appointment-id="<?php echo $appointment->appointment_id; ?>">
                                                        Mark as Completed
                                                    </button>
                                                    <button class="button small add-report" data-patient-id ="<?php echo $appointment->patient_id?>">Add health record</button>
                                                <?php else: ?>
                                                    <button class="button small" disabled >Completed</button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            <?php 
                $firstSession = false;
            endforeach; 
            ?>
        </div>
    <?php elseif(isset($data['message'])): ?>
        <div class="alert alert-info">
            <?php echo $data['message']; ?>
        </div>
    <?php endif; ?>
</div>

    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
   <!-- here was render calender -->

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Session tab functionality
    const sessionTabs = document.querySelectorAll('.session-tab');
    
    sessionTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Hide all session content
            document.querySelectorAll('.session-content').forEach(content => {
                content.style.display = 'none';
            });
            
            // Remove active class from all tabs
            sessionTabs.forEach(t => {
                t.classList.remove('active');
            });
            
            // Show selected session content and make tab active
            const sessionId = this.getAttribute('data-session');
            document.getElementById('session-' + sessionId).style.display = 'block';
            this.classList.add('active');
        });
    });
    
    // Mark appointment as completed functionality
    const markCompletedButtons = document.querySelectorAll('.mark-completed');
    
    if (markCompletedButtons.length > 0) {
        markCompletedButtons.forEach(button => {
            button.addEventListener('click', function() {
                const appointmentId = this.getAttribute('data-appointment-id');
                
                if(confirm('Are you sure you want to mark this appointment as completed?')) {
                    // Create form data
                    const formData = new FormData();
                    formData.append('appointment_id', appointmentId);
                    
                    // Make AJAX request to mark appointment as completed
                    fetch('<?php echo URLROOT; ?>appointmentController/updateAppointmentStatus', {
    method: 'POST',
    body: formData
})
.then(response => {
    // Check if response is OK
    if (!response.ok) {
        throw new Error('Network response was not ok: ' + response.status);
    }
    // Check if there's actual content
    if (response.headers.get('content-length') === '0') {
        throw new Error('Empty response received');
    }
    return response.text();
})
.then(text => {
    // Log the raw response for debugging
    console.log('Raw response:', text);
    
    // Only try to parse if we have content
    if (text) {
        try {
            return JSON.parse(text);
        } catch (e) {
            console.error('JSON parse error:', e);
            throw new Error('Invalid JSON response: ' + text);
        }
    } else {
        throw new Error('Empty response');
    }
})
.then(data => {
    if (data && data.success) {
        // Update the status badge
        const row = button.closest('tr');
        const statusCell = row.querySelector('.status-badge');
        
        statusCell.textContent = 'CONSULTED';
        statusCell.className = 'status-badge status-consulted';
        
        // Remove the button
        button.remove();
    } else {
        alert('Failed to update status: ' + (data ? data.message : 'Unknown error'));
    }
})
.catch(error => {
    console.error('Error:', error);
    alert('Request failed: ' + error.message);
});
                }
            });
        });
    } else {
        console.log('No "Mark as Completed" buttons found on this page');
    }

    const addReportButtons = document.querySelectorAll('.add-report');
    if (addReportButtons.length > 0) {
        addReportButtons.forEach(button => {
            button.addEventListener('click', function() {
                const patientId = this.getAttribute('data-patient-id');
                // Redirect to the report page with the appointment ID
                window.location.href = `<?php echo URLROOT?>visitRecordController/addHealthRecordToAppointmentPatient/${patientId}`;
            });
        });
    } else {
        console.log('No "Add Report" buttons found on this page');
    }
});
</script>
    



   
</body>
</html>