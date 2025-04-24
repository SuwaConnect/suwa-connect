<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>/public/assets/css/lab/success.css">
</head>
<body>
    <div class="success-container">
        <div class="message">
            <h1>Registration Successful</h1>
            <p> Thank you for registering with us! Your application is currently under review. You will receive an email notification once it is approved. We appreciate your patience!'; </p>
             <!-- Unset session after displaying -->
        </div>

        <div class="image-container">
            <img src="<?php echo URLROOT;?>public/images/doctor/images/doctor-visit.png" alt="A doctor assisting a patient" />
        </div>

        <div class="button-container">
            <a href="<?php echo URLROOT . '/homecontroller/index'; ?>" class="btn">Go to Home</a>
        </div>
    </div>
</body>
</html>