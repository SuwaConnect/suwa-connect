const monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];

let currentDate = new Date();
const daysContainer = document.getElementById('days');
const monthYearDisplay = document.getElementById('monthYear');

function renderCalendar(date) {
    const firstDayOfMonth = new Date(date.getFullYear(), date.getMonth(), 1);
    const lastDayOfMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    const lastDayOfPrevMonth = new Date(date.getFullYear(), date.getMonth(), 0);

    const firstDayIndex = firstDayOfMonth.getDay();
    const lastDayIndex = lastDayOfMonth.getDay();
    const prevLastDay = lastDayOfPrevMonth.getDate();

    daysContainer.innerHTML = '';  // Only clear the day numbers, not headers
    monthYearDisplay.textContent = `${monthNames[date.getMonth()]} ${date.getFullYear()}`;

    // Days from previous month
    for (let i = firstDayIndex; i > 0; i--) {
        const day = document.createElement('div');
        day.classList.add('day');
        day.textContent = prevLastDay - i + 1;
        day.style.color = '#bbb'; // grey out
        daysContainer.appendChild(day);
    }

    // Days from current month
    for (let i = 1; i <= lastDayOfMonth.getDate(); i++) {
        const day = document.createElement('div');
        day.classList.add('day');
        if (i === currentDate.getDate() && date.getMonth() === currentDate.getMonth()) {
            day.classList.add('current-day');
        }
        if ([8, 14].includes(i)) { // Marking specific dates as in the image (8th and 14th)
            day.classList.add('marked-day');
        }
        day.textContent = i;
        daysContainer.appendChild(day);
    }

    // Days from next month
    for (let i = 1; i < 7 - lastDayIndex; i++) {
        const day = document.createElement('div');
        day.classList.add('day');
        day.textContent = i;
        day.style.color = '#bbb'; // grey out
        daysContainer.appendChild(day);
    }
}

document.getElementById('prevMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
});

document.getElementById('nextMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
});

// Initial render
renderCalendar(currentDate);