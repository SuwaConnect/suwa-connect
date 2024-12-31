document.getElementById("toggleSideBar").addEventListener("click", function () {
    document.querySelector(".sideBar").classList.toggle("collapsed");
    
    
    const toggleIcon = document.querySelector('.toggle-btn i');
    toggleIcon.textContent = toggleIcon.textContent === 'chevron_left' ? 'chevron_right' : 'chevron_left';
});

