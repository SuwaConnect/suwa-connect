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
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/lab/revenue.css">

    <title>Suwa-Connect</title>
</head>

<body>
<div class="sidebar">
        <div class="logo">
            <img src="<?php echo URLROOT;?>public/assets/images/Suwa-Connect Logo.png" alt="Suwa-Connect Logo">
            <h2>සුව CONNECT</h2>

            <button class="toggle-btn" id="toggleSidebar"> 
                <i class="material-icons-round">chevron_left</i>
            </button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="labhome" class="nav-link">
                    <i class="material-icons-round">home</i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="labtestRequests" class="nav-link">
                    <i class="material-icons-round">group</i> <span>Test Requests</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="labappointments" class="nav-link">
                    <i class="material-icons-round">medical_services</i> <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item  active">
                <a href="labrevenue" class="nav-link">
                    <i class="material-icons-round">paid</i> <span>Billing</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="labreports" class="nav-link">
                    <i class="material-icons-round">trending_up</i> <span>Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="labnotifications" class="nav-link">
                    <i class="material-icons-round">notifications</i> <span>Notifications</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="labsettings" class="nav-link">
                    <i class="material-icons-round">settings</i> <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="labsupport" class="nav-link">
                    <i class="material-icons-round">contact_support</i> <span>Support</span>
                </a>
            </li>
            <li class="nav-item" id="logout">
                <a href="home" class="nav-link">
                    <i class="material-icons-round">logout</i> <span>Logout</span>
                </a>
            </li>
            <div class="profile-section">
            <a href="profile.php" class="profile-icon" id="logoutButton">
                <img src="<?php echo URLROOT;?>public/assets/images/navbar/user.png" alt="Profile Picture">
            </a>
            <div class="profile-text">
                <p>Welcome Back,<br> <span class="user-name">Sahan</span></p>
            </div>
            </div>
        </ul>
        
    </div>

    <div class="main-content">
    <section class="billing-section">
  <header>
    <h1>Billing</h1>
    <p>Manage payments, generate invoices, and track financial records efficiently.</p>
  </header>

  <section class="overview">
    <div class="card">
      <h3>Total Revenue Today</h3>
      <p>Rs. 150,000</p>
    </div>
    <div class="card">
      <h3>Pending Payments</h3>
      <p>Rs. 20,000</p>
    </div>
    <div class="card">
      <h3>Total Invoices</h3>
      <p>45</p>
    </div>
    <div class="card">
      <h3>Refunds/Discounts</h3>
      <p>Rs. 5,000</p>
    </div>
  </section>

  <section class="invoice-management">
    <h2>Invoice List</h2>
    <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>Invoice Number</th>
          <th>Patient Name</th>
          <th>Date</th>
          <th>Total Amount</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>INV001</td>
          <td>John Doe</td>
          <td>2024-11-29</td>
          <td>Rs. 5,000</td>
          <td>Paid</td>
          <td>
            <button class="view-btn">View</button>
            <button class="download-btn">Download</button>
          </td>
        </tr>
        <tr>
          <td>INV002</td>
          <td>Jane Smith</td>
          <td>2024-11-28</td>
          <td>Rs. 3,500</td>
          <td>Pending</td>
          <td>
            <button class="view-btn">View</button>
            <button class="reminder-btn">Send Reminder</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  </section>

  <section class="payment-section">
    <h2>Process Payment</h2>
    <form>
      <label for="invoice-number">Invoice Number:</label>
      <input type="text" id="invoice-number" placeholder="Enter Invoice Number" />

      <label for="payment-method">Payment Method:</label>
      <select id="payment-method">
        <option value="cash">Cash</option>
        <option value="card">Credit/Debit Card</option>
        <option value="online">Online Payment</option>
      </select>

      <label for="amount">Amount:</label>
      <input type="number" id="amount" placeholder="Enter Amount" />

      <button type="submit" class="confirm-payment-btn">Confirm Payment</button>
    </form>
  </section>

  <section class="generate-invoice">
    <h2>Create New Invoice</h2>
    <form>
      <label for="patient-name">Patient Name:</label>
      <input type="text" id="patient-name" placeholder="Enter Patient Name" />

      <label for="services">Services:</label>
      <textarea id="services" placeholder="E.g., Blood Test - Rs. 2,000"></textarea>

      <label for="discount">Discount (if any):</label>
      <input type="number" id="discount" placeholder="Enter Discount Amount" />

      <label for="total-amount">Total Amount:</label>
      <input type="number" id="total-amount" placeholder="Enter Total Amount" />

      <button type="submit" class="generate-invoice-btn">Generate Invoice</button>
    </form>
  </section>

  <section class="notifications">
    <h2>Notifications</h2>
    <ul>
      <li><strong>Overdue:</strong> Invoice INV002 for Jane Smith is overdue by 3 days.</li>
      <li><strong>Reminder Sent:</strong> Invoice INV003 for Peter Parker.</li>
    </ul>
  </section>

  <section class="reports">
    <h2>Generate Reports</h2>
    <form>
      <label for="report-type">Report Type:</label>
      <select id="report-type">
        <option value="daily-revenue">Daily Revenue</option>
        <option value="pending-payments">Pending Payments</option>
        <option value="service-revenue">Service-wise Revenue</option>
      </select>

      <label for="date-range">Date Range:</label>
      <input type="date" id="start-date"> to <input type="date" id="end-date">

      <button type="submit" class="generate-report-btn">Generate Report</button>
    </form>
  </section>

  <section class="refunds-discounts">
    <h2>Refunds & Discounts</h2>
    <form>
      <label for="invoice-number-refund">Invoice Number:</label>
      <input type="text" id="invoice-number-refund" placeholder="Enter Invoice Number" />

      <label for="refund-amount">Refund Amount:</label>
      <input type="number" id="refund-amount" placeholder="Enter Refund Amount" />

      <label for="reason">Reason:</label>
      <textarea id="reason" placeholder="Enter Reason for Refund"></textarea>

      <button type="submit" class="process-refund-btn">Process Refund</button>
    </form>
  </section>

  <section class="faqs">
    <h2>FAQs</h2>
    <p><strong>How do I mark an invoice as paid?</strong> Navigate to the invoice list, select the invoice, and click 'Mark as Paid'.</p>
    <p><strong>Can I edit an invoice after it's generated?</strong> Yes, you can edit invoices within 24 hours of creation.</p>
  </section>
</section>

    
<script src="<?php echo URLROOT;?>public/assets/js/doctor/navbar.js"></script>
<script src="<?php echo URLROOT;?>public/assets/js/doctor/revenue.js"></script>
</body>

</html>
