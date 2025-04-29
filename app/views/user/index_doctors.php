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
            <a href="#doctors-professionals" class="active">Home</a>
            <a href="#pro-benefits">Features</a>
            <a href="#pro-testimonials">Testimonials</a>            
            <a href="#faqs">FAQs</a>
            <button id="signinbutton" class="btn-primary" onclick="window.location.href='<?php echo URLROOT; ?>homecontroller/patientSignIn';">Sign In</button>
            <button id="signupbutton" class="btn-secondary" onclick="window.location.href='<?php echo URLROOT?>homecontroller/selectActor';">Sign Up</button>
       
        

        </div>
    </nav>
    
    <section class="doctors-professionals" id="doctors-professionals">
    <!-- Hero Section -->
    <div class="pro-hero">
        <div class="pro-hero-content">
            <div class="pro-hero-text">
                <h1>Empower Your Practice with <span class="highlight">Suwa Connect!</span></h1>
                <p class="pro-subtitle">Join a growing network of healthcare professionals committed to providing seamless and efficient care. Manage patient records, appointments, and prescriptions—all in one place.</p>
                <div class="pro-cta-buttons">
                    <button class="btn-primary">Sign Up as a Professional</button>
                    <button class="btn-secondary">Log In to Your Account</button>
                </div>
            </div>
            <div class="pro-hero-image">
                <img src="<?php echo URLROOT; ?>public/assets/images/doctor_nurse.png" alt="Healthcare professional using digital platform">
            </div>
        </div>
    </div>
    </section>
    <!-- Benefits Section -->
     <section id="pro-benefits">
    <div class="pro-benefits">
        <h2>Why Choose <span class="highlight">Suwa Connect</span></h2>
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon patient-icon"></div>
                <h3>Streamlined Patient Management</h3>
                <p>Access patient medical history and updates effortlessly</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon schedule-icon"></div>
                <h3>Appointment Scheduling Made Easy</h3>
                <p>Manage and track consultations with minimal hassle</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon security-icon"></div>
                <h3>Secure Record Keeping</h3>
                <p>Maintain privacy and compliance with advanced data protection</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon network-icon"></div>
                <h3>Enhanced Reach</h3>
                <p>Connect with more patients through our platform</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon tools-icon"></div>
                <h3>Time-Saving Tools</h3>
                <p>Automate prescriptions, reminders, and reporting</p>
            </div>
        </div>
    </div>
</section>

    <!-- Supporting Text -->
     <section id="pro-support">
    <div class="pro-support">
        <div class="support-content">
            <p>With Suwa Connect, you can focus more on what matters—your patients—while we handle the administrative tasks for you.</p>
        </div>
    </div>

    <!-- Testimonial Section -->
     <section id="pro-testimonials">
    <div class="pro-testimonial">
        <div class="testimonial-card">
            <div class="quote-icon">"</div>
            <p class="testimonial-text">Suwa Connect has transformed the way I manage my practice. The platform is user-friendly, and my patients appreciate the seamless experience.</p>
            <div class="testimonial-author">
                <img src="<?php echo URLROOT ;?>public/assets/images/testimonial.jpg" alt="Dr. A. Perera" class="author-image">
                <div class="author-info">
                    <h4>Dr. A. Perera</h4>
                    <p>General Practitioner</p>
                </div>
            </div>
        </div>

        <div class="testimonial-card">
            <div class="quote-icon">"</div>
            <p class="testimonial-text">Suwa Connect has transformed the way I manage my practice. The platform is user-friendly, and my patients appreciate the seamless experience.</p>
            <div class="testimonial-author">
                <img src="<?php echo URLROOT ;?>public/assets/images/testimonial.jpg" alt="Dr. A. Perera" class="author-image">
                <div class="author-info">
                    <h4>Dr. A. Perera</h4>
                    <p>General Practitioner</p>
                </div>
            </div>
        </div>
        <div class="testimonial-card">
            <div class="quote-icon">"</div>
            <p class="testimonial-text">Suwa Connect has significantly improved my workflow. The ease of use and accessibility is unmatched.</p>
            <div class="testimonial-author">
                <img src="<?php echo URLROOT ;?>public/assets/images/testimonial2.jpg" alt="Dr. B. Silva" class="author-image">
                <div class="author-info">
                    <h4>Dr. B. Silva</h4>
                    <p>Pediatrician</p>
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
                    <p>This platform is designed to connect doctors and healthcare professionals with patients, enabling seamless appointment management, access to patient records, prescription handling, and more.                    </p>
                </div>
            </div>
    
            <div class="faq-item">
                <div class="faq-question">
                    <h3>How do I sign up as a healthcare professional?</h3>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">
                    <p>Click on the "Sign Up" button in the Doctors & Professionals section and fill out the required details, including your medical license and specialization.
                    </p>
                </div>
            </div>
    
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Can I access patient records through the platform?</h3>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">
                    <p>Yes, the platform allows you to access patient records with their consent, ensuring privacy and compliance with regulations.
                    </p>
                </div>
            </div>
    
            <div class="faq-item">
                <div class="faq-question">
                    <h3>How can I manage my appointments through the platform?</h3>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">
                    <p>You can view, schedule, and manage your appointments using the integrated appointment calendar in your dashboard.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <div class="cta">
        <h2>Ready to Transform Your Practice?</h2>
        <p>Join Suwa Connect and take your practice to the next level</p>
        <button class="btn-secondary">Get Started Now</button>
    </div>

    <!-- Sign in & Sign Up Popup to select the user Role-->
    <!-- <div id="role-selection-popup" class="role-popup">
        <div class="role-popup-content">
            <span class="close-popup">&times;</span>
            <h2>Select Your Role</h2>
            <div class="role-options">
                <div class="role-card" data-role="patient" onclick="window.location.href='<?php echo URLROOT; ?>homecontroller/patientSignIn';">
                    <img src="<?php echo URLROOT ;?>public/assets/images/patient_icon.png" alt="Patient">
                    <h3>Patient</h3>
                    <p>Access personal health records and book appointments</p>
                </div>
                <div class="role-card" data-role="doctor" onclick="window.location.href='<?php echo URLROOT; ?>homecontroller/doctorSignIn';">
                    <img src="<?php echo URLROOT ;?>public/assets/images/doctor_icon.jpg" alt="Doctor">
                    <h3>Doctor</h3>
                    <p>Manage patient records and consultations</p>
                </div>
                <div class="role-card" data-role="pharmacy" onclick=""window.location.href='<?php echo URLROOT; ?>homecontroller/pharmacySignIn';">
                    <img src="<?php echo URLROOT ;?>public/assets/images/pharmacy_icon.png" alt="Organization">
                    <h3>Pharmacy</h3>
                    <p>Manage institutional health services</p>
                </div>
                <div class="role-card" data-role="lab" onclick="window.location.href='<?php echo URLROOT; ?>homecontroller/labSignIn';">
                    <img src="<?php echo URLROOT ;?>public/assets/images/lab_icon.jpg" alt="Laboratory">
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


<script src="<?php echo URLROOT ;?>public/assets/js/index.js"></script>

</body>
</html>