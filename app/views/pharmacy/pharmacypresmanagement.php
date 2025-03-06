<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

  <title>Prescription Management</title>
  <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/pharmacypresmanagement.css">
  <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/pharmacynavbar.css">

</head>
<body>
    <div class="container">

    <?php include 'pharmacyNavbar.php';?>
    
    <main class="content">
      <header>
        <div style="text-align: center;">
          <h1>Prescription Management</h1>
          <p>Search and manage prescriptions effectively.</p>
        </div>
        <input type="text" class="search-bar" placeholder="Search prescriptions...">
      </header>
      <table>
        <thead>
          <tr>
            <th>Date</th>
            <th>Prescription ID</th>
            <th>Patient ID</th>
            <th>Prescription</th>
            <th>Reject</th>
            <th>Accept</th>
            <th>Processing</th>
            <th>Delivered</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2024-11-23</td>
            <td>1</td>
            <td>101</td>
            <td><a href="#" class="view-link">View Prescription</a></td>
            <td style="text-align: center;"><input type="checkbox"> </td>
            <td style="text-align: center;"><input type="checkbox"> </td>
            <td style="text-align: center;"><input type="checkbox"> </td>
            <td style="text-align: center;"><input type="checkbox"> </td>

            
          </tr>
        </tbody>
      </table>
      <div style="text-align: center; margin-top: 20px;">
        <button id="endSessionBtn" class="end-session-btn">End Current Session</button>
      </div>
    </main>
  </div>
  <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
  <script src="<?php echo URLROOT?>public/assets/js/pharmacypresmanagement.js"></script>
</body>
</html>
