<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/admin/userManagement.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/admin/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/admin/dashboard.css">


    <title>Suwa-Connect</title>
    <style>
        /* User Status Styles */
.status {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.85rem;
    font-weight: 500;
}

.active-status {
    background-color: #e6f7ee;
    color: #00a650;
}

.inactive-status {
    background-color: #fff1f0;
    color: #f5222d;
}

/* Action Button Styles */
.action-btn {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.8rem;
    margin-right: 5px;
}

.view-btn {
    background-color: #e6f7ff;
    color: #1890ff;
}

.edit-btn {
    background-color: #fff7e6;
    color: #fa8c16;
}

.activate-btn {
    background-color: #e6f7ee;
    color: #00a650;
}

.deactivate-btn {
    background-color: #fff1f0;
    color: #f5222d;
}

/* Card value style */
.card-value {
    display: block;
    font-size: 1.8rem;
    margin-top: 10px;
    font-weight: 700;
}
    </style>
</head>

<body>
  
<?php include 'adminNavbar.php'?>
    <div class="main-content">
        <!-- Header Section -->
        <div>
            <header class="header-section">
                <h1>User Management</h1>
                <p>Manage all registered users across the platform including patients, doctors, laboratories, and pharmacies.</p>
            </header>
        </div>
        
        <br>
        
          <!-- Search and Filters -->
          <div class="search-container">
                <div class="search-box">
                    <input type="text" placeholder="Search by name, email, or user type..." id="searchInput">
                    <button onclick="searchUsers(document.getElementById('searchInput').value)">Search</button>
                </div>
                
            </div>    

            <div>
               
                
                <!-- Modal Form for Adding New User -->                
                <div id="addUserModal" class="modal">
                    <div class="modal-content">
                        
                        <div class="form-container">
                            <span class="close-btn"> <i class="material-icons-round">cancel</i></span>
                            <h2>Add User</h2>
                           
                            <form action="userManagement.php" method="POST">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" placeholder="Name" required>

                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" placeholder="Email"required><br>

                                <label for="user_type">User Type</label>
                                    <select id="user_type" name="user_type" placeholder="Select User Type" required>
                                        <option value="Patient">Patient</option>
                                        <option value="Doctor">Doctor</option>
                                        <option value="Laboratory">Laboratory</option>
                                        <option value="Pharmacy">Pharmacy</option>
                                        <option value="Admin">Admin</option>
                                    </select><br>

                                <button type="submit" class="add-user-btn" name="create">Add User</button>

                                <div id="notification" style="display:none; background-color: white; color: #333; padding: 10px; text-align: center;">
                                    User has been successfully added!
                                </div>

                            </form>
                        </div>                        
                        </div>
                
                </div>
                
                   
                
            </div>
            
 
         


        <!-- User Summary Cards -->
        <section class="summary-cards">
            <div class="card">
                <h3>Total Users</h3>
                
            </div>
            <div class="card">
                <h3>Active Users</h3>
                
            </div>
            <div class="card">
                <h3>New Users (Last 7 Days) </h3>
            </div>
            <div class="card">
                <h3>Banned Users</h3>
            </div>
            <!-- <div class="card">
                <h3>Deactivated Users</h3>
            </div> -->

            <div class="card">
                <h3>User Summary</h3>
                <canvas id="userSummaryChart" width="200" height="200"></canvas>

                <!-- Legend container -->
                <div id="chartLegend"></div>

                
            </div>
        </section>

        <!-- User Table/List View -->
        <table class="user-table" id="userTable">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email Address</th>
                    <th>User Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead class="tBody">
            <tbody id ="userTableBody">
                <!-- User data will be populated here dynamically using JavaScript -->
                <tr>
                    <td colspan="5" class="no-data">No users found.</td>
                </tr>

            
            </tbody>
        </table>

   
        


        
    <footer>
        <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
        <a href="#"></a>
    </footer> 

    </div>

    <script src="<?php echo URLROOT?>public/assets/js/navbar.js"></script>
   
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    loadAllUsers();
});

