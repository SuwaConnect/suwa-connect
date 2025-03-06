<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
   
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/lab/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/lab/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/lab/settings.css">

    <title>Suwa-Connect</title>
</head>

<body>

<?php include "labNavbar.php";?>

    <div class="main-content">

    <header>
  <h1>Settings</h1>
  <p>Manage your account, preferences, and system configurations to streamline your workflow.</p>
</header>

<section class="account-settings">
  <h2>Account Settings</h2>
  <form>
    <label for="name">Name:</label>
    <input type="text" id="name" value="John Doe">
    <label for="email">Email Address:</label>
    <input type="email" id="email" value="johndoe@example.com">
    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" value="+94 771234567">
    <label for="role">Job Title/Role:</label>
    <input type="text" id="role" value="Senior Laboratory Technician">
    <label for="password">Change Password:</label>
    <input type="password" id="password">
    <button type="submit">Save Changes</button>
  </form>
</section>

<section class="notification-preferences">
  <h2>Notification Preferences</h2>
  <form>
    <label> Enable Email Notifications <input type="checkbox" checked></label>
    <label> Enable SMS Alert <input type="checkbox"></label>
    <label> Enable App Notifications <input type="checkbox" checked></label>
    <h3>Select Notification Categories:</h3>
    <label> Test Requests <input type="checkbox" checked></label>
    <label> Billing Updates <input type="checkbox"></label>
    <label> Report Availability <input type="checkbox" checked></label>
    <label> System Alerts<input type="checkbox"></label>
    <button type="submit">Save Preferences</button>
  </form>
</section>

<section class="system-preferences">
  <h2>System Preferences</h2>
  <form>
    <label for="language">Default Language:</label>
    <select id="language">
      <option value="en" selected>English</option>
      <option value="si">Sinhala</option>
      <option value="ta">Tamil</option>
    </select>
    <label for="timezone">Time Zone:</label>
    <select id="timezone">
      <option value="utc+5:30" selected>GMT +5:30 (Sri Lanka)</option>
      <option value="utc+0">GMT (UTC)</option>
    </select>
    <label for="theme">Theme:</label>
    <select id="theme">
      <option value="light" selected>Light Mode</option>
      <option value="dark">Dark Mode</option>
    </select>
    <label for="default-view">Default Dashboard View:</label>
    <select id="default-view">
      <option value="test-requests" selected>Test Requests</option>
      <option value="reports">Reports</option>
      <option value="billing">Billing</option>
    </select>
    <button type="submit">Save Preferences</button>
  </form>
</section>

<section class="privacy-security">
  <h2>Privacy & Security</h2>
  <form>
    <label> Enable Two-Factor Authentication <input type="checkbox" checked></label>
    <h3>Manage Connected Devices:</h3>
    <ul class="listsettings" type="none">
      <li>
        <p>Device: Windows PC - Last Active: Today, 10:00 AM</p>
        <button class="logout-button">Log Out</button>
      </li>
      <li>
        <p>Device: Android Phone - Last Active: Yesterday, 8:30 PM</p>
        <button class="logout-button">Log Out</button>
      </li>
    </ul>
    <h3>Data Sharing Permissions:</h3>
    <label> Share anonymous usage data to improve system performance <input type="checkbox"> </label>
    <button type="submit">Save Settings</button>
  </form>
</section>

<section class="support-help">
  <h2>Support & Help</h2>
  <ul>
    <li><a href="/help-center">Help Center</a></li>
    <li><a href="/contact-support">Contact Support</a></li>
    <li><a href="/user-manual">User Manual</a></li>
    <li><a href="/faq">FAQs</a></li>
  </ul>
</section>

<section class="logout">
  <button class="logout-button">Log Out</button>
</section>
         <!-- Footer Section -->
         <footer>
            <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
            <a href="#"></a>
        </footer>

    </div>
    
    <script src="<?php echo URLROOT;?>public/assets/js/doctor/navbar.js"></script>
    <script src="<?php echo URLROOT;?>public/assets/js/doctor/settings.js"></script>
</body>

</html>
