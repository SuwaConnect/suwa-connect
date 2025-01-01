<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Signup Interface</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
<div class="container">
    <div class="form-container">
        <div class="header">
            <h1>Sign Up</h1>
            <p>Let's get you all set up</p>
        </div>
        <form method="POST" action="/signup/signup">
            <div class="form-row">
                <div class="form-column">
                    <h3>Personal Information</h3>
                    <div class="input-group">
                        <label for="first_name">Pharmacy Name</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="input-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                    <div class="input-group">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" required>
                    </div>
                    <div class="input-group">
                        <label for="nic">NIC Number</label>
                        <input type="text" id="nic" name="nic" required>
                    </div>
                    <div class="input-group">
                        <label>Gender</label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="gender" value="Male" required>
                                Male
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="gender" value="Female">
                                Female
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="gender" value="Other">
                                Other
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-column">
                    <h3>Contact Information</h3>
                    <div class="input-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="input-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" required>
                    </div>
                    <h3>Account Information</h3>
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
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
                <p class="signup-text">Already have an account? <a href="/login">Sign In</a></p>
            </div>
        </form>
    </div>
</div>

</body>
</html>


pharmacy_name
registration_number
address
phone_number
email_address
username
password