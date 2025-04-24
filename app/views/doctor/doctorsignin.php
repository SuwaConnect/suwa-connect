<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/doctor/signin.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    
    <title>Login Page</title>
    
</head>

<body>

    <div class="container">

        <div class="logo-container">
            <img src="<?php echo URLROOT;?>public/assets/images/Suwa-Connect Logo.png" alt="Logo">
        </div>

        <div class="form-container">
            <h2>Welcome Back!</h2>
            <h3><color>Please enter your details.</h3>
            <form method="post" action="<?php echo URLROOT;?>logincontroller/authenticate">
    <label for="email">Email Address</label>
    <input type="text" id="email" name="email" placeholder="Email Address" required>

    <label for="password">Password</label>
    <div class="input-group">
        <input type="password" id="password" name="password" placeholder="Password" required>
        <i class="fas fa-eye toggle-icon" id="togglePassword"></i>
    </div>

    

    <button type="submit" class="btn">Sign In</button>
</form>
     <a href="<?php echo URLROOT;?>doctor/register">Don't have an account?</a>
        </div>
        <div class="image-container">
            <img src="<?php echo URLROOT;?>public/assets/images/Bagya/doctor.png" alt="Doctors">
        </div>
        

        
    </div>

    <script src="assets/js/doctor/signin.js"></script>
</body>

</html>