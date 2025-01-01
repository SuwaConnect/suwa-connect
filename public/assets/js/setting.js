// Get elements
const popupTrigger = document.querySelector('.popup-trigger');
const popup = document.getElementById('change-password-popup');
const closeBtn = document.querySelector('.close-btn');

// Open the popup
popupTrigger.addEventListener('click', () => {
    popup.style.display = 'flex';
});

// Close the popup
closeBtn.addEventListener('click', () => {
    popup.style.display = 'none';
});

// Close popup when clicking outside
window.addEventListener('click', (event) => {
    if (event.target === popup) {
        popup.style.display = 'none';
    }
});
