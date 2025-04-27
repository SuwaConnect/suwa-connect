<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Patient</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/searchDoctor.css"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Add this popup CSS style section to your head tag or add it to your CSS file -->
    <style>
        /* Popup Styles */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .popup-container {
            background-color: white;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: popupFadeIn 0.3s ease-out;
        }

        @keyframes popupFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #eaeaea;
            background-color: #f8f9fa;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .popup-header h2 {
            margin: 0;
            font-size: 1.5rem;
            color: #333;
        }

        .close-popup {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #777;
            transition: color 0.2s;
        }

        .close-popup:hover {
            color: #333;
        }

        .popup-content {
            padding: 20px;
        }

        .doctor-profile {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .profile-header {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #f0f0f0;
        }

        .profile-header-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .doctor-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .doctor-speciality {
            font-size: 1.1rem;
            color: #4b6cb7;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .doctor-reg {
            font-size: 0.9rem;
            color: #666;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .profile-section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 5px;
        }

        .doctor-bio {
            line-height: 1.6;
            color: #555;
        }

        .doctor-contact {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .contact-icon {
            font-weight: bold;
            color: #4b6cb7;
            width: 20px;
            text-align: center;
        }

        .loading-spinner {
            text-align: center;
            padding: 20px;
            color: #666;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <?php include 'navbar-patient.php'; ?>

    <div class="main-content">
    <div class="searchbarAndProfile">
        <div class="searchbar">
            <form action="<?php echo URLROOT; ?>searchController/searchDoctor" method="post">
                <input type="search" placeholder="Search doctor..." 
                       aria-label="Search" name="search" id="search" 
                       value="<?php echo isset($data['search']) ? $data['search'] : ''; ?>">
                 <button type="submit">search</button>     
            </form>
        </div>
        <div class="profile">
            <img src="<?php echo URLROOT; ?>public/images/doctor/images/profile.png" alt="profile icon">
            <span><?php echo $_SESSION['user_name']; ?></span>
        </div>
    </div>
    
    <div class="patientList" id="patientList">
        <?php if(!empty($data['doctors'])) : ?>
            <?php foreach($data['doctors'] as $doctor) : ?>
                <div class="patient">
                    <div class="patient-image">
                        <img src="<?php echo URLROOT; ?>uploads/profile_pictures/doctor/<?php echo $doctor->profile_picture_name?>" alt="doctor icon">
                    </div>
                    <div id="patient-details">
                        <div class="patient-id">
                            <span id="patientId">Dr.<?php echo $doctor->firstName.' '.$doctor->lastName; ?></span>
                        </div>
                        <div class="patient-name">
                            <span id="name"><?php echo $doctor->specialization; ?></span>
                        </div>
                        <div class="patient-specialization">
                            <span id="specialization"><?php echo $doctor->state; ?></span>
                        </div>
                        <div class="request-access-btn">
                            <form action="<?php echo URLROOT?>appointmentController/book" method="POST">
                             <input type="hidden" name="doctor_id" value="<?php echo $doctor->doctor_id; ?>">  
                            <button type="submit">Make appointment</button>
                            </form>
                        </div>
                        <div class="visit-profile-btn">
                            <button class="open-popup-btn" data-doctorid="<?php echo $doctor->doctor_id; ?>">Visit profile</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="no-results">
                <p>No doctors found matching your search.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Popup Modal -->
<div class="popup-overlay" id="doctorPopup">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Doctor Profile</h2>
            <button class="close-popup" id="closePopup">&times;</button>
        </div>
        <div class="popup-content" id="popupContent">
            <!-- Content will be dynamically populated via JavaScript -->
            <div class="loading-spinner">Loading...</div>
        </div>
    </div>
</div>

<script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

<!-- Add this JavaScript for the popup functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all "Visit profile" buttons
    var profileButtons = document.querySelectorAll('.open-popup-btn');
    var popupOverlay = document.getElementById('doctorPopup');
    var closePopupBtn = document.getElementById('closePopup');
    var popupContent = document.getElementById('popupContent');

    // Add click event to all profile buttons
    for(var i = 0; i < profileButtons.length; i++) {
        profileButtons[i].addEventListener('click', function() {
            var doctorId = this.getAttribute('data-doctorid');
            openDoctorPopup(doctorId);
        });
    }

    // Close popup when clicking the close button
    closePopupBtn.addEventListener('click', function() {
        popupOverlay.style.display = 'none';
        document.body.style.overflow = 'auto'; // Re-enable scrolling
    });

    // Close popup when clicking outside the popup content
    popupOverlay.addEventListener('click', function(event) {
        if (event.target === popupOverlay) {
            popupOverlay.style.display = 'none';
            document.body.style.overflow = 'auto'; // Re-enable scrolling
        }
    });

    // Function to open the popup and load doctor data
    function openDoctorPopup(doctorId) {
        // Show the popup with loading indicator
        popupOverlay.style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
        
        // For demonstration purposes, I'm using mockup data
        // In a real application, you would fetch this data from your server
        // using AJAX based on the doctorId
        
        // Simulating an AJAX call with setTimeout
        popupContent.innerHTML = '<div class="loading-spinner">Loading...</div>';
        
        setTimeout(function() {
    fetch('<?php echo URLROOT?>doctor/getDoctorDetails/' + doctorId)
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function(doctorData) {
            populatePopupContent(doctorData);
        })
        .catch(function(error) {
            popupContent.innerHTML = '<p>Error loading doctor information. Please try again.</p>';
            console.error('Fetch error:', error);
        });
}, 500); // Simulating network delay
}

// Function to populate the popup with doctor data
function populatePopupContent(doctor) {
    var html = 
        '<div class="doctor-profile">' +
            '<div class="profile-header">' +
                '<img src="<?php echo URLROOT ?>public/uploads/profile_pictures/doctor/' + doctor.profile_picture_name + '" alt="' + doctor.firstName + ' ' + doctor.lastName + '" class="profile-picture">' +
                '<div class="profile-header-info">' +
                    '<div class="doctor-name">Dr. ' + doctor.firstName + ' ' + doctor.lastName + '</div>' +
                    '<div class="doctor-speciality">' + doctor.specialization + '</div>' +
                    '<div class="doctor-reg">' +
                        '<span style="color: #4b6cb7; font-weight: bold;">✓</span> ' +
                        'Registration No: ' + doctor.slmc_no +
                    '</div>' +
                '</div>' +
            '</div>' +
            
            '<div class="profile-section">' +
                '<div class="section-title">About</div>' +
                '<div class="doctor-bio">' + doctor.bio + '</div>' +
            '</div>' +
            
            '<div class="profile-section">' +
                '<div class="section-title">Contact Information</div>' +
                '<div class="doctor-contact">' +
                    '<div class="contact-item">' +
                        '<div class="contact-icon">📍</div>' +
                        '<div>' + doctor.street + ', ' + doctor.city + ', ' + doctor.state + '</div>' +
                    '</div>' +
                    '<div class="contact-item">' +
                        '<div class="contact-icon">📞</div>' +
                        '<div>' + doctor.contact_no + '</div>' +
                    '</div>' +
                    '<div class="contact-item">' +
                        '<div class="contact-icon">📞</div>' +
                        '<div>' + doctor.contact_no2 + '</div>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>';
    
    popupContent.innerHTML = html;
}
});
</script>
</body>
</html>