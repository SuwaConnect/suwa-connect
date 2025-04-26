// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing navigation scripts');
    
    // Set active navigation item
    setActiveNavItem();
    
    // Setup sidebar toggle (with error handling)
    setupSidebarToggle();
});

// Function to set the active navigation item
function setActiveNavItem() {
    // Get all navigation items
    const navItems = document.querySelectorAll('.nav-item');
    console.log('Found ' + navItems.length + ' navigation items');
    
    if (navItems.length === 0) {
        console.warn('No nav items found. Check your HTML structure.');
        return;
    }
    
    // Get current page path
    const currentPath = window.location.pathname;
    console.log('Current page path:', currentPath);
    
    // Remove active class from all items first
    navItems.forEach(item => {
        item.classList.remove('active');
    });
    
    // Find the nav item that matches the current path
    let foundActive = false;
    
    navItems.forEach(item => {
        const link = item.querySelector('.nav-link');
        if (!link) return;
        
        const href = link.getAttribute('href');
        if (!href) return;
        
        // Extract just the path portion for comparison
        const hrefPath = href.split('?')[0]; // Remove query parameters
        const pathSegments = hrefPath.split('/');
        const lastSegment = pathSegments[pathSegments.length - 1];
        
        // Check if the current URL contains this path segment
        if (currentPath.includes(lastSegment) && lastSegment !== '') {
            console.log('Match found for:', lastSegment);
            item.classList.add('active');
            foundActive = true;
        }
    });
    
    // If no match was found, default to home
    if (!foundActive && navItems.length > 0) {
        navItems[0].classList.add('active');
        console.log('No match found, defaulting to first nav item');
    }
}

// Setup sidebar toggle functionality
function setupSidebarToggle() {
    // Try to find the toggle button
    const toggleBtn = document.getElementById('toggleSideBar');
    
    if (!toggleBtn) {
        console.error('Toggle button with ID "toggleSideBar" not found!');
        
        // Alternative approach: try to find by class or other selector
        const altToggleBtn = document.querySelector('.toggle-btn');
        
        if (altToggleBtn) {
            console.log('Found alternative toggle button using class selector');
            addToggleListener(altToggleBtn);
        } else {
            console.error('No toggle button found at all. Check your HTML.');
        }
    } else {
        console.log('Toggle button found by ID');
        addToggleListener(toggleBtn);
    }
}

// Helper function to add the toggle listener
function addToggleListener(button) {
    button.addEventListener('click', function() {
        console.log('Toggle button clicked');
        
        const sidebar = document.querySelector('.sideBar');
        if (!sidebar) {
            console.error('Sidebar not found. Check your HTML structure.');
            return;
        }
        
        sidebar.classList.toggle('collapsed');
        
        // Toggle the icon
        const icon = this.querySelector('i');
        if (icon) {
            if (icon.textContent === 'chevron_left') {
                icon.textContent = 'chevron_right';
            } else {
                icon.textContent = 'chevron_left';
            }
        }
    });
}