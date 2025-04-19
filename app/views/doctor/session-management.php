<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Session Management</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/manage-sessions.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
</head>
<body>
    <?php include 'navbarbhagya.php'; ?>

    <div class="main-content">
    <div class="container">
        <h1>Session Management</h1>
        
       
        
        <div class="session-controls">
            <h2>Your Session Times</h2>
            <button id="showAddForm" class="btn btn-primary">Add New Session</button>
        </div>
        
        <div id="addSessionForm" class="session-form" style="display: none;">
            <h3>Add New Session</h3>
            <form id="sessionForm" action="<?php echo URLROOT.'appointmentController/addSession'?>" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="weekDays">Days of the Week</label>
                        <div class="checkbox-group">

                            <div class="day-checkbox">
                                <input type="checkbox" id="monday" name="weekdays" value="monday">
                                <label for="monday">Monday</label>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox" id="tuesday" name="weekdays" value="tuesday">
                                <label for="tuesday">Tuesday</label>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox" id="wednesday" name="weekdays" value="wednesday">
                                <label for="wednesday">Wednesday</label>
                            </div> 
                            <div class="day-checkbox">
                                <input type="checkbox" id="thursday" name="weekdays" value="thursday">
                                <label for="thursday">Thursday</label>
                            </div> 
                            <div class="day-checkbox">
                                <input type="checkbox" id="friday" name="weekdays" value="friday">
                                <label for="friday">Friday</label>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox" id="saturday" name="weekdays" value="saturday">
                                <label for="saturday">Saturday</label>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox" id="sunday" name="weekdays" value="sunday">
                                <label for="sunday">Sunday</label>
                            </div>  
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="startTime">Start Time</label>
                        <input type="time" id="startTime" name="startTime" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="endTime">End Time</label>
                        <input type="time" id="endTime" name="endTime" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="maxPatients">Maximum Patients</label>
                        <input type="number" id="maxPatients" name="maxPatients" min="1" required>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="button" id="cancelAdd" class="btn btn-danger">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Session</button>
                </div>
            </form>
        </div>
        
        <table id="sessionsTable">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Max Patients</th>
                    <th class="action-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['sessions'])): ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">No sessions found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data['sessions'] as $session): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($session->session_date); ?></td>
                            <td><?php echo htmlspecialchars($session->start_time); ?></td>
                            <td><?php echo htmlspecialchars($session->end_time); ?></td>
                            <td><?php echo htmlspecialchars($session->max_patients); ?></td>
                            <td class="action-cell">
                                <form action="<?php echo URLROOT . 'appointmentController/deleteSession/'. $session->session_id; ?>" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this session?');">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    </div>
    
    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

    <script>
        // Only minimal JavaScript needed for UI interactions
        document.getElementById('showAddForm').addEventListener('click', function() {
            document.getElementById('addSessionForm').style.display = 'block';
        });
        
        document.getElementById('cancelAdd').addEventListener('click', function() {
            document.getElementById('addSessionForm').style.display = 'none';
            document.getElementById('sessionForm').reset();
        });
    </script>
</body>
</html>