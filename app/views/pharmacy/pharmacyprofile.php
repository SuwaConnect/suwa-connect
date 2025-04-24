<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/pharmacyhome.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/css/doctor/navbarcssbhagya.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/pharmacy/pharmacydashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/pharmacy/pharmacyprofile.css">

    <title>Pharmacies Home - Suwa-Connect</title>
</head>
<body>
  
<div class="sideBar">

<div class="logo">
    <img src="<?php echo URLROOT?>public/assets/images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
    <h2>සුව CONNECT</h2>
    <button class="toggle-btn" id="toggleSideBar">
        <i class="material-icons-round">chevron_left</i>
    </button>
</div>

<ul class="nav-menu">

    <li class="nav-item">
            <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyHome" class="nav-link">
            <i class="material-icons-round">home</i> <span>Home</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyOrders" class="nav-link">
            <i class="material-icons-round">medical_services</i> <span> Orders </span>
        </a>

    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyAddPromo" class="nav-link">
            <i class="material-icons-round">assignment</i> <span>Promotions </span>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyAddPromo" class="nav-link">
            <i class="material-icons-round">assignment</i> <span>Notifications </span>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyAddPromo" class="nav-link">
            <i class="material-icons-round">assignment</i> <span>Revenue </span>
        </a>
    </li>



    <li class="nav-item active">
        <a href="<?php echo URLROOT?>pharmacycontroller/pharmacyProfile" class="nav-link">
            <i class="material-icons-round">group</i> <span>Profile</span>
        </a>
    </li>

    <li class="nav-item" id="logout">
        <a href="<?php echo URLROOT?>logincontroller/logout" class="nav-link">
            <i class="material-icons-round">logout</i> <span>Logout</span>
        </a>
    </li>

</ul>
</div>


<div class="content">
    <div class="header">
        <h1>Pharmacy Profile</h1><br>
        <p>Manage your pharmacy information and verification status</p>
    </div>

    <div class="profile-content">
        <div class="profile-image">
            <img src="<?php echo URLROOT; ?>public/assets/images/pharmacy_image.png" alt="Pharmacy Image" class="image-preview">
            <span class="change-image">Change pharmacy image</span>
            <input type="file" id="profileImage" style="display: none;">
        </div>

        <h2 class="section-title">Basic Information</h2>


            <h2 class="section-title">Basic Information</h2>
            
            <div class="profile-grid">
                <div class="info-group">
                    <label for="pharmacyName">Pharmacy Name</label>
                    <input type="text" id="pharmacyName" name="pharmacy-name">
                </div>
                
                <div class="info-group">
                    <label for="licenseNumber">License Number</label>
                    <input type="text" id="licenseNumber" name="licensenumber">
                </div>
                
                <div class="info-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email">
                </div>
                
                <div class="info-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone">
                </div>
            </div>
            
            <div class="info-group">
                <label for="address">Physical Address</label>
                <textarea id="address" name="address"></textarea>
            </div>
            
            <h2 class="section-title">Operating Hours</h2>
            <div class="hours-grid">
                <div class="day-time">
                    <label>Monday</label>
                    <div class="time-inputs">
                        <input type="time" value="08:00"> <span>to</span> <input type="time" value="20:00">
                    </div>
                </div>
                
                <div class="day-time">
                    <label>Tuesday</label>
                    <div class="time-inputs">
                        <input type="time" value="08:00"> <span>to</span> <input type="time" value="20:00">
                    </div>
                </div>
                
                <div class="day-time">
                    <label>Wednesday</label>
                    <div class="time-inputs">
                        <input type="time" value="08:00"> <span>to</span> <input type="time" value="20:00">
                    </div>
                </div>
                
                <div class="day-time">
                    <label>Thursday</label>
                    <div class="time-inputs">
                        <input type="time" value="08:00"> <span>to</span> <input type="time" value="20:00">
                    </div>
                </div>
                
                <div class="day-time">
                    <label>Friday</label>
                    <div class="time-inputs">
                        <input type="time" value="08:00"> <span>to</span> <input type="time" value="20:00">
                    </div>
                </div>
                
                <div class="day-time">
                    <label>Saturday</label>
                    <div class="time-inputs">
                        <input type="time" value="08:00"> <span>to</span> <input type="time" value="20:00">
                    </div>
                </div>
                
                <div class="day-time">
                    <label>Sunday</label>
                    <div class="time-inputs">
                        <input type="time" value="10:00"> <span>to</span> <input type="time" value="16:00">
                    </div>
                </div>
            </div>
            
            <h2 class="section-title">Specialties</h2>
            <div class="specialties">
                <p>Select all specialties that apply to your pharmacy</p>
                <div class="specialties-options">
                    <div class="specialty-item selected">Prescription Drugs</div>
                    <div class="specialty-item selected">Over-the-counter Medicine</div>
                    <div class="specialty-item selected">Health Equipment</div>
                    <div class="specialty-item">Compounding</div>
                    <div class="specialty-item">Veterinary Medicine</div>
                    <div class="specialty-item">Medical Supplies</div>
                    <div class="specialty-item">Cosmetics</div>
                    <div class="specialty-item">Homeopathy</div>
                </div>
            </div>
            
            <div class="verification-section">
                <h2 class="section-title">Verification Status</h2>
                <div class="verification-status">
                    <div>Status:</div>
                    <span class="status-verified">✅ Verified</span>
                    <!-- Alternatively: <span class="status-pending">⏳ Pending Verification</span> -->
                </div>
                
                <div class="upload-section">
                    <h3>Supporting Documents</h3>
                    <p>Upload required documentation for verification</p>
                    
                    <div class="upload-btn" id="uploadDocuments">
                        <p>+ Upload Document</p>
                    </div>
                    
                    <div class="uploaded-files">
                        <div class="file-item">
                            <i>📄</i> Business_License.pdf <span class="remove">✕</span>
                        </div>
                        <div class="file-item">
                            <i>📄</i> Pharmacist_ID.pdf <span class="remove">✕</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="buttons">
                <button class="btn btn-outline">Cancel</button>
                <button class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>

    <script>
        // Toggle specialty selection
        document.querySelectorAll('.specialty-item').forEach(item => {
            item.addEventListener('click', function() {
                this.classList.toggle('selected');
            });
        });

        // Handle file upload for profile image
        document.querySelector('.change-image').addEventListener('click', function() {
            document.getElementById('profileImage').click();
        });

        document.getElementById('profileImage').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.querySelector('.image-preview').src = event.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Document upload functionality
        document.getElementById('uploadDocuments').addEventListener('click', function() {
            // Create a file input element
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = '.pdf,.doc,.docx,.jpg,.png';
            
            fileInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const fileName = e.target.files[0].name;
                    
                    // Create a new file item
                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-item';
                    fileItem.innerHTML = `<i>📄</i> ${fileName} <span class="remove">✕</span>`;
                    
                    // Add remove functionality
                    fileItem.querySelector('.remove').addEventListener('click', function() {
                        fileItem.remove();
                    });
                    
                    // Add to the list
                    document.querySelector('.uploaded-files').appendChild(fileItem);
                }
            });
            
            fileInput.click();
        });

        // Handle remove buttons for existing files
        document.querySelectorAll('.file-item .remove').forEach(btn => {
            btn.addEventListener('click', function() {
                this.parentElement.remove();
            });
        });
    </script>
</body>
</html>