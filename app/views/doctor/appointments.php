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
 
</head>
<body>
    <?php include 'navbarbhagya.php'; ?>

    

    <div class="main-content">
    <h1>Appointments</h1>

    <div class="search-date">
        <form action="<?php echo URLROOT?>appointmentController/viewAppointmentsByDoctor" method="post">
            <label for="date">Select a date</label>
            <input type="date" name="date" id="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : date('Y-m-d'); ?>" required>
            <button type="submit" class="button">Search</button>
        </form>
    </div>

    <div class="toggle-buttons">
        <button class="toggle-btn active" onclick="toggleAppointments('pending')">Pending Appointments</button>
        <button class="toggle-btn" onclick="toggleAppointments('incoming')">Incoming Appointments</button>
        <!-- <button class="toggle-btn" onclick="toggleAppointments('all')">All appointments</button> -->
    </div>

    <div class="grid-container">
        <div id="pending-appointments" class="appointment-section active">
            <?php if(empty($data['pending_appointments'])): ?>
                <div class="no-appointments">No pending appointments for this date.</div>
            <?php else: ?>
                <?php foreach($data['pending_appointments'] as $pendingAppointment): ?>
                   
                    <div class="appointment-card" data-appointment-id="<?php echo $pendingAppointment->appointment_id; ?>">
                   
                    <div class="appointment-data">
                        <div><p> <?php echo date('d/m/Y', strtotime($pendingAppointment->appointment_date)); ?></p></div>
                        <div><p><?php echo date('h:i A', strtotime($pendingAppointment->slot_time)); ?></p></div>
                        <div><p><?php echo htmlspecialchars($pendingAppointment->patient_name); ?></p></div>
                        <div><p><?php echo htmlspecialchars($pendingAppointment->reason); ?></p></div>
                    </div>

                        <div class="action-buttons">

                            <form action="<?php echo URLROOT; ?>appointmentController/confirmAppointment" method="POST" style="display: inline;">
                                <input type="hidden" name="appointment_id" value="<?php echo $pendingAppointment->appointment_id; ?>">
                                <input type="hidden" name="date" value="<?php echo $pendingAppointment->appointment_date; ?>">
                                <button type="submit" name="confirm" class="confirm-btn">Confirm</button>
                            </form>
                            
                            <form action="<?php echo URLROOT; ?>appointmentController/cancelAppointment" method="POST" style="display: inline;">
                                <input type="hidden" name="appointment_id" value="<?php echo $pendingAppointment->appointment_id; ?>">
                                <input type="hidden" name="date" value="<?php echo $pendingAppointment->appointment_date; ?>">
                                <button type="submit" name="cancel" class="cancel-btn">Cancel</button>
                            </form>

                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div id="incoming-appointments" class="appointment-section">
            <?php if(empty($data['approved_appointments'])): ?>
                <div class="no-appointments">No approved appointments for this date.</div>
            <?php else: ?>
                <?php foreach($data['approved_appointments'] as $approvedAppointment): ?>
                    <div class="appointment-card">
                    <div class="appointment-data">
                        <div><p>Date: <?php echo date('d/m/Y', strtotime($approvedAppointment->appointment_date)); ?></p></div>
                        <div><p>Time: <?php echo date('h:i A', strtotime($approvedAppointment->slot_time)); ?></p></div>
                        <div><p>Patient: <?php echo htmlspecialchars($approvedAppointment->patient_name); ?></p></div>
                        <div><p>Reason: <?php echo htmlspecialchars($approvedAppointment->reason); ?></p></div>
                    </div>

                        <div class="action-buttons">

                            <form action="<?php echo URLROOT?>appointmentController/markAppointmentAsCompleted" method="POST" style="display: inline;">
                                <input type="hidden" name="appointment_id" value="<?php echo $approvedAppointment->appointment_id; ?>">
                                <input type="hidden" name="date" value="<?php echo $pendingAppointment->appointment_date; ?>">
                                <button type="submit" name="confirm" class="confirm-btn" id="confirm-btn">Mark as done</button>
                            </form>
                            
                            

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- <div id="all-appointments" class="appointment-section">
            
                <div class="no-appointments">No appointments for this date.</div>
            
               
                    <div class="appointment-card">
                    <div class="appointment-data">
                        <div><p>Date: </p></div>
                        <div><p>Time: </p></div>
                        <div><p>Patient: </p></div>
                        <div><p>Reason: </p></div>
                    </div>
                    </div>
                
        </div> -->
    </div>

    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/calender.js"></script>



    <script>
        function toggleAppointments(type) {
            // Update button states
            document.querySelectorAll('.toggle-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Hide all appointment sections
            document.querySelectorAll('.appointment-section').forEach(section => section.classList.remove('active'));
            
            // Show selected section
            document.getElementById(`${type}-appointments`).classList.add('active');
        }

        
    </script>
</body>
</html>