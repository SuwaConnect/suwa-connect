<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Login Interface</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/Assets/css/logn.css">
</head>
<body>

    <div class="container">
        <div class="login-box">
            <div class="header">
                <img src="<?php echo URLROOT;?>public/Assets/images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo" class="logo">
                <h1>Welcome back!</h1>
                <p>Please enter your details</p>
            </div>
            
            <!-- Display Errors at the top of the form -->
            <?php if (isset($data['errors']) && !empty($data['errors'])): ?>
                <div class="error-messages">
                    <?php foreach ($data['errors'] as $error): ?>
                        <p class="error"><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Login form with CSRF protection -->
            <form method="POST" action="pharmacylogin/authenticatepharmacy">
                <?php if(function_exists('csrf_token')): ?>
                    <input type="hidden" name="csrf_token" value="">
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required 
                           placeholder="Enter your username"
                           value="<?=isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''?>">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required 
                           placeholder="Enter your password">
                </div>

                <button type="submit" class="login-button">Sign In</button>
            </form>

            <div class="links">
                <p class="signup-text">Don't have an account yet? <a href="signup">Sign Up</a></p>
                <p class="signup-text"><a href="forgot">Forgot your password?</a></p>
            </div>
        </div>

        <div class="illustration">
            <img src="<?php echo URLROOT;?>public/Assets/images/SignIn_admin.png" alt="Doctors Illustration">
        </div>
    </div>
</body>

</html>