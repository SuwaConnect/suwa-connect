<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile Update</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/updateprofile.css">
    
</head>
<body>
   
    <?php include 'pharmacyNavbar.php'; ?>

    
    <div class="main-content">
        <h1>My Profile</h1>
        
        <div class="profile-container">
            <!-- Profile Picture Section -->
            <div class="profile-sidebar">
                <div class="profile-image-container">
                    <img id="profilePreview" class="profile-image" src="<?php if(isset($_SESSION['profile_picture'])){
                        echo URLROOT.'public/uploads/profile_pictures/'.$_SESSION['role'].'/'.$_SESSION['profile_picture'];
                        } else {
                            echo URLROOT.'public/images/doctor/images/profile.png';
                        }?>" alt="Doctor profile">
                </div>
                <div class="doctor-name"><?php echo $data['pharmacy']->pharmacy_name; ?></div>
                
                <form action="<?php echo URLROOT?>profileController/changeProfilePicture" method="POST" enctype="multipart/form-data">
                    <div class="upload-options">
                        <input type="file" name="profile_picture" id="profileInput" class="file-input" accept="image/*" required>
                        <button type="button" class="btn" onclick="document.getElementById('profileInput').click();">
                            Choose File
                        </button>
                        <button type="submit" class="btn">Upload</button>
                    </div>
                </form>
            </div>
            
            <!-- Profile Details Section -->
            <div class="profile-details">
                <form action="<?php echo URLROOT;?>pharmacyController/updateProfileInfo" method="post">
                <!-- Personal Information -->
                <div class="card">
                    <h2 class="section-title">Pharmacy Information</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="firstname">pharmacy Name</label>
                            <input type="text" id="firstname" name="pharmacy_name" placeholder="Enter your first name" value="<?php echo $data['pharmacy']->pharmacy_name ?? 'Doctor Name'; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="lastname">Owner Name</label>
                            <input type="text" id="lastname" name="owner_name" placeholder="Enter your last name" value="<?php echo $data['pharmacy']->contact_person ?? 'Doctor Name'; ?>">
                        </div>
                        
                        <!-- <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" value="">
                        </div> -->
                        
                        <!-- <div class="form-group">
                            <label for="specialization">Specialization</label>
                            <input type="text" id="specialization" name="specialization" placeholder="Enter your medical specialization" value="">
                        </div> -->
                        
                        <div class="form-group">
                            <label for="contact1">Primary Contact Number</label>
                            <input type="tel" id="contact1" name="contact1" placeholder="Enter your primary contact number" value="<?php echo $data['pharmacy']->contact_no ?? 'Doctor Name'; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="contact2">Secondary Contact Number</label>
                            <input type="tel" id="contact2" name="contact2" placeholder="Enter your secondary contact number (optional)" value="<?php echo $data['pharmacy']->contact_no2 ?? 'Not added'; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="license">Pharmacy License No.</label>
                            <input type="text" id="license" name="licenseNo" placeholder="Enter your medical license number" value="<?php echo $data['pharmacy']->pharmacy_reg_number ?? 'No medical license provided'; ?>" disabled>
                        </div>
                    </div>
                </div>
                
                <!-- Clinic Address -->
                <div class="card">
                    <h2 class="section-title">Pharmacy Address</h2>
                    <div class="form-group full-width">
                        <div class="address-inputs">
                            <div>
                                <label for="street">Street</label>
                                <input type="text" id="street" name="street" placeholder="Street address" value="<?php echo $data['pharmacy']->street ?? 'No address provided'; ?>">
                            </div>
                            <div>
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" placeholder="City" value="<?php echo $data['pharmacy']->city ?? 'No city provided'; ?>">
                            </div>
                            <div>
                                <label for="state">State/Province</label>
                                <input type="text" id="state" name="state" placeholder="State or Province" value="<?php echo $data['pharmacy']->state ?? 'No state provided'; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Bio -->
                <!-- <div class="card">
                    <h2 class="section-title">Professional Bio</h2>
                    <div class="form-group full-width">
                        <textarea id="bio" name="bio" placeholder="Share your professional background and expertise here..." ></textarea>
                    </div>
                </div> -->

                <div class="card">
                    <div class="form-group">
                    <h2 class="section-title">Operating hours</h2>
                    <label for="appointment-charge">From</label>
                    <input type="time" id="appointment-charge" name="start_time" placeholder="Enter opening time" value="">
                    <label for="appointment-charge">To</label>
                    <input type="time" id="appointment-charge" name="end_time" placeholder="Enter closing time" value="">
                    
                    </div>
                   
                    
                   
                </div>

                <div class="submit-container">
                    <button type="submit" class="update-btn">Update Profile</button>
                
                </form>
                </div>

                
                <!-- Password Change -->
                <div class="card">
                    <form action="">
                    <h2 class="section-title">Change Password</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" id="current_password" name="current_password" placeholder="Enter your current password">
                        </div>
                        
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password" placeholder="Enter your new password">
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your new password">
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="submit-container">
                    <button type="submit" class="update-btn">change password</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
    
    <script>
        document.getElementById("profileInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    document.getElementById("profilePreview").src = reader.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>