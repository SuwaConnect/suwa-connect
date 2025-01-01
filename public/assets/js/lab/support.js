// Handle delete advertisement modal
const deleteAdModal = document.querySelector('.delete-ad-modal');
const confirmDeleteBtn = deleteAdModal.querySelector('.confirm-delete');
const cancelDeleteBtn = deleteAdModal.querySelector('.cancel-delete');

// Open delete modal
document.querySelectorAll('.delete-ad').forEach((btn) => {
  btn.addEventListener('click', () => {
    deleteAdModal.style.display = 'flex';
  });
});

// Close delete modal
confirmDeleteBtn.addEventListener('click', () => {
  deleteAdModal.style.display = 'none';
  // Add code to handle actual deletion
});

cancelDeleteBtn.addEventListener('click', () => {
  deleteAdModal.style.display = 'none';
});

// Handle other functionality (create, edit, insights, notifications, etc.)
// You can add more JavaScript code here as needed