// Function to load all users
function loadAllUsers() {
    fetch('<?php echo URLROOT?>/adminController/getAllUsers')
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Server returned an error:', text);
                    throw new Error('Server response was not OK');
                });
            }
            return response.json();
        })
        .then(data => {
            populateUserTable(data);
            updateSummaryCards(data);
        })
        .catch(error => console.error('Error loading users:', error));
}

// Function to populate the user table
function populateUserTable(users) {
    const tableBody = document.getElementById('userTableBody');
    tableBody.innerHTML = '';
    
    users.forEach(user => {
        const row = document.createElement('tr');
        
        // Status button class based on user status
        const statusClass = user.status === 'active' ? 'active-status' : 'inactive-status';
        const actionBtnText = user.status === 'active' ? 'Deactivate' : 'Activate';
        const actionBtnClass = user.status === 'active' ? 'deactivate-btn' : 'activate-btn';
        
        row.innerHTML = `
            <td>${user.user_name}</td>
            <td>${user.email}</td>
            <td>${user.role}</td>
            <td><span class="status ${statusClass}">${user.status}</span></td>
            <td>
                
                <button class="action-btn ${actionBtnClass}" data-id="${user.user_id}" data-status="${user.status}">
                    ${actionBtnText}
                </button>
            </td>
        `;
        
        tableBody.appendChild(row);
    });
    
    // Add event listeners to buttons
    addButtonEventListeners();
}

// Function to add event listeners to action buttons
function addButtonEventListeners() {
    // Add event listeners for activation/deactivation buttons
    document.querySelectorAll('.activate-btn, .deactivate-btn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const currentStatus = this.getAttribute('data-status');
            const newStatus = currentStatus === 'active' ? 'banned' : 'active';
            
            toggleUserStatus(userId, newStatus);
        });
    });
    
    // You can add more event listeners for view and edit buttons as needed
}

// Function to toggle user status (activate/deactivate)
function toggleUserStatus(userId, newStatus) {
    fetch(`<?php echo URLROOT?>adminController/updateUserStatus`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            userId: userId,
            status: newStatus
        })
    })
    .then(response => response.text()) // Get raw text instead of JSON
    .then(text => {
        console.log('Raw server response:', text);
        
        // Try to parse as JSON
        try {
            const data = JSON.parse(text);
            if (data.success) {
                loadAllUsers();
            } else {
                alert('Failed: ' + data.message);
            }
        } catch (e) {
            console.error('Not valid JSON:', e);
            alert('Server returned invalid response');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Function to search users
function searchUsers(query) {
    if (query.trim() === '') {
        loadAllUsers();
        return;
    }
    
    fetch(`<?php echo URLROOT?>adminController/searchUsers?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            populateUserTable(data);
        })
        .catch(error => console.error('Error searching users:', error));
}

// Function to update summary cards
function updateSummaryCards(users) {
    // Count totals
    const totalUsers = users.length;
    const activeUsers = users.filter(user => user.status === 'Active').length;
    const bannedUsers = users.filter(user => user.status === 'Banned').length;
    const deactivatedUsers = users.filter(user => user.status === 'Inactive').length;
    
    // Calculate new users in last 7 days
    const oneWeekAgo = new Date();
    oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
    
    const newUsers = users.filter(user => {
        const createdDate = new Date(user.created_at);
        return createdDate >= oneWeekAgo;
    }).length;
    
    // Update the card values
    document.querySelector('.summary-cards .card:nth-child(1) h3').innerHTML = 
        `Total Users <span class="card-value">${totalUsers}</span>`;
    
    document.querySelector('.summary-cards .card:nth-child(2) h3').innerHTML = 
        `Active Users <span class="card-value">${activeUsers}</span>`;
    
    document.querySelector('.summary-cards .card:nth-child(3) h3').innerHTML = 
        `New Users (Last 7 Days) <span class="card-value">${newUsers}</span>`;
    
    document.querySelector('.summary-cards .card:nth-child(4) h3').innerHTML = 
        `Banned Users <span class="card-value">${bannedUsers}</span>`;
    
    document.querySelector('.summary-cards .card:nth-child(5) h3').innerHTML = 
        `Deactivated Users <span class="card-value">${deactivatedUsers}</span>`;
}
    </script>

    </body>
</html> 
  