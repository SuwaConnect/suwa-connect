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
    </div>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/calender.js"></script>
</body>
</html>