<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Signup Interface</title>
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/">
</head>
<body>
<div class="container">
    
        <div class="header">
            <h1>Sign Up</h1>
            <p>Let's get you all set up</p>
        </div>

        <form method="POST" action="">
        <div class="form-container">

        
           
                <div class="form-column">
                    <h3>Personal Information</h3>
                    <div class="input-group">
                        <label for="first_name">Pharmacy Name</label>
                        <input type="text" id="first_name" name="pharmacy_name" required>
                    </div>
                    <div class="input-group">
                        <label for="first_name">first Name</label>
                        <input type="text" id="last_name" name="first_name" required>
                    </div>
                    <div class="input-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                    

                    <div class="input-group">
                        <label for="nic">Owner's NIC Number</label>
                        <input type="text" id="nic" name="nic" required>
                    </div>

                    <div class="input-group">
                        <label for="nic">Registration Number</label>
                        <input type="text" id="nic" name="Registration_Number" required>
                    </div>

                    <div class="input-group">
                        <label for="nic">Upload a copy of registration</label>
                        <input type="file" id="regCopy" name="registration_copy" required>
                    </div>



                    
                    
                </div>

                <div class="form-column">

                <h3>Contact Information</h3>

                    <div class="input-group">
                        <label for="nic">Contact no</label>
                        <input type="text" id="nic" name="contact_no" required>
                    </div>
                    

                    <h3>Address</h3>
                    
                    <div class="input-group">
                        <label for="address">Address line 1(Street)</label>
                        <input type="text" id="address" name="address1" required>
                    <!-- </div> -->

                    <!-- <div class="input-group"> -->
                        <label for="address">Address line 2(city)</label>
                        <input type="text" id="address" name="address2" required>
                    <!-- </div> -->

                    <!-- <div class="input-group"> -->
                        <label for="address">Address line 3(state)</label>
                        <input type="text" id="address" name="address3" required>
                    </div>
                   

                    <h3>Account Information</h3>

                    <div class="input-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="input-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                </div>
            </div>
            
            <div class="button-group">
                <button type="submit" class="signup-button">Create Account</button>
                <p class="signup-text">Already have an account? <a href="">Sign In</a></p>
            </div>
        </form>
   
</div>

</body>
</html>


