// Function to switch tabs
function showTab(tabName) {
    // Remove active class from all tab buttons
    const tabs = document.querySelectorAll('.tab-link');
    tabs.forEach(tab => tab.classList.remove('active'));

    // Add active class to the clicked tab
    const activeTab = document.querySelector(`[onclick="showTab('${tabName}')"]`);
    activeTab.classList.add('active');

    // Hide all tab contents
    const contents = document.querySelectorAll('.tab-content');
    contents.forEach(content => content.classList.remove('active'));

    // Show the selected tab content
    const tabContent = document.getElementById(tabName);
    tabContent.classList.add('active');
}

// Initialize the page by showing upcoming appointments by default
window.onload = function() {
    showTab('upcoming');
};

// let currentDate = new Date();

// function renderCalendar() {
//     const monthDays = document.getElementById('calendarDays');
//     const currentDateDisplay = document.getElementById('currentDate');
//     const year = currentDate.getFullYear();
//     const month = currentDate.getMonth();

//     currentDateDisplay.textContent = new Date(year, month).toLocaleString('default', { 
//         month: 'long', 
//         year: 'numeric' 
//     });

//     const firstDay = new Date(year, month, 1).getDay();
//     const totalDays = new Date(year, month + 1, 0).getDate();
//     const lastMonthDays = new Date(year, month, 0).getDate();

//     monthDays.innerHTML = '';

//     // Previous month days
//     for (let i = firstDay - 1; i >= 0; i--) {
//         const dayElement = document.createElement('div');
//         dayElement.textContent = lastMonthDays - i;
//         dayElement.classList.add('day', 'prev-date');
//         monthDays.appendChild(dayElement);
//     }

//     // Current month days
//     for (let i = 1; i <= totalDays; i++) {
//         const dayElement = document.createElement('div');
//         dayElement.textContent = i;
//         dayElement.classList.add('day');

//         if (i === new Date().getDate() && 
//             month === new Date().getMonth() && 
//             year === new Date().getFullYear()) {
//             dayElement.classList.add('current-day');
//         }

//         monthDays.appendChild(dayElement);
//     }

//     // Calculate remaining grid spaces
//     const remainingDays = 42 - (firstDay + totalDays);
    
//     // Next month days
//     for (let i = 1; i <= remainingDays; i++) {
//         const dayElement = document.createElement('div');
//         dayElement.textContent = i;
//         dayElement.classList.add('day', 'next-date');
//         monthDays.appendChild(dayElement);
//     }
// }

let currentDate = new Date();

function renderCalendar() {
    const monthDays = document.getElementById('calendarDays');
    const currentDateDisplay = document.getElementById('currentDate');
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    currentDateDisplay.textContent = new Date(year, month).toLocaleString('default', { 
        month: 'long', 
        year: 'numeric' 
    });

    const firstDay = new Date(year, month, 1).getDay();
    const totalDays = new Date(year, month + 1, 0).getDate();
    const lastMonthDays = new Date(year, month, 0).getDate();

    monthDays.innerHTML = '';

    // Previous month days
    for (let i = firstDay - 1; i >= 0; i--) {
        const dayElement = document.createElement('div');
        dayElement.textContent = lastMonthDays - i;
        dayElement.classList.add('day', 'prev-date');
        monthDays.appendChild(dayElement);
    }

    // Current month days
    for (let i = 1; i <= totalDays; i++) {
        const dayElement = document.createElement('div');
        dayElement.textContent = i;
        dayElement.classList.add('day');

        if (i === new Date().getDate() && 
            month === new Date().getMonth() && 
            year === new Date().getFullYear()) {
            dayElement.classList.add('current-day');
        }

        // Format current date to YYYY-MM-DD to check against appointment dates
        const formattedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
        
        // Check if this date has an appointment
        if (typeof appointmentDates !== 'undefined' && appointmentDates.includes(formattedDate)) {
            dayElement.classList.add('appointment-day');
        }

        monthDays.appendChild(dayElement);
    }

    // Calculate remaining grid spaces
    const remainingDays = 42 - (firstDay + totalDays);
    
    // Next month days
    for (let i = 1; i <= remainingDays; i++) {
        const dayElement = document.createElement('div');
        dayElement.textContent = i;
        dayElement.classList.add('day', 'next-date');
        monthDays.appendChild(dayElement);
    }
}



// Initialize calendar
document.addEventListener('DOMContentLoaded', () => {
    renderCalendar();
});

// Navigation event listeners
document.getElementById('prevMonth').onclick = () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
};

document.getElementById('nextMonth').onclick = () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
};

document.getElementById('prevYear').onclick = function () {
    currentDate.setFullYear(currentDate.getFullYear() - 1);
    renderCalendar();
};

document.getElementById('nextYear').onclick = function () {
    currentDate.setFullYear(currentDate.getFullYear() + 1);
    renderCalendar();
};

// Initialize calendar on page load
window.onload = function () {
    showTab('upcoming'); // Show the upcoming tab
    renderCalendar(); // Render the calendar
};