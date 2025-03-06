<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suwa-Connect</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/lab/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/lab/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/lab/support.css">

    <title>Suwa-Connect</title>
</head>

<body>

<?php include "labNavbar.php";?>

    <div class="main-content">
        <!-- Main Content Section -->
        <header>
            <h1>Advertisements</h1>
            <p>Promote your lab services, special offers, and deals to reach a wider audience. Manage your advertisements with ease.</p>
        </header>

        <section class="ads-overview">
            <h2>Your Advertisements</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Validity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Discount on Blood Tests</td>
                        <td>Get 20% off on all blood tests this month.</td>
                        <td>01 Nov 2024 - 30 Nov 2024</td>
                        <td>Active</td>
                        <td>
                            <button class="edit-ad">Edit</button>
                            <button class="delete-ad">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Health Check-Up Package</td>
                        <td>Comprehensive health check-up for just $99.</td>
                        <td>15 Nov 2024 - 15 Dec 2024</td>
                        <td>Inactive</td>
                        <td>
                            <button class="edit-ad">Edit</button>
                            <button class="delete-ad">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="create-ad">
            <h2>Create a New Advertisement</h2>
            <form>
                <!-- Add form fields for new advertisement creation -->
            </form>
        </section>

        <section class="edit-advertisement">
            <h2>Edit Advertisement</h2>
            <form>
                <!-- Add form fields for editing advertisements -->
            </form>
        </section>

        <!--<div class="delete-ad-modal">
            <h3>Delete Advertisement</h3>
            <p>Are you sure you want to delete this advertisement? This action cannot be undone.</p>
            <button class="confirm-delete">Yes, Delete</button>
            <button class="cancel-delete">Cancel</button>
        </div>-->

        <section class="ad-insights">
            <h2>Advertisement Insights</h2>
            <ul>
                <li><strong>Discount on Blood Tests:</strong> 500 views, 120 clicks</li>
                <li><strong>Health Check-Up Package:</strong> 300 views, 80 clicks</li>
            </ul>
        </section>

        <section class="ad-notifications">
            <h2>Notifications</h2>
            <p><strong>Reminder:</strong> Your advertisement "Discount on Blood Tests" will expire on 30 Nov 2024. Renew it now to avoid losing visibility.</p>
            <button class="renew-ad-button">Renew Advertisement</button>
        </section>

            <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
    </footer>
    </div>

    <!-- JavaScript -->
    <script src="<?php echo URLROOT;?>public/assets/js/doctor/navbar.js"></script>
   <script src="<?php echo URLROOT;?>public/assets/js/doctor/support.js"></script>
</body>

</html>
