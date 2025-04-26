<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>public/css/patient/viewdoctorprofile.css"> <!-- Create a separate CSS for patient view if needed -->
</head>
<body>

<?php include 'navbarbhagya.php'; ?>

<div class="main-content">
    <h1>Doctor Profile</h1>

    <div class="profile-container">
        <!-- Profile Picture Section -->
        <div class="profile-sidebar">
            <div class="profile-image-container">
                <img class="profile-image" src="<?php 
                    if (!empty($data['doctor']->profile_picture)) {
                        echo URLROOT . 'public/uploads/profile_pictures/doctor/' . $data['doctor']->profile_picture;
                    } else {
                        echo URLROOT . 'public/images/doctor/images/profile.png';
                    }
                ?>" alt="Doctor profile">
            </div>
            <div class="doctor-name">Dr. <?php echo htmlspecialchars($data['doctor']->firstName . ' ' . $data['doctor']->lastName); ?></div>
            <div class="doctor-specialization"><?php echo htmlspecialchars($data['doctor']->specialization ?? 'Specialization not provided'); ?></div>
        </div>

        <!-- Profile Details Section -->
        <div class="profile-details">

            <!-- Personal Information -->
            <div class="card">
                <h2 class="section-title">Personal Information</h2>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($data['doctor']->email ?? 'Not provided'); ?></p>
                <p><strong>Primary Contact:</strong> <?php echo htmlspecialchars($data['doctor']->contact_no ?? 'Not provided'); ?></p>
                <p><strong>Secondary Contact:</strong> <?php echo htmlspecialchars($data['doctor']->contact_no2 ?? 'Not provided'); ?></p>
                <p><strong>Medical License No:</strong> <?php echo htmlspecialchars($data['doctor']->slmc_no ?? 'Not provided'); ?></p>
            </div>

            <!-- Clinic Address -->
            <div class="card">
                <h2 class="section-title">Clinic Address</h2>
                <p><strong>Street:</strong> <?php echo htmlspecialchars($data['doctor']->street ?? 'Not provided'); ?></p>
                <p><strong>City:</strong> <?php echo htmlspecialchars($data['doctor']->city ?? 'Not provided'); ?></p>
                <p><strong>State/Province:</strong> <?php echo htmlspecialchars($data['doctor']->state ?? 'Not provided'); ?></p>
            </div>

            <!-- Professional Bio -->
            <div class="card">
                <h2 class="section-title">Professional Bio</h2>
                <p><?php echo nl2br(htmlspecialchars($data['doctor']->bio ?? 'No bio provided')); ?></p>
            </div>

            <!-- Appointment Charges -->
            <div class="card">
                <h2 class="section-title">Consultation Charges</h2>
                <p><strong>Charges:</strong> <?php echo htmlspecialchars($data['doctor']->appointment_charges ?? 'Not provided'); ?> LKR</p>
            </div>

        </div>
    </div>
</div>

<script src="<?php echo URLROOT; ?>public/js/doctor/js/navbar.js"></script>

</body>
</html>
