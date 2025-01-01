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
function initializePage() {
  showTab('upcoming'); // Show the upcoming tab by default
  renderCalendar(); // Render the calendar
  addAppointmentButtonListeners(); // Add listeners for appointment change and cancel
  setupModal(); // Set up modal for scan requests
}

// Function to render the calendar
function renderCalendar() {
  const monthDays = document.getElementById('calendarDays');
  const currentDateDisplay = document.getElementById('currentDate');
  const year = currentDate.getFullYear();
  const month = currentDate.getMonth();

  // Set the current date display
  currentDateDisplay.textContent = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });

  // Clear previous days
  monthDays.innerHTML = '';

  // Calculate the first day of the month and the total days in the month
  const firstDay = new Date(year, month, 1).getDay();
  const totalDays = new Date(year, month + 1, 0).getDate();

  // Fill in the days before the start of the month
  for (let i = 0; i < firstDay; i++) {
      const emptyDay = document.createElement('div');
      monthDays.appendChild(emptyDay); // Add empty divs for alignment
  }

  // Fill in the days of the month
  for (let day = 1; day <= totalDays; day++) {
      const dayElement = document.createElement('div');
      dayElement.textContent = day;
      dayElement.classList.add('day');

      // Highlight current day
      if (day === new Date().getDate() && month === new Date().getMonth() && year === new Date().getFullYear()) {
          dayElement.classList.add('current-day');
      }

      monthDays.appendChild(dayElement);
  }
}

// Navigation Buttons Functionality
function setupNavigationButtons() {
  document.getElementById('prevMonth').onclick = function () {
      currentDate.setMonth(currentDate.getMonth() - 1);
      renderCalendar();
  };

  document.getElementById('nextMonth').onclick = function () {
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
}

// Function to add event listeners for Change and Cancel buttons
function addAppointmentButtonListeners() {
  document.querySelectorAll('.change-button').forEach(button => {
      button.addEventListener('click', () => {
          alert('Change button clicked for this appointment!');
      });
  });

  document.querySelectorAll('.cancel-button').forEach(button => {
      button.addEventListener('click', () => {
          alert('Cancel button clicked for this appointment!');
      });
  });
}

// Function to set up the modal for scan requests
function setupModal() {
  const scheduleButtons = document.querySelectorAll('.schedule-trigger');
  const scanModal = document.getElementById('request-scan-modal');
  const closeScanModalButton = document.querySelector('.close-scan-modal');

  // Add event listeners to all trigger buttons
  scheduleButtons.forEach((button) => {
      button.addEventListener('click', () => {
          scanModal.style.display = 'block';
      });
  });

  // Close modal when the "×" close button is clicked
  closeScanModalButton.addEventListener('click', () => {
      scanModal.style.display = 'none';
  });

  // Close modal when clicking outside the modal content
  window.addEventListener('click', (event) => {
      if (event.target === scanModal) {
          scanModal.style.display = 'none';
      }
  });
}

// Initialize page and calendar on window load
window.onload = function () {
  initializePage();
  setupNavigationButtons();
};
