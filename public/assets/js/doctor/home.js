// Placeholder JavaScript functionality for interaction (can be expanded as per requirements)
document.addEventListener('DOMContentLoaded', () => {
    const markAsReadButtons = document.querySelectorAll('.action-btn');

    markAsReadButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.closest('li').style.backgroundColor = '#d1ffd6'; // Mark notification as read
            this.textContent = 'Read'; // Change button text to 'Read'
            this.disabled = true; // Disable the button
        });
    });
});
