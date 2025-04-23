const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

function loadCalendar(month, year) {
  const monthYear = document.getElementById("month-year");
  const calendarDates = document.getElementById("calendar-dates");

  monthYear.innerText = `${monthNames[month]} ${year}`;
  
  // Clear previous dates
  calendarDates.innerHTML = "";

  const firstDay = new Date(year, month).getDay(); // Get first day of the month
  const daysInMonth = new Date(year, month + 1, 0).getDate(); // Get number of days in month

  // Add blank spaces for days before the first day
  for (let i = 0; i < firstDay; i++) {
    const blankCell = document.createElement("div");
    calendarDates.appendChild(blankCell);
  }

  // Add the actual dates
  for (let day = 1; day <= daysInMonth; day++) {
    const dateCell = document.createElement("div");
    dateCell.classList.add("calendar-date");
    dateCell.innerText = day;

    // Highlight the current day
    if (day === new Date().getDate() && month === new Date().getMonth() && year === new Date().getFullYear()) {
      dateCell.classList.add("today");
    }

    calendarDates.appendChild(dateCell);
  }
}

function changeMonth(offset) {
  currentMonth += offset;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  loadCalendar(currentMonth, currentYear);
}

// Initialize the calendar
loadCalendar(currentMonth, currentYear);

//dashboard
