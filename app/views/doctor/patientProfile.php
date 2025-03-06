<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>patient profile</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/patientProfile.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <script src="navbar.js" defer></script>
</head>
<body>
    <?php include 'navbarbhagya.php'; ?>


    <div class="main-content">
        <div class="grid-container">

            <div class="profile">
                <img src="<?php echo URLROOT;?>public/images/doctor/images/profile.png" alt="">
                <div class="info-list">
                    <p>Name:</p>
                    <p><?php echo $data['patient']->first_name.' '.$data['patient']->last_name;?></p>

                    <p>Age:</p>
                    <p>25</p>

                    <p>Email</p>
                    <p><?php echo $data['patient']->email?></p>

                    <p>Patient ID:</p>
                    <p>0712345678</p>
                    
                </div>

            </div>
            <div class="search">
                <div class="search-bar">
                <input type="search" placeholder="Search health records..." aria-label="Search" />
                <button type="submit">search</button>
                <select id="dropdown" name="options">
                    <option value="option1">all</option>
                    <option value="option2">by date</option>
                    <option value="option3">by keyword</option>
                    <option value="option4">by doctor</option>
                </select>
                </div>

                <div class="search-results">

                    <div class="search-item">
                        <p class="date">24/10/2024</p>
                        <p class="doctorName">Dr. John Doe</p>
                        <p class="report-description">x-ray reports</p>
                        <button id="seeMore">see more</button>
                        <button id="delete">delete</button>
                    </div>

                    <div class="search-item">
                        <p class="date">24/10/2024</p>
                        <p class="doctorName">Dr. steven smith</p>
                        <p class="report-description">x-ray reports</p>
                        <button id="seeMore">see more</button>
                        <button id="delete">delete</button>
                    </div>

                    <div class="search-item">
                        <p class="date">24/10/2024</p>
                        <p class="doctorName">Dr. kumar perera</p>
                        <p class="report-description">MRI reports attached</p>
                        <button id="seeMore">see more</button>
                        <button id="delete">delete</button>
                    </div>

                    <div class="search-item">
                        <p class="date">24/10/2024</p>
                        <p class="doctorName">Dr. jagath</p>
                        <p class="report-description">x-ray reports</p>
                        <button id="seeMore">see more</button>
                        <button id="delete">delete</button>
                    </div>

                    
                    
                    
                    
                    
                    

                </div>
            </div>

            <div class="buttons">
                <div class="button-div"><button id="overview-btn">see overview</button></div>
                <div class="button-div"><button id="info-btn">see general info</button></div>
                <div class="button-div"><button id="addRecord-btn" onclick="addHealthRecord(<?php echo $data['patient']->patient_id?>)">add new record</button></div> 
            </div>
        
        </div>

    </div>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

    <script>
       
        function addHealthRecord(patientId) {
            window.location.href = `<?php echo URLROOT;?>visitrecordcontroller/addHealthRecord/${patientId}`;
        }
    </script>
    
</body>
</html>