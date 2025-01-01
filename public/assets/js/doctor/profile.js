// Add event listeners for form interactions
const editBtn = document.querySelector('.edit-btn');
const saveBtn = document.querySelector('.save-btn');
const updateBtn = document.querySelector('.update-btn');
const savePasswordBtn = document.querySelector('.save-password-btn');
const uploadDocumentBtn = document.querySelector('.upload-btn');

editBtn.addEventListener('click', () => {
  // Enable editing for personal information form
  const personalForm = document.querySelector('.personal-form');
  personalForm.querySelectorAll('input, select').forEach(field => {
    field.disabled = false;
  });
});

saveBtn.addEventListener('click', () => {
  // Save changes to personal information
  const personalForm = document.querySelector('.personal-form');
  // Collect form data
  const formData = new FormData(personalForm);
  // Send data to server or update UI
  console.log('Saving personal information:', Object.fromEntries(formData));
});

updateBtn.addEventListener('click', () => {
  // Save changes to professional information
  const professionalForm = document.querySelector('.professional-form');
  // Collect form data
  const formData = new FormData(professionalForm);
  // Send data to server or update UI
  console.log('Updating professional information:', Object.fromEntries(formData));
});

savePasswordBtn.addEventListener('click', () => {
  // Save new password
  const passwordForm = document.querySelector('.password-form');
  // Collect form data
  const formData = new FormData(passwordForm);
  // Send data to server or update UI
  console.log('Changing password:', Object.fromEntries(formData));
});

uploadDocumentBtn.addEventListener('click', () => {
  // Handle document upload
  const documentForm = document.querySelector('.document-form');
  // Collect form data
  const formData = new FormData(documentForm);
  // Send data to server or update UI
  console.log('Uploading documents:', Object.fromEntries(formData));
});

// Add event listener for two-factor authentication toggle
const twoFactorAuthToggle = document.querySelector('.two-factor-auth .toggle-switch input');
twoFactorAuthToggle.addEventListener('change', () => {
  // Enable or disable two-factor authentication
  console.log('Two-factor authentication toggled:', twoFactorAuthToggle.checked);
});

// Add event listener for language preference dropdown
const languageSelect = document.getElementById('language-select');
languageSelect.addEventListener('change', () => {
  // Update language preference
  console.log('Language preference changed:', languageSelect.value);
});