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

    <?php include 'navbarbhagya.php'; ?>



        <div class="main-content">
            <div class="searchbarAndProfile">
                <div class="searchbar">
                    <form action="<?php echo URLROOT;?>searchController/search" method="post">
                        <input type="search" placeholder="Search patient..." aria-label="Search" name="search" id="search">
                    </form>
                </div>
                <div class="profile">
                    <img src="<?php echo URLROOT;?>public/images/doctor/images/profile.png" alt="profile icon">
                    <span>Dr.<?php echo $_SESSION['user_name']?></span>
                </div>
            </div>
            <div class="patientList" id="patientList">
                <!-- <div class="patient">
                    <div class="patient-image">
                        <img src="public/images/doctor/images/profile.png" alt="patient icon">
                    </div>
                    
                    <div id="patient-details"> -->

                        
                        <!-- <div class="patient-id"> 
                            <span id="patientId"></span>
                        </div>
                        <div class="patient-name">
                            <span id="name"></span>
                        </div>
                        <div class="patient-age">
                            <span id="age"></span>
                        </div>
                         -->
                        <!-- <div class="request-access-btn">
                            <button>Request access</button>
                        </div>
                        <div class="visit-profile-btn">
                            <button >visit profile</button>
                        </div>  -->
                        
                               
<!--                            
                    </div> -->
                        
                <!-- </div> -->
            </div>
            

        </div>
  
             
        <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
        <script src="<?php echo URLROOT;?>public/js/doctor/js/search.js"></script>    
</body>
</html>