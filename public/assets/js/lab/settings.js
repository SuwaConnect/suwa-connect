// Add event listeners to the forms
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', (event) => {
      event.preventDefault();
      // Handle form submission
      console.log('Form submitted:', new FormData(event.target));
    });
  });
  
  // Add event listener to the logout button
  document.querySelector('.logout-button').addEventListener('click', () => {
    // Handle logout
    console.log('User logged out');
  });