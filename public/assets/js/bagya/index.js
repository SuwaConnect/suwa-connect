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
    const signUpButtons = document.querySelectorAll('.btn-signup');
    const signInButtons = document.querySelectorAll('.btn-signin');
    const closePopup = document.querySelector('.close-popup');
    const roleCards = document.querySelectorAll('.role-card');

    // Function to open popup
    function openRolePopup() {
        rolePopup.style.display = 'flex';
    }

    // Function to close popup
    function closeRolePopup() {
        rolePopup.style.display = 'none';
    }

    // Event listeners for sign up buttons
    signUpButtons.forEach(button => {
        button.addEventListener('click', () => {
            rolePopup.setAttribute('data-mode', 'signup');
            openRolePopup();
        });
    });

    // Event listeners for sign in buttons
    signInButtons.forEach(button => {
        button.addEventListener('click', () => {
            rolePopup.setAttribute('data-mode', 'signin');
            openRolePopup();
        });
    });

    // Close popup when clicking the close button
    closePopup.addEventListener('click', closeRolePopup);

    // Close popup when clicking outside of it
    rolePopup.addEventListener('click', (event) => {
        if (event.target === rolePopup) {
            closeRolePopup();
        }
    });

    // Modify role selection to handle different modes
    roleCards.forEach(card => {
        card.addEventListener('click', () => {
            const role = card.getAttribute('data-role');
            const mode = rolePopup.getAttribute('data-mode');
            
            // Redirect based on role and mode
            if (mode === 'signup') {
                switch(role) {
                    case 'patient':
                        window.location.href = 'signup_patient.html';
                        break;
                    case 'doctor':
                        window.location.href = 'signup_doctor.html';
                        break;
                    case 'pharmacy':
                        window.location.href = 'signup_organization.html';
                        break;
                    case 'lab':
                        window.location.href = 'signup_organization.html';
                        break;
                    
                }
            } else {
                // Sign-in logic
                switch(role) {
                    case 'patient':
                        window.location.href = 'signin_patient.html';
                        break;
                    case 'doctor':
                        window.location.href = 'signin_doctor.html';
                        break;
                    case 'pharmacy':
                        window.location.href = 'signin_organization.html';
                        break;
                        case 'lab':
                            window.location.href = 'signup_organization.html';
                            break;
                }
            }
        });
    });
});