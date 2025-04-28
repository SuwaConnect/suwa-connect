<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an Appointment</title>
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/schedule.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    

</head>
<body>


    <?php include 'navbar-patient.php';?>

    <div class="main-container">

        <div class="appointment-section">

            <h1>Book an Appointment</h1>
           
            <h4>Choose a date to see available timeslots</h4>

            <div class="select-date">
        <form id="dateSearchForm">
            <input type="hidden" id="doctor_id" value="<?php echo $data['doctor_id']; ?>">
            <input type="date" id="appointment-date" name="appointment-date" 
                   min="<?php echo date('Y-m-d'); ?>" required>
            <button type="submit" id="search-appointment">Search</button>
        </form>
    </div>

    <div class="details">
        <h1>Appointment Details</h1>
        
        <form id="appointmentForm" action="<?php echo URLROOT; ?>appointmentcontroller/create" method="POST">
            <input type="hidden" name="doctor_id" value="<?php echo $data['doctor_id']; ?>">
            <input type="hidden" name="appointment_date" id="selected_date">
            <input type="hidden" name="session_id" id="selected_timeslot">
            
            <div class="details-grid">
                <p>Doctor Name</p>
                <p>Dr. <?php echo $data['doctor_name']; ?></p>

                <p>Date</p>
                <p id="display_date">Not selected</p>

                <p>Session</p>
                <p id="display_time">Not selected</p>

                <p>Special notes</p>
                <input type="text" id="reason" name="reason" required>
            </div>
            
            <button type="submit" id="book-appointment" disabled onclick="showPopup()">Book Appointment</button>
        </form>
    </div>    
             
        </div>

        <div class="appointment-list">
            <h1>Available sessions</h1>
            <div class="appointments" id="timeslots-container">
              
            </div>
        </div>  

    </div>


    <script src="<?php echo URLROOT?>assets/js/navbartwo.js"></script>
   
    <script>
    document.getElementById('dateSearchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const date = document.getElementById('appointment-date').value;
    const doctorId = document.getElementById('doctor_id').value;
    
    // Update displayed date
    document.getElementById('display_date').textContent = new Date(date).toLocaleDateString();
    document.getElementById('selected_date').value = date;
    
    // Fetch available timeslots
    fetch('<?php echo URLROOT; ?>appointmentcontroller/getDoctorSessionByDate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `doctor_id=${doctorId}&date=${date}`
    })
    .then(response => response.json())
    .then(slots => {
        const container = document.getElementById('timeslots-container');
        container.innerHTML = '';
        
        slots.forEach(slot => {
            const slotHtml = `
                <div class="appointments-item">
                    <div class="column">
                       <div class="info">
                            <span class="label">Time:</span> 
                            <span class="time">${slot.start_time} - ${slot.end_time}</span>
                        </div>
                        <div class="info">
                            <span class="label">Seats Left:</span> 
                            <span class="status">${slot.available_seats}</span>
                        </div>
                    </div>
                    <div class="button">
                        <button type="button" onclick="selectTimeSlot('${slot.session_id}', '${slot.start_time} to ${slot.end_time}')">
                            select
                        </button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', slotHtml);
        });
    });
});

function selectTimeSlot(sessionId, time) {
    // Update hidden input and display
    document.getElementById('selected_timeslot').value = sessionId;
    document.getElementById('display_time').textContent = time;
    
    // Enable book appointment button
    document.getElementById('book-appointment').disabled = false;
    
}

</script>

</body>
</html>
