<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Sign Up</title>
 
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/lab/signup1.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
</head>
<body>

    <div class="main-container">
        <!-- Form on the left side -->
        <div class="content">
            <form action="<?php echo URLROOT?>labController/labsignup1" method="post">
                <div class="grid-container">
                    <div class="header">
                        <h1>Welcome to Suwa-Connect...</h1>
                        <h4>Let's get your lab account set-up!</h4>
                    </div>

                    <div class="items">
                        <label for="labName">Lab Name</label>
                        <input type="text" id="labName" placeholder="Enter lab name" name="labName">   
                    </div>

                    <div class="items">
                        <label for="contactPerson">Contact Person</label>
                        <input type="text" id="contactPerson" placeholder="Enter contact person's name" name="contactPerson">  
                    </div>

                    <div class="items">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" placeholder="Enter email" name="email">  
                    </div>

                    <div class="items">
                        <label for="contactNo">Contact No</label>
                        <input type="text" id="contactNo" placeholder="Enter contact number" name="contactNo">  
                    </div>

                    <div class="items">
                        <label for="labRegNo">Lab Registration No</label>
                        <input type="text" id="labRegNo" placeholder="Enter lab registration number" name="labRegNo">  
                    </div>

                    <div class="button">
                        <button class="btn" type="submit">Next</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Image on the right side -->
        <div class="image">
            <img src="<?php echo URLROOT;?>public/images/doctor/images/doctor-visit.png" alt="Lab Image">
        </div>
    </div>

</body>
</html>
