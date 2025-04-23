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

<?php include "labNavbar.php";?>

    <div class="main-content">
    <section class="billing-section">
  <header>
    <h1>Billing</h1>
    <p>Manage payments, generate invoices, and track financial records efficiently.</p>
  </header>

  <section class="overview">
    <div class="card">
      <h3>Total Revenue Today</h3>
      <p><?= $data['totalRevenueToday'] ?? '0' ?></p> 
    </div>
    <div class="card">
      <h3>Pending Payments</h3>
      <p><?= $data['pendingPayments'] ?? '0' ?></p>
    </div>
    <div class="card">
      <h3>Total Invoices</h3>
      <p><?= $data['totalInvoices'] ?? '0' ?></p>
    </div>
    <div class="card">
      <h3>Refunds/Discounts</h3>
      <p><?= $data['refundsDiscounts'] ?? '0' ?></p>
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
    <?php if(isset($data['getLabInvoices']) && is_array($data['getLabInvoices'])): ?>
        <?php foreach($data['getLabInvoices'] as $invoice): ?>
            <tr>
                <td><?= $invoice->invoice_number ?></td>
                <td><?= $invoice->patient_name ?></td>
                <td><?= date('Y-m-d', strtotime($invoice->invoice_date)) ?></td>
                <td>Rs. <?= number_format($invoice->total_amount, 2) ?></td>
                <td><?= $invoice->status ?></td>
                <td>
                <?php if ($invoice->status == 'Paid') { ?>
                  <button type="button" class="download-btn" onclick="window.open('<?php echo URLROOT ?>labController/viewinvoice?id=<?php echo $invoice->invoice_id; ?>', '_blank')">
    Download
</button>
<?php } else { ?>
    <button class="view-btn">Notify</button>
<?php } ?>

</td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No invoices found.</td>
        </tr>
    <?php endif; ?>
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
