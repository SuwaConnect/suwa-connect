<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
 
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/signup1.css" />
    
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
</head>
<body>

    <div class="main-container">
        <div class="content">
        <form action="<?php echo URLROOT?>doctor/signUpStep2" method="post" enctype="multipart/form-data">
        <div class="grid-container">
            <div class="header">
                <h1>welcome to suwa-connect...</h1>
                <h4>Let's finish setting-up!</h4>
            </div>


            
         <!-- <input type="hidden" name="step" value="2">   -->
        <div class="items"> 
            <label for="">Upload a copy of your medical license</label>
            <input id="upload-file" type="file" accept=".pdf,.jpg,.jpeg,.png" name="medicalLicenseCopy" required>   
        </div>

        
        <div class="items">
            <label for="">Set a password</label>
            <input type="text" placeholder="" name="password">  
        </div>

        <div class="items">
            <label for="">Confirm password</label>
            <input type="email" placeholder="" name="confirm_password">  
        </div>

        <div class="check-box">
            <input type="checkbox" placeholder="" name="checkbox">
            <label id="">I agree to the terms and conditions.</label>
        </div>

        


        <div class="button">
            <button class="btn" type="submit">create account</button>
        </div>
        
            
        </div>
        </form>

        <div class="image">
            <img src="<?php echo URLROOT;?>public/img/doctor/images/doctor-visit.png" alt="">
        </div>

    </div>

        


    
</body>
</html>