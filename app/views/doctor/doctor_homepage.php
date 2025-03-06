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
                <h3>pending appointments</h3>
                <p class="count">
                    <?php echo $data['new_appointments']->count; ?>
                </p>
            </div>

            <div class="item" id="oldPatients">
                <h3>Old patients</h3>
                <p class="count">20</p>
            </div>

            <div class="item" id="newPatients">
                <h3>New patients</h3>
                <p class="count">20</p>
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
            <div class="title">appointments</div>
                <?php if(isset($data['appointments'])): ?>
                <?php foreach($data['appointments'] as $appointment):?>
                    <div class="name"><?php echo $appointment->first_name.' '.$appointment->last_name;?></div>
                    <div class="time"><?php echo $appointment->slot_time?></div>
                <?php endforeach;?>
                <?php else: ?>
                <div class="name">No appointments</div>
                <?php endif; ?>
        </div>

        <div  class="consultations">
            <div class="title">consultations</div>

            <?php if(!empty($data['consultations'])): ?>
                <?php foreach($data['consultations'] as $consultation):?>
                    <div class="name"><?php echo $consultation->first_name.' '.$consultation->last_name;?></div>
                    <div class="time"><?php echo $consultation->slot_time?></div>
                <?php endforeach;?>
                <?php else: ?>
                <div class="name">No consultations for today.</div>
                <?php endif; ?>

            <!-- <div class="name">john</div>
            <div class="time">8.00 AM</div> -->

        </div>

        <div  class="upcoming">
            <div class="title">upcoming events</div>

            <div class="name">doctor's meet</div>
            <div class="time">8.00 AM</div>

            <div class="name">interview</div>
            <div class="time">8.30 AM</div>

            <div class="name">john</div>
            <div class="time">8.00 AM</div>

           
           
        </div>

      </div>
    </div>

    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/calender.js"></script>

</body>


</html>
