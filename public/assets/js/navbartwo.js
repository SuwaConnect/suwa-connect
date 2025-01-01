// JavaScript for toggling the sidebar
document.getElementById("toggleSidebar").addEventListener("click", function () {
    document.querySelector(".sidebar").classList.toggle("collapsed");
    
    // Rotate the chevron icon based on sidebar state
    const toggleIcon = document.querySelector('.toggle-btn i');
    toggleIcon.textContent = toggleIcon.textContent === 'chevron_left' ? 'chevron_right' : 'chevron_left';
});
