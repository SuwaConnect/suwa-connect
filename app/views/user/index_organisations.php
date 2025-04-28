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
            <a href="#organisations" class="active">Home</a>
            <a href="#pro-benefits">Features</a>
            <a href="#pro-testimonials">Testimonials</a>
            <a href="#faqs">FAQs</a>
            <button id="signinbutton" class="btn-primary" onclick="window.location.href='<?php echo URLROOT; ?>homecontroller/patientSignIn';">Sign In</button>
            <button id="signupbutton" class="btn-secondary" onclick="window.location.href='<?php echo URLROOT?>homecontroller/selectActor';">Sign Up</button>
       
        

        </div>
    </nav>

    <section class="organisations" id="organisations">
        <!-- Hero Section -->
        <div class="pro-hero">
            <div class="pro-hero-content">
                <div class="pro-hero-text">
                    <h1>Partner with Us to<span class="highlight">Transform Healthcare Delivery</span></h1>
                    <p class="pro-subtitle">Effortlessly connect with patients and professionals, streamline operations,
                        and grow your services through our platform.</p>
                    <div class="pro-cta-buttons">
                        <button class="btn-primary">Sign Up as an Organisation</button>
                        <button class="btn-secondary">Log In to Your Account</button>
                    </div>
                </div>
                <div class="pro-hero-image">
                    <img src="<?php echo URLROOT ;?>public/assets/images/pharmacists.jpg" alt="Healthcare professional using digital platform">
                </div>
            </div>
        </div>
    </section>
    <!-- Benefits Section -->
    <section id="pro-benefits">
        <div class="pro-benefits">
            <h2>Why Choose <span class="highlight">Suwa Connect</span></h2>
            <h2>For Pharmacies</h2>
            <div class="benefits-grid">
            
                <div class="benefit-card">
                    <div class="benefit-icon patient-icon"></div>
                    <h3>Prescription Management</h3>
                    <p>Receive prescriptions directly from patients or doctors, reducing errors and enhancing
                        convenience. </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon schedule-icon"></div>
                    <h3>Order Fulfillment</h3>
                    <p>Streamlined order processing and delivery options for patients in your area.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon security-icon"></div>
                    <h3>Performance Insights</h3>
                    <p>Access analytics to track your sales and identify opportunities for growth.</p>
                </div>
            </div>
                <h2>For Laboratories</h2>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon network-icon"></div>
                    <h3>Enhanced Reach</h3>
                    <p>Connect with more patients through our platform</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon tools-icon"></div>
                    <h3>Appointment Management</h3>
                    <p>Simplify the process of booking lab tests and managing schedules.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon tools-icon"></div>
                    <h3>Analytics Dashboard</h3>
                    <p>Get insights into the number of tests performed, revenue generated, and patient demographics.</p>
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- Supporting Text -->
    <section id="pro-support">
        <div class="pro-support">
            <div class="support-content">
                <p>Empowering Healthcare Providers!<br>
                    Our platform is designed to enhance the efficiency and reach of pharmacies and laboratories by simplifying processes and improving patient access.</p>
            </div>
        </div>

        <!-- Testimonial Section -->
        <section id="pro-testimonials">
            <div class="pro-testimonial">
                <div class="testimonial-card">
                    <div class="quote-icon">"</div>
                    <p class="testimonial-text">This platform has completely streamlined how we interact with patients and doctors. It's a game-changer for pharmacies!</p>
                    <div class="testimonial-author">
                        <img src="<?php echo URLROOT ;?>public/assets/images/testimonial.jpg" alt="Dr. A. Perera" class="author-image">
                        <div class="author-info">
                            <h4>John Doe</h4>
                            <p>Pharmacist</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="quote-icon">"</div>
                    <p class="testimonial-text">We’ve seen a 30% increase in lab test bookings since joining. The system’s integration is seamless!</p>
                    <div class="testimonial-author">
                        <img src="<?php echo URLROOT ;?>public/assets/images/testimonial.jpg" alt="Dr. A. Perera" class="author-image">
                        <div class="author-info">
                            <h4>Jane Smith</h4>
                            <p>Laboratory Manager</p>
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
                        <h3>What is this platform, and how does it benefit healthcare professionals?
                        </h3>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>This platform is designed to connect doctors and healthcare professionals with patients,
                            enabling seamless appointment management, access to patient records, prescription handling,
                            and more. </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How do I sign up as a healthcare professional?</h3>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Click on the "Sign Up" button in the Doctors & Professionals section and fill out the
                            required details, including your medical license and specialization.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Can I access patient records through the platform?</h3>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, the platform allows you to access patient records with their consent, ensuring privacy
                            and compliance with regulations.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How can I manage my appointments through the platform?</h3>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>You can view, schedule, and manage your appointments using the integrated appointment
                            calendar in your dashboard.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <div class="cta">
            <h2>Ready to elevate your services and simplify your operations?</h2>
            <p>Join our network of trusted pharmacies and laboratories today.</p>
            <button class="btn-secondary">Get Started Now</button>
        </div>

  <!-- Sign in & Sign Up Popup to select the user Role-->
  <!-- <div id="role-selection-popup" class="role-popup">
        <div class="role-popup-content">
            <span class="close-popup">&times;</span>
            <h2>Select Your Role</h2>
            <div class="role-options">
                <div class="role-card" data-role="patient">
                    <img src="<?php echo URLROOT ;?>public/assets/images/patient_icon.png" alt="Patient">
                    <h3>Patient</h3>
                    <p>Access personal health records and book appointments</p>
                </div>
                <div class="role-card" data-role="doctor">
                    <img src="<?php echo URLROOT ;?>public/assets/images/doctor_icon.jpg" alt="Doctor">
                    <h3>Doctor</h3>
                    <p>Manage patient records and consultations</p>
                </div>
                <div class="role-card" data-role="pharmacy">
                    <img src="<?php echo URLROOT ;?>public/assets/images/pharmacy_icon.png" alt="Organization">
                    <h3>Pharmacy</h3>
                    <p>Manage institutional health services</p>
                </div>
                <div class="role-card" data-role="lab">
                    <img src="<?php echo URLROOT ;?>public/assets/images/lab_icon.jpg" alt="Patient">
                    <h3>Laboratory</h3>
                    <p>Access personal health records and book appointments</p>
                </div>
            </div>
        </div>
    </div> -->



    
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
                        <li><a href="#">Find Doctors</a></li>
                        <li><a href="#">Contact Us</a></li>
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

        <script>
    const SITE_URL = "<?php echo URLROOT; ?>";
</script>

        <script src="<?php echo URLROOT; ?>public/assets/js/index.js"></script>

</body>

</html>