<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Signup Interface</title>
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/register.css">
</head>
<body>
<div class="container">
    <div class="form-container">
        <div class="header">
            <h1>Sign Up</h1>
            <p>Let's get you all set up</p>
        </div>
        

        <form action="<?php echo URLROOT;?>patientController/patientRegister" method="post">
<div class="row">
        <div class="form-column">
            <h3>Personal Information</h3>

            <div class="input-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" 
                    value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>">
                <?php if(isset($data['errors']['first_name'])): ?>
                    <span class="error"><?php echo $data['errors']['first_name']; ?></span>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" 
                    value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>">
                <?php if(isset($data['errors']['last_name'])): ?>
                    <span class="error"><?php echo $data['errors']['last_name']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="input-group">
                <label for="nic">NIC Number</label>
                <input type="text" id="nic" name="nic" 
                    value="<?php echo isset($_POST['nic']) ? htmlspecialchars($_POST['nic']) : ''; ?>">
                <?php if(isset($data['errors']['nic'])): ?>
                    <span class="error"><?php echo $data['errors']['nic']; ?></span>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" 
                    value="<?php echo isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : ''; ?>">
                <?php if(isset($data['errors']['dob'])): ?>
                    <span class="error"><?php echo $data['errors']['dob']; ?></span>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <label>Gender</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="gender" value="Male" 
                            <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Male') ? 'checked' : ''; ?>>
                        Male
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="gender" value="Female" 
                            <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Female') ? 'checked' : ''; ?>>
                        Female
                    </label>
                </div>
                <?php if(isset($data['errors']['gender'])): ?>
                    <span class="error"><?php echo $data['errors']['gender']; ?></span>
                <?php endif; ?>
            </div>

        </div>

        <div class="form-column">
            <h3>Contact Information</h3>

            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" 
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <?php if(isset($data['errors']['email'])): ?>
                    <span class="error"><?php echo $data['errors']['email']; ?></span>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <label for="contact_no">Contact Number</label>
                <input type="text" id="contact_no" name="contact_no" 
                    value="<?php echo isset($_POST['contact_no']) ? htmlspecialchars($_POST['contact_no']) : ''; ?>">
                <?php if(isset($data['errors']['contact_no'])): ?>
                    <span class="error"><?php echo $data['errors']['contact_no']; ?></span>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" 
                    value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>">
                <?php if(isset($data['errors']['address'])): ?>
                    <span class="error"><?php echo $data['errors']['address']; ?></span>
                <?php endif; ?>
            </div>

            <!-- <div class="input-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" 
                    value="<?php echo isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : ''; ?>">
                <?php if(isset($data['errors']['dob'])): ?>
                    <span class="error"><?php echo $data['errors']['dob']; ?></span>
                <?php endif; ?>
            </div> -->

            <h3>Account Information</h3>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <?php if(isset($data['errors']['password'])): ?>
                    <span class="error"><?php echo $data['errors']['password']; ?></span>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password">
                <?php if(isset($data['errors']['confirm_password'])): ?>
                    <span class="error"><?php echo $data['errors']['confirm_password']; ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>          

    <!-- General error message -->
    <?php if(isset($data['register_error'])): ?>
        <div class="error-message">
            <?php echo $data['register_error']; ?>
        </div>
    <?php endif; ?>

    <div class="button-group">
        <button type="submit" class="signup-button">Create Account</button>
        <p class="signup-text">Already have an account? <a href="<?php echo URLROOT; ?>/homeController/patientSignIn">Sign In</a></p>
    </div>
</form>
    </div>
</div>

</body>
</html>

