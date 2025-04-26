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
            
            <button type="submit" id="book-appointment" disabled>Book Appointment</button>
        </form>
    </div>    
             <button id="payhere">payhere</button>
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
    
    // Highlight selected timeslot
    // const buttons = document.querySelectorAll('.appointments-item button');
    // buttons.forEach(btn => btn.classList.remove('selected'));
    // event.target.classList.add('selected');
}
</script>
<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
<script>
    // Payment completed. It can be a successful failure.
    payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        // Note: validate the payment and show success or failure page to the customer
    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:"  + error);
    };

    // Put the payment variables here
    var payment = {
        "sandbox": true,
        "merchant_id": "121XXXX",    // Replace your Merchant ID
        "return_url": undefined,     // Important
        "cancel_url": undefined,     // Important
        "notify_url": "http://sample.com/notify",
        "order_id": "ItemNo12345",
        "items": "Door bell wireles",
        "amount": "1000.00",
        "currency": "LKR",
        "hash": "45D3CBA93E9F2189BD630ADFE19AA6DC", // *Replace with generated hash retrieved from backend
        "first_name": "Saman",
        "last_name": "Perera",
        "email": "samanp@gmail.com",
        "phone": "0771234567",
        "address": "No.1, Galle Road",
        "city": "Colombo",
        "country": "Sri Lanka",
        "delivery_address": "No. 46, Galle road, Kalutara South",
        "delivery_city": "Kalutara",
        "delivery_country": "Sri Lanka",
        "custom_1": "",
        "custom_2": ""
    };

    // Show the payhere.js popup, when "PayHere Pay" is clicked
    document.getElementById('payhere').onclick = function (e) {
        payhere.startPayment(payment);
    };
</script>
</body>
</html>
