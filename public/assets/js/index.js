// FAQ Toggle Functionality
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            // Close all other FAQ items
            faqItems.forEach(otherItem => {
                if (otherItem !== item && otherItem.classList.contains('active')) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle current FAQ item
            item.classList.toggle('active');
        });
    });
});


// Update active nav link based on section
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-links a');

    window.addEventListener('scroll', () => {
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= (sectionTop - sectionHeight/3)) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if(link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const rolePopup = document.getElementById('role-selection-popup');
    const signInButton = document.getElementById('signinbutton');
    const signUpButton = document.getElementById('signupbutton');
    const closePopup = document.querySelector('.close-popup');
    
    // Function to open popup
    function openRolePopup() {
        rolePopup.style.display = 'flex';
    }

    // Function to close popup
    function closeRolePopup() {
        rolePopup.style.display = 'none';
    }

    // Event listener for sign in button
    if (signInButton) {
        signInButton.addEventListener('click', () => {
            rolePopup.setAttribute('data-mode', 'signin');
            openRolePopup();
        });
    }

    // Event listener for sign up button
    if (signUpButton) {
        signUpButton.addEventListener('click', () => {
            rolePopup.setAttribute('data-mode', 'signup');
            openRolePopup();
        });
    }

    // Close popup when clicking the close button
    if (closePopup) {
        closePopup.addEventListener('click', closeRolePopup);
    }

    // Close popup when clicking outside of it
    rolePopup.addEventListener('click', (event) => {
        if (event.target === rolePopup) {
            closeRolePopup();
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Handle role card clicks for redirection
    const roleCards = document.querySelectorAll('.role-card');
    
    roleCards.forEach(card => {
        card.addEventListener('click', () => {
            const role = card.getAttribute('data-role');
            const mode = document.getElementById('role-selection-popup').getAttribute('data-mode') || 'signin';
            
            // Fix: Use proper URL construction for redirections
            if (mode === 'signup') {
                switch(role) {
                    case 'patient':
                        window.location.href = SITE_URL +'patientcontroller/patientRegister';
                        break;
                    case 'doctor':
                        window.location.href = SITE_URL + 'doctor/viewSignUp1';
                        break;
                    case 'pharmacy':
                        window.location.href =SITE_URL + 'pharmacycontroller/pharmacySignUp1';
                        break;
                    case 'lab':
                        window.location.href = SITE_URL +'labcontroller/labSignUp';
                        break;
                }
            } else {
                // Sign-in logic
                switch(role) {
                    case 'patient':
                        window.location.href = SITE_URL +'homecontroller/patientSignIn';
                        break;
                    case 'doctor':
                        window.location.href = SITE_URL+ 'doctor/doctorLogIn';
                        break;
                    case 'pharmacy':
                        window.location.href = SITE_URL +'pharmacycontroller/pharmacySignIn';
                        break;
                    case 'lab':
                        window.location.href = SITE_URL + 'logIncontroller/authenticate';
                        break;
                }
            }
        });
    });
});