<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Login Interface</title>
    <link rel="stylesheet" href="<?php echo URLROOT?>public/Assets/css/labPhar.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="header">
                <img src="<?php echo URLROOT?>public/Assets/images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo" class="logo">
                <h1>Welcome back!</h1>
                <p>Please enter your details</p>
            </div>
            
            <!-- login.php -->
<form action="<?php echo URLROOT; ?>/labController/authenticate" method="POST">
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $data['email']; ?>" required>
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
    </div>

    <div>
        <button type="submit" id="logn">Login</button>
    </div>

    <?php if (!empty($data['error'])): ?>
        <p><?php echo $data['error']; ?></p>
    <?php endif; ?>
</form>

            

            <div class="links">
                <p class="signup-text">Don't have an account yet? <a href="<?php echo URLROOT?>homecontroller/selectActor">Sign Up</a></p>
                <p class="signup-text"><a href="forgot">Forgot your password?</a></p>
                <p class="signup-text">Don't have an account yet? <a href="<?php echo URLROOT?>labpharloginController/authenticate">lab</a></p>
            </div>
        </div>

        <div class="illustration">
            <img src="<?php echo URLROOT?>public/Assets/images/SignIn_admin.png" alt="Doctors Illustration">
        </div>
    </div>
</body>

</html>

