<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>homepage</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/doctor_homepage.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
</head>
  <body>
    
      
    
   

    <?php include 'navbarbhagya.php'; ?>
   

    <div class="main-content">

        <header>
          <h1>Good morning, Dr.<?php echo $_SESSION['user_name'];?>!</h1><br>
          <p>Welcome Back! Here's an overview of your platform's latest activities and performance. </p>
        </header>

      <div class="grid-container">

        <div class="large-card">
            <div class="item" id="newAppointments">
                <h3>Today appointments</h3>
                <p class="count">
                    <?php if (isset($data['today_appointments'])):{
                        echo $data['today_appointments'];
                    }else:{
                        echo 0;
                    };
                    endif?>
                </p>
            </div>

            <div class="item" id="oldPatients">
                <h3>Total patients</h3>
                
                <p class="count"><?php if (isset($data['total_patients'])):{
                        echo $data['total_patients'];
                    }else:{
                        echo 0;
                    };
                    endif?></p>
                   
            </div>

            <div class="item" id="newPatients">
                <h3>Consulted patients</h3>

                <p class="count"><?php if (isset($data['patients_consulted'])):{
                        echo $data['patients_consulted'];
                    }else:{
                        echo 0;
                    };
                    endif?></p>
            </div>
            


        </div>

        <div class="calendar" >

            <div class="calendar-header">
                <button id="prevMonth">&lt;</button>
                <h3 id="monthYear"></h3>
                <button id="nextMonth">&gt;</button>
            </div>
    
            
            <div class="day-headers">
                <div class="day-header">SUN</div>
                <div class="day-header">MON</div>
                <div class="day-header">TUE</div>
                <div class="day-header">WED</div>
                <div class="day-header">THU</div>
                <div class="day-header">FRI</div>
                <div class="day-header">SAT</div>
            </div>
    
            
            <div class="days" id="days"></div>

        </div>
        

        <div class="appointments">
    <div class="title">Today's sessions</div>
    <?php if(isset($data['todays sessions'])): ?>
        <?php $count = 1; ?>
        <?php foreach($data['todays sessions'] as $appointment): ?>
            <div class="name">
                <?php echo 'Session '.$count.': '; ?>
            </div>
            <div class="time">
                <?php 
                $start = date('g:i A', strtotime($appointment->start_time));
                $end = date('g:i A', strtotime($appointment->end_time));
                echo $start.'  -  '. $end;
                ?>
            </div>
            <?php $count++; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="name">No appointments</div>
    <?php endif; ?>
</div>



<div class="consultations">
    <div class="title">Upcoming appointments</div>
    
    <?php if(!empty($data['upcoming_appointments'])): ?>
        <?php foreach($data['upcoming_appointments'] as $appointment): ?>
            <div class="appointment-item">
                <div class="name"><?php echo $appointment->first_name . ' ' . $appointment->last_name; ?></div>
                <div class="dob"><?php
    $dob = $appointment->dob;
    $dobDate = new DateTime($dob); // Create a DateTime object from DOB
    $today = new DateTime();        // Current date
    $age = $today->diff($dobDate)->y; // Calculate the difference in years
    echo $age . ' years';
    ?><div class="gender">
    
</div></div>
                
                <div class="contact"><?php echo $appointment->contact_no?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-appointments">No upcoming appointments today</div>
    <?php endif; ?>
</div>

        <!-- <div  class="upcoming">
            <div class="title">upcoming events</div>

            <div class="name">doctor's meet</div>
            <div class="time">8.00 AM</div>

            <div class="name">interview</div>
            <div class="time">8.30 AM</div>

            <div class="name">john</div>
            <div class="time">8.00 AM</div>

           
           
        </div> -->

      </div>
    </div>

    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
    <!-- <script src="public/js/doctor/js/calender.js"></script> -->
 <script>

    var appointmentDates = <?php echo json_encode($data['appointmentDates']); ?>; // PHP array to JS

    const daysContainer = document.getElementById('days');
const monthYear = document.getElementById('monthYear');
const prevMonthBtn = document.getElementById('prevMonth');
const nextMonthBtn = document.getElementById('nextMonth');

//var appointmentDates = ["2025-04-28", "2025-04-30", "2025-05-02"]; // Example appointments

let currentMonth = new Date().getMonth(); // 0-indexed
let currentYear = new Date().getFullYear();

// Correct renderCalendar
function renderCalendar(month, year) {
    daysContainer.innerHTML = ''; // Clear previous days

    const firstDay = new Date(year, month, 1).getDay(); // Day index of 1st of the month
    const daysInMonth = new Date(year, month + 1, 0).getDate(); // Number of days in month

    // Update Month and Year title correctly
    monthYear.textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;

    // Blank cells for first row
    for (let i = 0; i < firstDay; i++) {
        const blankDiv = document.createElement('div');
        blankDiv.classList.add('day');
        daysContainer.appendChild(blankDiv);
    }

    // Create day cells
    for (let day = 1; day <= daysInMonth; day++) {
        const dayDiv = document.createElement('div');
        dayDiv.classList.add('day');
        dayDiv.textContent = day;

        // Format current date string to compare
        let dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

        // If appointment exists for this date, mark red
        if (appointmentDates.includes(dateStr)) {
            dayDiv.style.backgroundColor = 'red';
            dayDiv.style.color = 'white';
        }

        daysContainer.appendChild(dayDiv);
    }
}

// Previous Month button
prevMonthBtn.addEventListener('click', () => {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    renderCalendar(currentMonth, currentYear);
});

// Next Month button
nextMonthBtn.addEventListener('click', () => {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    renderCalendar(currentMonth, currentYear);
});

// Initial render
renderCalendar(currentMonth, currentYear);
 </script>
</body>


</html>
