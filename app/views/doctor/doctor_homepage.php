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
    <div class="title">today's sessions</div>
    <?php if(isset($data['todays sessions'])): ?>
        <?php $count = 1; // initialize counter ?>
        <?php foreach($data['todays sessions'] as $appointment): ?>
            <div class="name">
                <?php echo 'Session '.$count.': ' ?>
            </div>
            <div class="time"><?php 
            $start = date('G.i', strtotime($appointment->start_time));
            $end = date('G.i', strtotime($appointment->end_time));
            echo $start.'  -  '. $end?></div>
            <?php $count++; // increment counter ?>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="name">No appointments</div>
    <?php endif; ?>
</div>


        <div  class="consultations">
            <div class="title">consultations</div>

           
                
                    <div class="name"></div>
                    <div class="time"></div>
                
                <!-- <div class="name">No consultations for today.</div> -->
               

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
