<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Patient</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/searchPatient.css"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
 
</head>
<body>

    <?php include 'navbar-patient.php'; ?>



    <div class="main-content">
    <div class="searchbarAndProfile">
        <div class="searchbar">
            <form action="<?php echo URLROOT; ?>searchController/searchDoctor" method="post">
                <input type="search" placeholder="Search doctor..." 
                       aria-label="Search" name="search" id="search" 
                       value="<?php echo $data['search']; ?>">
                 <button type="submit">search</button>     
            </form>
        </div>
        <div class="profile">
            <img src="<?php echo URLROOT; ?>public/images/doctor/images/profile.png" alt="profile icon">
            <span><?php echo $_SESSION['user_name']; ?></span>
        </div>
    </div>
    
    <div class="patientList" id="patientList">
        <?php if(!empty($data['doctors'])) : ?>
            <?php foreach($data['doctors'] as $doctor) : ?>
                <div class="patient">
                    <div class="patient-image">
                        <img src="<?php echo URLROOT; ?>public/images/doctor/images/profile.png" alt="doctor icon">
                    </div>
                    <div id="patient-details">
                        <div class="patient-id">
                            <span id="patientId">Dr. ID: <?php echo $doctor->doctor_id; ?></span>
                        </div>
                        <div class="patient-name">
                            <span id="name">Dr. <?php echo $doctor->firstName; ?></span>
                        </div>
                        <div class="patient-specialization">
                            <span id="specialization"><?php echo $doctor->contact_no; ?></span>
                        </div>
                        <div class="request-access-btn">
                            <form action="<?php echo URLROOT?>appointmentController/book" method="POST">
                             <input type="hidden" name="doctor_id" value="<?php echo $doctor->doctor_id; ?>">  
                            <button type="submit">Make appointment</button>
                            </form>
                        </div>
                        <div class="visit-profile-btn">
                            <button>Visit profile</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="no-results">
                <p>No doctors found matching your search.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
  
             
        <script src="<?php echo URLROOT?>public/assets/js/navbartwo.js"></script>
</body>
</html>