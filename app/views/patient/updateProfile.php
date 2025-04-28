<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile Update</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
        }
        
        .main-content {
    background-color: #e6f2ff;
    color:#2e2e2e;
    padding: 20px;
    margin-left: 250px; /* To make space for the sidebar */
    padding: 20px;
    width: calc(100% - 250px); /* Take the remaining width */
    overflow-y: auto; /* Enable scrolling if content overflows vertically */
    flex-grow: 1;
    transition: margin-left 0.3s ease, width 0.3s ease; /* Smooth transition for content resize */
}
        
        h1 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }
        
        .profile-container {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }
        
        .profile-sidebar {
            flex: 0 0 250px;
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
            height: fit-content;
        }
        
        .profile-image-container {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 1rem;
            border: 3px solid #3498db;
        }
        
        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .patient-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .upload-options {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .file-input {
            display: none;
        }
        
        .btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #2980b9;
        }
        
        .profile-details {
            flex: 1;
            min-width: 300px;
        }
        
        .card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #2c3e50;
            font-weight: 600;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 0.5rem;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .full-width {
            grid-column: 1 / -1;
        }
        
        label {
            display: block;
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
            color: #555;
            font-weight: 500;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"],
        select,
        textarea {
            width: 100%;
            padding: 0.7rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem;
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .address-inputs {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .submit-container {
            text-align: right;
            margin-top: 1rem;
        }
        
        .update-btn {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        
        .update-btn:hover {
            background-color: #27ae60;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        
        .checkbox-group input[type="checkbox"] {
            margin-right: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .profile-container {
                flex-direction: column;
            }
            
            .profile-sidebar {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    
 <?php include 'navbar-patient.php'?>
    
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
                <div class="patient-name"><?php echo $data['first_name'].' '.$data['last_name']?></div>
                
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
                <form action="<?php echo URLROOT?>patientController/updateProfileInfo" method="post">
                    <!-- Personal Information -->
                    <div class="card">
                        <h2 class="section-title">Personal Information</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" id="firstname" name="firstname" placeholder="Enter your first name" value="<?php echo $data['first_name'] ?? 'patient Name'; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" id="lastname" name="lastname" placeholder="Enter your last name" value="<?php echo $data['last_name'] ?? 'patient Name'; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo $data['email'] ?? 'patient Name'; ?>" disabled>
                            </div> 
                            
                            <!-- <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" id="dob" name="dob" value="1985-07-15">
                            </div> -->
                            
                            <div class="form-group">
                                <label for="contact1"> Contact Number</label>
                                <input type="tel" id="contact1" name="contact_no" placeholder="Enter your primary contact number" value="<?php echo $data['contact_no'] ?? 'patient Name'; ?>">
                            </div>
                            
                            <!-- <div class="form-group">
                                <label for="contact2">Emergency Contact Number</label>
                                <input type="tel" id="contact2" name="contact2" placeholder="Enter emergency contact number" value="555-987-6543">
                            </div> -->
                            
                            <!-- <div class="form-group">
                                <label for="insurance">Insurance ID</label>
                                <input type="text" id="insurance" name="insurance" placeholder="Enter your insurance ID" value="INS-12345678">
                            </div> -->
                        </div>
                    </div>
                    
                    <!-- Address -->
                    <div class="card">
                        <h2 class="section-title">Address</h2>
                        <div class="form-group full-width">
                            <div class="address-inputs">
                                <div>
                                    <label for="street">Address</label>
                                    <input type="text" id="street" name="address" placeholder="Street address" value="<?php echo $data['address'] ?? 'patient Name'; ?>">
                                </div>
                                <!-- <div>
                                    <label for="city">City</label>
                                    <input type="text" id="city" name="city" placeholder="City" value="Cityville">
                                </div>
                                <div>
                                    <label for="state">State/Province</label>
                                    <input type="text" id="state" name="state" placeholder="State or Province" value="State">
                                </div>
                                <div>
                                    <label for="zipcode">Zip/Postal Code</label>
                                    <input type="text" id="zipcode" name="zipcode" placeholder="Zip or Postal code" value="12345">
                                </div> -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Medical Information -->
                    <div class="card">
                        <h2 class="section-title">Medical Information</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="height">Height (cm)</label>
                                <input type="number" id="height" name="height" placeholder="Enter height in centimeters" value="<?php echo $data['height'] ?? 'patient Name'; ?>">
                            </div>
                            
                            <!-- <div class="form-group">
                                <label for="weight">Weight (kg)</label>
                                <input type="number" id="weight" name="weight" placeholder="Enter weight in kilograms" value="70">
                            </div> -->
                            
                            <div class="form-group">
                                <label for="blood-type">Blood Type</label>
                                <select id="blood-type" name="blood_type">
                                    <option value="">Select Blood Type</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-" selected>O-</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="chronic-conditions">Chronic Conditions</label>
                            <textarea id="chronic-conditions" name="chronic_conditions" placeholder="List any chronic conditions you have..." ><?php echo $data['chronic_conditions'] ?? 'None reported'; ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="allergies">Allergies</label>
                            <textarea id="allergies" name="allergies" placeholder="List any allergies you have..."><?php echo $data['allergies'] ?? 'None reported'; ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="past-surgeries">Past Surgeries</label>
                            <textarea id="past-surgeries" name="past_surgeries" placeholder="List any past surgeries with dates if possible..."><?php echo $data['past_surgeries'] ?? 'None reported'; ?></textarea>
                        </div>
                        
                        <!-- <h3 class="section-title">Health Habits</h3> -->
                        <!-- <div class="form-grid">
                            <div class="form-group">
                                <div class="checkbox-group">
                                    <input type="checkbox" id="non-smoker" name="health_habits[]" value="non-smoker" checked>
                                    <label for="non-smoker">Non-Smoker</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="smoker" name="health_habits[]" value="smoker">
                                    <label for="smoker">Smoker</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="alcohol-user" name="health_habits[]" value="alcohol-user" checked>
                                    <label for="alcohol-user">Alcohol User</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="checkbox-group">
                                    <input type="checkbox" id="vegetarian" name="health_habits[]" value="vegetarian">
                                    <label for="vegetarian">Vegetarian</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="vegan" name="health_habits[]" value="vegan">
                                    <label for="vegan">Vegan</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="regular-exercise" name="health_habits[]" value="regular-exercise" checked>
                                    <label for="regular-exercise">Regular Exercise</label>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    
                    <!-- Additional Health Notes -->
                    <div class="card">
                        <h2 class="section-title">Additional Health Notes</h2>
                        <div class="form-group full-width">
                            <textarea id="health-notes" name="health_notes" placeholder="Any additional information about your health that you'd like to share..."><?php echo $data['additional_health_notes'] ?? 'patient Name'; ?></textarea>
                        </div>
                        
                    </div>
                    <div class="submit-container"><button type="submit" class="update-btn">update profile</button></div>
                    
                    </form>
                    
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
                        </form>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="submit-container">
                        <button type="submit" class="update-btn">Update Password</button>
                    </div>
                
            </div>
        </div>
    </div>
    
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