document.getElementById("toggleSideBar").addEventListener("click", function () {
    document.querySelector(".sideBar").classList.toggle("collapsed");
    
    
    const toggleIcon = document.querySelector('.toggle-btn i');
    toggleIcon.textContent = toggleIcon.textContent === 'chevron_left' ? 'chevron_right' : 'chevron_left';
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
    
    // Special case for patient profiles - should keep Search Patients active
    if (currentPath.includes('patient') && currentPath.includes('profile')) {
        // Find the search patients nav item
        navItems.forEach(item => {
            const link = item.querySelector('.nav-link');
            if (link && link.getAttribute('href') && 
                link.getAttribute('href').includes('searchPatient')) {
                item.classList.add('active');
                foundActive = true;
                // Save this active item
                saveActiveNavItem('searchPatient');
                console.log('Patient profile detected, keeping Search Patients active');
            }
        });
    } 
    
    // If not a special case, proceed with normal matching
    if (!foundActive) {
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
                // Save this active item
                saveActiveNavItem(lastSegment);
            }
        });
    }
    
    // If no match was found, load previous active nav item
    if (!foundActive && navItems.length > 0) {
        const lastActiveItem = loadActiveNavItem();
        let matchFound = false;
        
        if (lastActiveItem) {
            navItems.forEach(item => {
                const link = item.querySelector('.nav-link');
                if (link && link.getAttribute('href') && 
                    link.getAttribute('href').includes(lastActiveItem)) {
                    item.classList.add('active');
                    matchFound = true;
                    console.log('Restored previous active item:', lastActiveItem);
                }
            });
        }
        
        // If still no match, default to home
        if (!matchFound) {
            navItems[0].classList.add('active');
            console.log('No match found and no previous item, defaulting to first nav item');
        }
    }
}

// Function to save the current active nav item
function saveActiveNavItem(itemIdentifier) {
    localStorage.setItem('activeNavItem', itemIdentifier);
}

// Function to load the previously active nav item
function loadActiveNavItem() {
    return localStorage.getItem('activeNavItem');
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
