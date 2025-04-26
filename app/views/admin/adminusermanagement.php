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
                    <input type="text" placeholder="Search by name, email, or user type...">
                    <i class="material-icons-round">search</i>
                </div>
                <select class="filter-dropdown">
                <option value="all">All Users</option>
                    <option value="patient">Patient</option>
                    <option value="doctor">Doctor</option>
                    <option value="lab">Laboratory</option>
                    <option value="pharmacy">Pharmacy</option>
                    <option value="admin">Admin</option>
                </select>
            </div>    

            <div>
                <button id = "addNewUserBtn" class="add-user-btn">Add New User</button>
                
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
                
                    <button class="export-options">Export as Excel</button>
                    <button class="export-options">Export as CSV</button>
                    <button class="export-options">Export as PDF</button>
                
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
            <div class="card">
                <h3>Deactivated Users</h3>
            </div>

            <div class="card">
                <h3>User Summary</h3>
                <canvas id="userSummaryChart" width="200" height="200"></canvas>

                <!-- Legend container -->
                <div id="chartLegend"></div>

                
            </div>
        </section>

        <!-- User Table/List View -->
        <table class="user-table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email Address</th>
                    <th>User Type</th>
                    <th>Status</th>
                    <th>Sign-Up Date</th>
                    <th>Last Login</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            
            </tbody>
        </table>

   
        


        <!-- Bulk Actions Section -->
        <div class="bulk-actions">
            <button>Select All</button>
            <button>Deactivate Selected</button>
            <button>Ban Selected</button>
            <button>Send Notification</button>
        </div>

        <!-- Notifications Section -->
        <section class="notifications-section">
            <h3>Notifications</h3>
            <div class="notification-item">
                <p>Dr. Maya's account was reactivated on Sep 10, 2024.</p>
            </div>
            <div class="report-item">
                <p>5 reports submitted in the last 7 days.</p>
            </div>
        </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
        <a href="#"></a>
    </footer> 

    </div>

    <!-- View User Modal -->
<div id="viewUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>User Details</h2>
            <span class="close-btn-view"><i class="material-icons-round">cancel</i></span>
        </div>
        <div class="modal-body">
            <div class="user-details">
                <p><strong>Name:</strong> </p>
                <p><strong>Email:</strong> </p>
                <p><strong>User Type:</strong> </p>
                <p><strong>Status:</strong> </p>
                <p><strong>Sign-up Date:</strong> </p>
                <p><strong>Last Login:</strong> </p>
            </div>
           
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit User</h2>
            <span class="close-btn-edit"><i class="material-icons-round">cancel</i></span>
        </div>
        <div class="modal-body">
           
            <form action="userManagement.php" method="POST" class="edit-form">
                <input type="hidden" name="user_id" value="">
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="" required>
                </div>

                <div class="form-group">
                    <label for="user_type">User Type</label>
                    <select id="user_type" name="user_type" required>
                        <option value="patient" >Patient</option>
                        <option value="doctor" <?php echo ($_SESSION['edit_user']['user_type'] == 'doctor') ? 'selected' : ''; ?>>Doctor</option>
                        <option value="lab" <?php echo ($_SESSION['edit_user']['user_type'] == 'lab') ? 'selected' : ''; ?>>Laboratory</option>
                        <option value="pharmacy" <?php echo ($_SESSION['edit_user']['user_type'] == 'pharmacy') ? 'selected' : ''; ?>>Pharmacy</option>
                        <option value="admin" <?php echo ($_SESSION['edit_user']['user_type'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="active" <?php echo ($_SESSION['edit_user']['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                        <option value="inactive" <?php echo ($_SESSION['edit_user']['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>

                <button type="submit" name="update" class="update-btn">Update User</button>
            </form>
            
        </div>
    </div>
</div>

    

    <script src="<?php echo URLROOT?>public\js\doctor\js\navbar.js"></script>
    <script src="./js/userManagement.js"></script>

    </body>
</html> 
  