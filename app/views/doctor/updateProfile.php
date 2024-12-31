<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update profile</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/updateProfile.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <script src="navbar.js" defer></script>
</head>
<body>

    <?php include 'navbarbhagya.php'; ?>


    <div class="main-content">
        <h1>My profile</h1>
        <h4>Contact information</h4>
        <div class="grid-container">
            
            <div class="card">
                

                <div class="card-item">
                    <label for="firstname">first name</label>
                    <input type="text" id="name" name="name" placeholder="Name">
                </div>

                <div class="card-item">
                    <label for="lastname">last name</label>
                    <input type="text" id="name" name="name" placeholder="Name">
                </div>

                <div class="card-item">
                    <label for="email">email</label>
                    <input type="text" id="email" name="email" placeholder="Email">
                </div>

                <div></div>

                <div class="card-item">
                    <label for="email">current password</label>
                    <input type="text" id="email" name="email" placeholder="Email">
                </div>

                <div class="card-item">
                    <label for="email">new password</label>
                    <input type="text" id="email" name="email" placeholder="Email">
                </div>

                <div class="card-item">
                    <label for="email">contact number 1</label>
                    <input type="text" id="email" name="email" placeholder="Email">
                </div>

                <div class="card-item">
                    <label for="email">contact number 2</label>
                    <input type="text" id="email" name="email" placeholder="Email">
                </div>

                <div class="card-item">
                    <label for="email">medical license no:</label>
                    <input type="text" id="email" name="email" placeholder="Email">
                </div>

                <div class="card-item">
                    <label for="email">specialization</label>
                    <input type="text" id="email" name="email" placeholder="specialization 1">
                    <input type="text" id="email" name="email" placeholder="specialization 2">
                    <input type="text" id="email" name="email" placeholder="specialization 3">
                </div>

                <div class="card-item">
                    <label for="email">clinic address</label>
                    <input type="text" id="email" name="email" placeholder="street">
                    <input type="text" id="email" name="email" placeholder="city">
                    <input type="text" id="email" name="email" placeholder="state">
                </div>

                <div class="card-item" id="bio">
                    <label for="email">bio</label>
                    <input type="text" id="email" name="email" placeholder="Email">
                </div>

                <div class="update-btn">
                    <button>update</button>
                </div>



               

                



            </div>

            <div class="profile-card">
                
                <img src="<?php echo URLROOT?>./public/images/doctor/images/profile.png" alt="profile icon">
                <span>Dr. Manilka Anupama</span>
                <button>change picture</button>

            </div>

            
            
        </div>
    </div>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
</body>
</html>