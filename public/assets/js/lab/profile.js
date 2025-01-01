function savePersonalInfo() {
    alert("Personal information saved!");
  }
  
  function updateLabInfo() {
    alert("Laboratory information updated!");
  }
  
  function changePassword() {
    const newPassword = document.getElementById("new-password").value;
    const confirmPassword = document.getElementById("confirm-new-password").value;
  
    if (newPassword === confirmPassword) {
      alert("Password updated successfully!");
    } else {
      alert("Passwords do not match!");
    }
  }
  
  function uploadProfilePicture(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
  
    reader.onload = function () {
      document.getElementById("profile-pic").src = reader.result;
    };
  
    if (file) {
      reader.readAsDataURL(file);
    }
  }
  
  function updateProfilePicture() {
    alert("Profile picture updated!");
  }
  
  function deleteAccount() {
    if (confirm("Are you sure you want to delete your account?")) {
      alert("Account deleted!");
    }
  }
  