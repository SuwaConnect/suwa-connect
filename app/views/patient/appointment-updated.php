<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Appointment Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            /* padding: 20px; */
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            /* max-width: 1000px; */
            width: 100%;
            height: auto;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            background-color: #f1f1f1;
            border: none;
            border-radius: 5px 5px 0 0;
            margin-right: 5px;
        }
        .tab.active {
            background-color: #2196F3;
            color: white;
        }
        .tab-content {
            display: none;
            padding: 15px;
        }
        .tab-content.active {
            display: flex;
            flex-direction: row;
        }
        .appointments-container {
            flex: 2;
            padding-right: 20px;
        }
        .calendar-container {
            flex: 1;
            padding-left: 20px;
            border-left: 1px solid #eee;
        }
        .mini-calendar {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .mini-calendar th, .mini-calendar td {
            text-align: center;
            padding: 5px;
            font-size: 12px;
        }
        .mini-calendar th {
            background-color: #f0f0f0;
        }
        .mini-calendar td {
            border: 1px solid #eee;
            cursor: pointer;
        }
        .mini-calendar td:hover {
            background-color: #f9f9f9;
        }
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .calendar-nav {
            cursor: pointer;
            background: none;
            border: none;
            font-size: 14px;
        }
        .appointment-day {
            background-color: #ffebee;
            color: #d32f2f;
            font-weight: bold;
        }
        .empty-day {
            background-color: #f5f5f5;
            color: #aaa;
        }
        .appointment-item {
            padding: 10px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .doctor-appointment {
            border-left: 5px solid #2196F3;
        }
        .lab-appointment {
            border-left: 5px solid #FF9800;
        }
        .btn {
            background-color: #2196F3;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 15px;
        }
        .btn:hover {
            background-color:rgb(46, 74, 229);
        }
        .appointment-detail {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            display: none;
            font-size: 14px;
        }
        .appointment-list {
            margin-bottom: 20px;
        }
        .no-appointments {
            color: #666;
            font-style: italic;
            padding: 10px;
        }
        .current-day {
            background-color: #e8f5e9;
            font-weight: bold;
        }

        .main-content {
    background-color: #e6f2ff;
    color:#2e2e2e;
    padding: 20px;
    margin-left: 250px; /* To make space for the sidebar */
    /* padding: 20px; */
    width: calc(100% - 250px); /* Take the remaining width */
    overflow-y: auto; /* Enable scrolling if content overflows vertically */
    flex-grow: 1;
    transition: margin-left 0.3s ease, width 0.3s ease; /* Smooth transition for content resize */
}

.sideBar.collapsed + .main-content{

margin-left:80px;
width: calc(100% - 80px);
overflow-y: auto;
}

.details-btn{
    background-color: #2196F3;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
    margin-top: 5px;
}

    </style>
</head>
<body>
    <?php include "navbar-patient.php"; ?>
    <div class="main-content">
    <div class="container">
        <div class="header">
            <h1>My Appointments</h1>
        </div>
        
        <div class="tabs">
            <button class="tab active" onclick="openTab('doctor')">Doctor Appointments</button>
            <button class="tab" onclick="openTab('lab')">Lab Tests</button>
        </div>
        
        <div id="doctor" class="tab-content active">
            <div class="appointments-container">
                <h3>Upcoming Doctor Appointments</h3>
                
                <div class="appointment-list">
                    
                    <?php if(isset($data['appointments']) && !empty($data['appointments'])):?>
                     <?   foreach ($data['appointments'] as $appointment): ?>
                            <div class="appointment-item doctor-appointment">
                                <strong>Dr. <?= $appointment->firstName . ' ' . $appointment->lastName ?></strong> - <?= $appointment->specialization .' at '.$appointment->start_time ?> 
                                <p><?= $appointment->reason ?></p>
                                <button class="details-btn" onclick="toggleDetails('doctor-apt-<?= $appointment->appointment_id ?>')">View Details</button>
                                <div id="doctor-apt-<?= $appointment->appointment_id ?>" class="appointment-detail">
                                    <p><strong>Doctor:</strong> Dr. <?= $appointment->firstName . ' ' . $appointment->lastName ?></p>
                                    <p><strong>Date:</strong> <?= $appointment->appointment_date ?></p>
                                    <p><strong>Time:</strong><?= $appointment->start_time ?> </p>
                                    <p><strong>Location:</strong> <?= $appointment->street.' , '.$appointment->city.' , '.$appointment->state ; ?></p>
                                    <p><strong>Reason:</strong> <?=$appointment->reason?></p>
                                    <!-- <p><strong>Notes:</strong> </p> -->
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="no-appointments">No upcoming doctor appointments.</p>
                    <?php endif;?>
                    
                </div>
                
                <button class="btn" onclick="window.location.href='<?php echo URLROOT;?>patientcontroller/searchDoctorToMakeAppointment'">Schedule Doctor Appointment</button>
            </div>
            
            <div class="calendar-container">
                <h4>Appointment Calendar</h4>
                <div class="calendar-header">
                    <button class="calendar-nav" onclick="prevMonth('doctor')">&lt;</button>
                    <span id="doctor-month">April 2025</span>
                    <button class="calendar-nav" onclick="nextMonth('doctor')">&gt;</button>
                </div>
                <table class="mini-calendar" id="doctor-calendar">
                    <thead>
                        <tr>
                            <th>S</th>
                            <th>M</th>
                            <th>T</th>
                            <th>W</th>
                            <th>T</th>
                            <th>F</th>
                            <th>S</th>
                        </tr>
                    </thead>
                    <tbody id="doctor-calendar-body">
                        <!-- Calendar will be populated by JS -->
                    </tbody>
                </table>
                <div style="font-size: 12px; color: #666;">
                    <span style="color: #d32f2f; font-weight: bold;">●</span> Appointment dates
                </div>
            </div>
        </div>
        
        <div id="lab" class="tab-content">
            <div class="appointments-container">
                <h3>Upcoming Lab Appointments</h3>
                
                <div class="appointment-list">
                <?php foreach ($data['lab_appointments'] as $appointment): ?>
    <div class="appointment-item lab-appointment">
        <strong><?= htmlspecialchars($appointment->name ?? 'Lab Test') ?></strong> - 
        <?= date('F j, Y', strtotime($appointment->appointment_date)) ?> at 
        <?= date('g:i A', strtotime($appointment->appointment_time)) ?>
        <button class="details-btn" onclick="toggleDetails('lab-apt')">View Details</button>
        
        <div id="lab-apt" class="appointment-detail">
            <p><strong>Date:</strong> <?= date('F j, Y', strtotime($appointment->appointment_date)) ?></p>
            <p><strong>Time:</strong> <?= date('g:i A', strtotime($appointment->appointment_time)) ?></p>
            <p><strong>Location:</strong> <?= $appointment->name ?? 'Main Hospital Lab, 1st Floor' ?></p>
            
        </div>
    </div>
<?php endforeach; ?>
                    
                </div>
                
                <button class="btn" onclick="window.location.href='<?php echo URLROOT;?>patientcontroller/searchLabToMakeAppointment'">Schedule Lab Test</button>
            </div>
            
            <div class="calendar-container">
                <h4>Appointment Calendar</h4>
                <div class="calendar-header">
                    <button class="calendar-nav" onclick="prevMonth('lab')">&lt;</button>
                    <span id="lab-month">April 2025</span>
                    <button class="calendar-nav" onclick="nextMonth('lab')">&gt;</button>
                </div>
                <table class="mini-calendar" id="lab-calendar">
                    <thead>
                        <tr>
                            <th>S</th>
                            <th>M</th>
                            <th>T</th>
                            <th>W</th>
                            <th>T</th>
                            <th>F</th>
                            <th>S</th>
                        </tr>
                    </thead>
                    <tbody id="lab-calendar-body">
                        <!-- Calendar will be populated by JS -->
                    </tbody>
                </table>
                <div style="font-size: 12px; color: #666;">
                    <span style="color: #d32f2f; font-weight: bold;">●</span> Appointment dates
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

    <script>
        // Tab functionality
        function openTab(tabName) {
            // Hide all tab content
            const tabContents = document.getElementsByClassName("tab-content");
            for (let i = 0; i < tabContents.length; i++) {
                tabContents[i].classList.remove("active");
            }
            
            // Remove active class from all tabs
            const tabs = document.getElementsByClassName("tab");
            for (let i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove("active");
            }
            
            // Show the selected tab content
            document.getElementById(tabName).classList.add("active");
            
            // Add active class to the clicked tab
            const activeTab = document.querySelector(`.tab[onclick="openTab('${tabName}')"]`);
            activeTab.classList.add("active");
        }
        
        // Toggle appointment details
        function toggleDetails(id) {
            const details = document.getElementById(id);
            if (details.style.display === "block") {
                details.style.display = "none";
            } else {
                details.style.display = "block";
            }
        }
        
        // Schedule appointment function
        function scheduleAppointment(type) {
            if (type === 'doctor') {
                alert("Redirecting to doctor appointment scheduling form...");
                // Redirect to doctor appointment form
                // window.location.href = 'doctor-appointment-form.php';
            } else {
                alert("Redirecting to lab test scheduling form...");
                // Redirect to lab appointment form
                // window.location.href = 'lab-appointment-form.php';
            }
        }
        
        // Calendar functionality
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const currentDate = new Date();
        
        // Store current display dates for each calendar
        const calendarDates = {
            'doctor': new Date(),
            'lab': new Date()
        };
        
        // Sample appointment dates (for demonstration)
        const doctorAppointments = [
            new Date(2025, 3, 30), // April 30, 2025
            new Date(2025, 4, 15)  // May 15, 2025
        ];
        
        const labAppointments = [
            new Date(2025, 3, 28), // April 28, 2025
            new Date(2025, 4, 5)   // May 5, 2025
        ];
        
        // Initialize calendars
        function initCalendars() {
            renderCalendar('doctor');
            renderCalendar('lab');
        }
        
        function renderCalendar(type) {
            const currentMonth = calendarDates[type].getMonth();
            const currentYear = calendarDates[type].getFullYear();
            
            // Update month and year display
            document.getElementById(`${type}-month`).textContent = `${months[currentMonth]} ${currentYear}`;
            
            const calendarBody = document.getElementById(`${type}-calendar-body`);
            calendarBody.innerHTML = '';
            
            // Get first day of month and total days
            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            
            let date = 1;
            // Creating calendar rows and cells
            for (let i = 0; i < 6; i++) {
                // Stop if we've already displayed all days
                if (date > daysInMonth) break;
                
                const row = document.createElement('tr');
                
                // Create cells for each day of the week
                for (let j = 0; j < 7; j++) {
                    const cell = document.createElement('td');
                    
                    if (i === 0 && j < firstDay) {
                        // Empty cells before the first day of month
                        cell.classList.add('empty-day');
                    } else if (date > daysInMonth) {
                        // Empty cells after the last day of month
                        cell.classList.add('empty-day');
                    } else {
                        // Regular day cells
                        cell.textContent = date;
                        
                        // Check if current day
                        const today = new Date();
                        if (date === today.getDate() && 
                            currentMonth === today.getMonth() && 
                            currentYear === today.getFullYear()) {
                            cell.classList.add('current-day');
                        }
                        
                        // Check if this date has an appointment
                        const currentDate = new Date(currentYear, currentMonth, date);
                        const appointments = type === 'doctor' ? doctorAppointments : labAppointments;
                        
                        const hasAppointment = appointments.some(apt => 
                            apt.getDate() === date && 
                            apt.getMonth() === currentMonth && 
                            apt.getFullYear() === currentYear
                        );
                        
                        if (hasAppointment) {
                            cell.classList.add('appointment-day');
                        }
                        
                        date++;
                    }
                    
                    row.appendChild(cell);
                }
                
                calendarBody.appendChild(row);
            }
        }
        
        function prevMonth(type) {
            calendarDates[type].setMonth(calendarDates[type].getMonth() - 1);
            renderCalendar(type);
        }
        
        function nextMonth(type) {
            calendarDates[type].setMonth(calendarDates[type].getMonth() + 1);
            renderCalendar(type);
        }
        
        // Initialize the calendars when page loads
        window.onload = initCalendars;
    </script>
</body>
</html>