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

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/lab/signin.css">
   
    <title>Login Page</title>
    
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Welcome!</h2>
            <h3><color>Manage and monitor your healthcare platform efficiently.</h3>
            <?php if(isset($errors) && !empty($errors)): ?>
                <div class="error-messages">
                <?php foreach($errors as $error): ?>
                    <div class="error"><?=$error?></div>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="labsignin/authenticate">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password</label>
    <div class="input-group">
        <input type="password" id="password" name="password" required>
        <i class="fas fa-eye toggle-icon" id="togglePassword"></i>
    </div>

    <button type="submit" class="btn">Sign In</button>
</form>

        </div>
        <div class="image-container">
            <img src="<?php echo URLROOT;?>public/assets/images/lab/SignIn_admin.png" alt="Admin">
        </div>
    </div>

    <script src="../../public/assets/js/lab/signin.js"></script>
</body>

</html>