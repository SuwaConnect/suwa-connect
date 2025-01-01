<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <title>Prescription History</title>
    <link rel="stylesheet" href="assets/css/pharmacyprescriptionhistory.css">
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
                <li class="nav-item">
                    <a href="pharmacypresmanagement" class="nav-link">
                        <i class="material-icons-round">assignment</i> <span>Prescription Management</span>
                    </a>
                </li>
                </li>
                <li class="nav-item active">
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
          <h1>Prescription History</h1>
          <p>View the history of all prescriptions.</p>
        </div>
      </header>
      <table>
        <thead>
          <tr>
            <th>Date</th>
            <th>Prescription ID</th>
            <th>Patient ID</th>
            <th>Prescription</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="historyTableBody">
          <!-- Data will be loaded here -->
        </tbody>
      </table>
    </main>
  </div>
  <script>
    // JavaScript for toggling the sidebar
document.getElementById("toggleSidebar").addEventListener("click", function () {
    document.querySelector(".sidebar").classList.toggle("collapsed");
    
    // Rotate the chevron icon based on sidebar state
    const toggleIcon = document.querySelector('.toggle-btn i');
    toggleIcon.textContent = toggleIcon.textContent === 'chevron_left' ? 'chevron_right' : 'chevron_left';
});
    document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.getElementById('historyTableBody');
        const prescriptionData = JSON.parse(localStorage.getItem('prescriptionData'));

        if (prescriptionData) {
            prescriptionData.forEach(rowData => {
                const row = document.createElement('tr');
                rowData.forEach((cellData, index) => {
                    const cell = document.createElement('td');
                    if (index === 3) {
                        const link = document.createElement('a');
                        link.href = '#'; // Update this to the actual prescription link
                        link.innerText = 'View Prescription';
                        link.classList.add('view-link');
                        cell.appendChild(link);
                    } else if (index === 4 || index === 7) {
                        // Skip checkboxes
                    } else {
                        cell.innerText = cellData;
                    }
                    row.appendChild(cell);
                });
                const statusCell = document.createElement('td');
                if (rowData[4]) {
                    statusCell.innerText = 'Not Accepted';
                } else if (rowData[7]) {
                    statusCell.innerText = 'Delivered';
                } else {
                    statusCell.innerText = 'Pending';
                }
                row.appendChild(statusCell);
                tableBody.appendChild(row);
            });
        }
    });
  </script>
  <script src="assets/js/doctor/navbar.js"></script>
</body>
</html>