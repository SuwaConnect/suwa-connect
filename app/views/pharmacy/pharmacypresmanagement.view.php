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
  <link rel="stylesheet" href="assets/css/pharmacypresmanagement.css">
  <link rel="stylesheet" href="assets/css/pharmacynavbar.css">

</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="assets/images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
                <h2>සුව CONNECT</h2>
                <button class="toggle-btn" id="toggleSidebar">
                    <i class="material-icons-round">chevron_left</i>
                </button>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="phamacyhome" class="nav-link">
                        <i class="material-icons-round">home</i> <span>Home</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a href="pharmacypresmanagement" class="nav-link">
                        <i class="material-icons-round">assignment</i> <span>Prescription Management</span>
                    </a>
                </li>
                </li>
                <li class="nav-item">
                    <a href="pharmacyprescriptionhistory" class="nav-link">
                        <i class="material-icons-round">dashboard</i> <span>Prescription History</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="pharmacypromotions" class="nav-link">
                        <i class="material-icons-round">local_offer</i> <span>Promotions</span>
                </a>
                <li class="nav-item">
                    <a href="pharmacyprofile" class="nav-link">
                        <i class="material-icons-round">group</i> <span>Profile</span>
                    </a>
                </li>
                <li class="nav-item" id="logout">
                    <a href="home" class="nav-link">
                        <i class="material-icons-round">logout</i> <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
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
  <script src="assets/js/pharmacynavbar.js"></script>
  <script src="assets/js/pharmacypresmanagement.js"></script>
</body>
</html>
