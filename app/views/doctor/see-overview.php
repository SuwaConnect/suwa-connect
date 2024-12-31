<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blood Pressure Overview</title>
<link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/see-overview.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

</head>
<body>
<?php include 'navbarbhagya.php'; ?>
    <div class="main-content">

   
      <div class="header">
        <h1>Checkup history</h1>
        <h4>Track the latest blood pressure readings for quick insights into patient health trends...</h4>
      </div>

      <div class="bloodPressure">
        <h2>Blood Pressure Levels Overview</h2>
        <canvas id="bpChart"></canvas>
      </div>

      <div class="bloodSugar">
        <h2>Blood Sugar Levels Overview</h2>
        <canvas id="bsChart"></canvas>
      </div>

      <div class="cholesterolLevel">
        <h2>Cholesterol Levels Overview</h2>
        <canvas id="cholesterolChart"></canvas>
      </div>
       
    </div>



    <script src="<?php echo URLROOT;?>public/js/doctor/js/see-overview.js"></script>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
</body>
</html>
