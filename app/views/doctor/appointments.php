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

    <!-- <div class="main-content">
        <h1>Appointments</h1>
        <div class="grid-container">

            <div class="search-date">
                <label for="">Select a date</label>
                <input type="date" name="date" id="date">
                <button class="button">search</button>
            </div>

            <div class="appointments">
                <div class="appointment-card">
                    <div><p>24/10/2024</p></div>
                    <div><p>10:30</p></div>
                    <div><p>Mr. Udith Perera</p></div>
                    <div id="confirm-btn"><button>confirm</button></div>
                    <div><button id="cancel-btn">cancel</button></div>
                </div>

                <div class="appointment-card">
                    <div><p>24/10/2024</p></div>
                    <div><p>10:30</p></div>
                    <div><p>Mr. Udith Perera</p></div>
                    <div id="confirm-btn"><button>confirm</button></div>
                    <div><button id="cancel-btn">cancel</button></div>
                </div>

                <div class="appointment-card">
                    <div><p>24/10/2024</p></div>
                    <div><p>10:30</p></div>
                    <div><p>Mr. Udith Perera</p></div>
                    <div id="confirm-btn"><button>confirm</button></div>
                    <div><button id="cancel-btn">cancel</button></div>
                </div>
                
            
        </div>
    </div> -->

    <div class="main-content">
        <h1>Appointments</h1>

        <div class="search-date">
            <form action="" method="post">
                <label for="date">Select a date</label>
                <input type="date" name="date" id="date">
                <button type="submit" class="button" onclick="searchAppointments()">Search</button>
            </form>
        </div>

        <div class="toggle-buttons">
            <button class="toggle-btn active" onclick="toggleAppointments('pending')">Pending Appointments</button>
            <button class="toggle-btn" onclick="toggleAppointments('incoming')">Incoming Appointments</button>
        </div>

        

        <div class="grid-container">
           

            <div id="pending-appointments" class="appointment-section active">
                <div class="appointment-card">
                    <div><p>24/10/2024</p></div>
                    <div><p>10:30</p></div>
                    <div><p>Mr. Udith Perera</p></div>
                    <div id="confirm-btn"><button onclick="confirmAppointment(this)">Confirm</button></div>
                    <div><button id="cancel-btn" onclick="cancelAppointment(this)">Cancel</button></div>
                </div>

                <div class="appointment-card">
                    <div><p>24/10/2024</p></div>
                    <div><p>11:30</p></div>
                    <div><p>Mr. John Doe</p></div>
                    <div id="confirm-btn"><button onclick="confirmAppointment(this)">Confirm</button></div>
                    <div><button id="cancel-btn" onclick="cancelAppointment(this)">Cancel</button></div>
                </div>
            </div>

            <div id="incoming-appointments" class="appointment-section">
                <div class="appointment-card">
                    <div><p>24/10/2024</p></div>
                    <div><p>14:30</p></div>
                    <div><p>Ms. Jane Smith</p></div>
                    <div id="confirm-btn"><button onclick="confirmAppointment(this)">Confirm</button></div>
                    <div><button id="cancel-btn" onclick="cancelAppointment(this)">Cancel</button></div>
                </div>

                <div class="appointment-card">
                    <div><p>24/10/2024</p></div>
                    <div><p>15:30</p></div>
                    <div><p>Mr. David Wilson</p></div>
                    <div id="confirm-btn"><button onclick="confirmAppointment(this)">Confirm</button></div>
                    <div><button id="cancel-btn" onclick="cancelAppointment(this)">Cancel</button></div>
                </div>
            </div>
        </div>
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

        function searchAppointments() {
            const date = document.getElementById('date').value;
            if (!date) {
                alert('Please select a date');
                return;
            }
            // Here you would typically make an API call to fetch appointments for the selected date
            alert(`Searching appointments for ${date}`);
        }

        function confirmAppointment(button) {
            const card = button.closest('.appointment-card');
            const name = card.querySelector('div:nth-child(3) p').textContent;
            if (confirm(`Confirm appointment with ${name}?`)) {
                button.textContent = 'Confirmed';
                button.style.backgroundColor = '#6c757d';
                button.disabled = true;
            }
        }

        function cancelAppointment(button) {
            const card = button.closest('.appointment-card');
            const name = card.querySelector('div:nth-child(3) p').textContent;
            if (confirm(`Cancel appointment with ${name}?`)) {
                card.style.opacity = '0.5';
                button.textContent = 'Cancelled';
                button.style.backgroundColor = '#6c757d';
                button.disabled = true;
                const confirmBtn = card.querySelector('#confirm-btn button');
                confirmBtn.disabled = true;
                confirmBtn.style.backgroundColor = '#6c757d';
            }
        }
    </script>
</body>
</html>