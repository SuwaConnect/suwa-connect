<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        
        <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/support.css">

        <title>Suwa-Connect</title>
    </head>

    <body> 

    <?php include  "navbar-patient.php";?>

    <div class="main-container">
        

        <div class="faq-container">
        <h1>Frequently Asked Questions</h1>
            <div class="faq-item">
                <div class="faq-question">
                    <h3>What is this service about?</h3>
                </div>
                <div class="faq-answer">
                    <p>This service provides users with easy management of appointments, health records, and medical services. You can schedule appointments, view your reports, and track your health metrics.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>How do I schedule an appointment?</h3>
                </div>
                <div class="faq-answer">
                    <p>You can schedule an appointment by going to the "Appointments" section and selecting either a doctor or lab appointment. Then, follow the steps to book your desired date and time.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Can I reschedule my appointment?</h3>
                </div>
                <div class="faq-answer">
                    <p>Yes, you can reschedule your appointment by visiting the "Upcoming Appointments" section and selecting the appointment you want to modify.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>How do I update my profile?</h3>
                </div>
                <div class="faq-answer">
                    <p>To update your profile, go to the "Profile" section, where you can modify your personal details such as your name, age, weight, and profile picture.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>How can I change my password?</h3>
                </div>
                <div class="faq-answer">
                    <p>To change your password, visit the "Settings" page and click on the "Change Password" option. You will need to enter your current password and new password to update it.</p>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form">
            
            <form action="#" method="POST">
            <h2>Send Us a Message</h2>
                <label for="user-name">Name</label>
                <input type="text" id="user-name" name="name" placeholder="Your name" required>

                <label for="user-email">Email</label>
                <input type="email" id="user-email" name="email" placeholder="Your email" required>

                <label for="user-message">Message</label>
                <textarea id="user-message" name="message" placeholder="Your message" rows="5" required></textarea>

                <button type="submit" class="submit-button">Send</button>
            </form>
        </div>
    </div>

    <script src="<?php echo URLROOT?>public/assets/js/navbartwo.js"></script>
    <script src="<?php echo URLROOT?>public/support.js"></script>
</body>
</html>
