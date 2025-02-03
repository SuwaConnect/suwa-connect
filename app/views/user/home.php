<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">


    <title>Suwa Connect- Your Health Partner</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/user/landingtwo.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo"> <img src ="<?php echo URLROOT;?>public/assets/images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
        </div>
        <div class="nav-links">
            <a href="#" class="active">Home</a>
            <a href="#features">Features</a>
            <a href ="<?php echo URLROOT;?>doctor/doctorLogIn">Doctors & Professionals</a>
            <a href ="<?php echo URLROOT;?>labcontroller/labsignin">Labs</a>
            <a href ="<?php echo URLROOT;?>pharmacycontroller/pharmacysignin">Pharmacies</a>
            <a href="#faqs">FAQs</a>
            <button class="btn-primary" onclick="window.location.href='<?php echo URLROOT; ?>homecontroller/patientSignIn';">Sign in</button>

        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Empower your<br><span class="highlight">Health Journey</span><br>with Suwa-Connect</h1>
                <p>Manage your health records, book appointments, and connect with healthcare professionals—all from one
                    platform.</p>
                <button class="btn-primary" onclick="">Get Started</button>
                <button class="btn-secondary" onclick="window.location='#specialservices'">Learn More</button>


                <div class="stats">
                    <div class="stat-item">
                        <h3>200+</h3>
                        <p>Active Doctors</p>
                    </div>
                    <div class="stat-item">
                        <h3>15K+</h3>
                        <p>Active Users</p>
                    </div>
                    <div class="stat-item">
                        <h3>50+</h3>
                        <p>Active Pharmacies</p>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="image-bg"></div>
                <img src ="<?php echo URLROOT;?>public/assets/images/bagya/doctor_patient.jpg" alt="Doctor and team">
            </div>
        </div>
    </section>

    <!-- Main Services -->
    <section class="services" id="features">
        <h2>Our <span class="highlight">Key Features</span> </h2>
        <div class="service-cards">
            <div class="service-card">
                <div class="icon chat-icon"></div>
                <h3>Comprehensive Health Record Management</h3>
                <p>Securely store and manage all your health records in one place</p>
            </div>
            <div class="service-card">
                <div class="icon store-icon"></div>
                <h3>Seamless Appointment Booking</h3>
                <p>Schedule visits with top healthcare professionals and stay on track with automatic reminders</p>
            </div>
            <div class="service-card">
                <div class="icon hospital-icon"></div>
                <h3>Direct Report Sharing</h3>
                <p>Receive digital reports from labs and share prescriptions with pharmacies for convenience>
            </div>

        </div>
    </section>

    <!-- Special Services -->
    <section class="special-services" id="specialservices">
        <div class="special-content">
            <img src ="<?php echo URLROOT;?>public/assets/images/bagya/doctor.png" alt="Doctor with patient">
            <div class="special-text">
                <h2>Why Choose <span class="highlight">Suwa-Connect</span>?</h2>
                <div class="special-grid">
                    <div class="special-card">
                        <h3>Secure & Private</h3>
                        <p>Your data is protected with top-level encryption and shared only with your consent.</p>
                    </div>
                    <div class="special-card">
                        <h3>User Friendly Interface</h3>
                        <p>Navigate effortlessly through an intuitive, responsive design</p>
                    </div>
                    <div class="special-card">
                        <h3>Comprehensive Reporting</h3>
                        <p>Access detailed reports and appointment history to stay informed</p>
                    </div>
                    <div class="special-card">
                        <h3>24/7 Accessibility</h3>
                        <p>Access your health information anytime, anywhere</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FAQ Section -->
    <section class="faq" id="faqs">  
    <h2>Frequently Asked <span class="highlight">Questions</span></h2>
    <div class="faq-container">
        <div class="faq-item">
            <div class="faq-question">
                <h3>What is Suwa-Connect and how does it work?</h3>
                <span class="faq-toggle">+</span>
            </div>
            <div class="faq-answer">
                <p>Suwa-Connect is a comprehensive healthcare management platform that connects patients with healthcare providers. It allows you to manage your health records, book appointments, and communicate with healthcare professionals all in one place.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>How secure is my medical information on Suwa-Connect?</h3>
                <span class="faq-toggle">+</span>
            </div>
            <div class="faq-answer">
                <p>Your medical information is protected with enterprise-grade encryption and follows all healthcare data protection standards. We implement strict access controls and your data is only shared with healthcare providers with your explicit consent.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>How do I schedule an appointment through Suwa-Connect?</h3>
                <span class="faq-toggle">+</span>
            </div>
            <div class="faq-answer">
                <p>Scheduling an appointment is simple: Log into your account, browse available doctors or select your preferred healthcare provider, choose an available time slot, and confirm your booking. You'll receive instant confirmation and reminders via email or SMS.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>What should I do if I need to cancel or reschedule an appointment?</h3>
                <span class="faq-toggle">+</span>
            </div>
            <div class="faq-answer">
                <p>You can cancel or reschedule appointments through your dashboard up to 24 hours before the scheduled time. Simply navigate to your appointments section, select the appointment you wish to modify, and choose to either cancel or select a new time slot.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>How can I access my medical records and test results?</h3>
                <span class="faq-toggle">+</span>
            </div>
            <div class="faq-answer">
                <p>Your medical records and test results are available in your secure patient portal. Once logged in, navigate to the "Records" section where you can view, download, or share your medical history, test results, and prescriptions with authorized healthcare providers.</p>
            </div>
        </div>
    </div>
</section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>Get started with Suwa-Connect</h2>
        <p>Join thousands of patients who have already discovered easier healthcare management</p>
        <button class="btn-secondary" onclick="">Get Started Now</button>
    </section>
    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-col">
                <h3 class="logo">Suwa-Connect</h3>
                <p>Your trusted partner in healthcare management and wellness</p>
            </div>
            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="">Sign in as Admin</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Services</h3>
                <ul>
                    <li><a href="#">Support</a></li>
                    <li><a href="#">Health Store</a></li>
                    <li><a href="#">Hospital Visits</a></li>
                    <li><a href="#">Emergency Care</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Contact</h3>
                <ul>
                    <li>support@suwaconnect.com</li>
                    <li>+94-456-4744-243</li>
                    <li>123 Reid Avenue</li>
                    <li>Colombo, SL</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 suwaconnect. All rights reserved.</p>
        </div>
    </footer>

    <script src ="<?php echo URLROOT;?>public/assets/js/bagya/index.js"></script>
</body>

</html>

