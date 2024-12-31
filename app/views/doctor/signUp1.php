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

        <form action="<?php echo URLROOT?>doctor/register" method="post">  

                <div class="grid-container">

                    <div class="header">
                        <h1>welcome to suwa-connect...</h1>
                        <h4>Let's get your account set-up!</h4>
                    </div>

                    <!-- <input type="hidden" name="step" value="1">  -->

                        <div class="items">
                            <label for="">First name</label>
                            <input type="text" placeholder="" name="firstName">   
                        </div>

                        
                        <div class="items">
                            <label for="">Last name </label>
                            <input type="text" placeholder="" name="lastName">  
                        </div>

                        <div class="items">
                            <label for="">E-mail</label>
                            <input type="email" placeholder="" name="email">  
                        </div>

                        <div class="items">
                            <label for="">Contact no</label>
                            <input type="text" placeholder="" name="contactNo">  
                        </div>

                        <div class="items">
                            <label for="">SLMC registration no</label>
                            <input type="text" placeholder="" name="slmc_no">  
                        </div>

                        <div class="button">
                            <button class="btn" type="submit">Next</button>
                        </div>
                
                    
                </div>
        </form>

        <div class="image">
            <img src="<?php echo URLROOT;?>public/images/doctor/images/doctor-visit.png">
        </div>
        


    </div>

        


    
</body>
</html>