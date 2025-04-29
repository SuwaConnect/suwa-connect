  
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
   
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/lab/userManagement.css">


    <title>Suwa-Connect</title>
</head>

<body>

<?php include "new-labNavBar.php";?>

    <div class="main-content">
    
  <div class="container">
    <header >
      <h1>Lab Requests</h1>
      <p>Manage and process all laboratory test requests efficiently.</p> <br>
    </header>

    <section class="overview">
      <div class="card">
        <h3>Total Requests</h3>
        <p><?= $data['totalAppointmentRequests'] ?? '0' ?></p>
      </div>
      <div class="card">
        <h3>Accepted Appointments</h3>
        <p><?= $data['getUpcomingAppointmentsCount'] ?? '0' ?></p>
      </div>
      <div class="card">
        <h3>Canceled Appointments</h3>
        <p><?= $data['getCancelledAppointmentsCount'] ?? '0' ?></p>
      </div>
    </section>

    <section class="requests-table">
      <h2>Appointment Requests</h2>
      <div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Type of test</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($data['lab_appointment_requests']) && is_array($data['lab_appointment_requests'])): ?>
              <?php foreach($data['lab_appointment_requests'] as $request): ?>
    <tr>
        <td><?= $request->patient_name ?></td>
        <td><?= date('Y-m-d', strtotime($request->RDate)) ?></td>
        <td><?= date('h:i A', strtotime($request->RDate)) ?></td>
        <td><?= $request->test_type ?></td>
        <td>
            <!-- Form to submit request_id using POST -->
            <form method="POST" action="">
                            <input type="hidden" name="request_id" value="<?= $request->request_id ?>">
                            <button type="submit" name="accept_request" class="view-btn">Accept</button>
                            <button type="submit" name="cancel_appointment" class="cancel-btn" style="background-color: red; color: white;">Cancel</button>
</form>
                        </form>
        </td>
    </tr>
<?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</section>

    <footer>
            <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
            <a href="#"></a>
        </footer> 
  </div>
</div>

  <!-- <script src="public/assets/js/doctor/navbar.js"></script> -->
  <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

</body>
</html>