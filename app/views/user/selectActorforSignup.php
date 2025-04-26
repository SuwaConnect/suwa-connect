<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/user/selectActor.css">
    <title>Select Actor</title>
</head>
<body>
    <div class="container">
        <!-- Buttons Section -->
        <div class="button-container">
            <a href="<?php echo URLROOT?>patientcontroller/patientRegister">I am a Patient</a>
            <a href="<?php echo URLROOT?>doctor/register">I am a Doctor</a>
            <a href="<?php echo URLROOT?>labController/labsignup1">I am a Lab</a>
            <a href="<?php echo URLROOT?>pharmacyController/pharmacysignup1">I am a Pharmacy</a>
        </div>

        <!-- Image Section -->
        <div class="image-container">
            <img src="<?php echo URLROOT;?>public/assets/images/Bagya/doctor.png" alt="Select Actor">
        </div>
    </div>
</body>
</html>
