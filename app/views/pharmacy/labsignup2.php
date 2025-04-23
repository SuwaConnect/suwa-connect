<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Sign Up - Step 2</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/lab/signup2.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
</head>
<body>

    <div class="main-container">
        <div class="content">
            <form action="<?php echo URLROOT?>pharmacyController/signup2" method="post" enctype="multipart/form-data">
                <div class="grid-container">
                    <div class="header">
                        <h1>Welcome to Suwa-Connect...</h1>
                        <h4>Let's finish setting up your lab account!</h4>
                    </div>

                    <div class="items">
                        <label for="upload-file">Upload a copy of your pharmacy Registration Certificate</label>
                        <input id="upload-file" type="file" accept=".pdf,.jpg,.jpeg,.png" name="pharmacyRegCertificate" required>
                    </div>

                    <div class="items">
                        <label for="password">Set a password</label>
                        <input type="password" id="password" name="password" placeholder="Enter password" required>
                    </div>

                    <div class="items">
                        <label for="confirm_password">Confirm password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
                    </div>

                    <div class="check-box">
                        <input type="checkbox" name="terms" required>
                        <label for="terms">I agree to the terms and conditions.</label>
                    </div>

                    <div class="button">
                        <button class="btn" type="submit">Create Account</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="image">
            <img src="<?php echo URLROOT;?>public/images/doctor/images/doctor-visit.png" alt="A doctor assisting a patient" />
        </div>

    </div>

   

</body>
</html>
