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

<?php include "new-labnavBar.php";?>

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
                <td><?= $invoice->invoice_id ?></td>
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
    <!-- <button class="view-btn">Notify</button> -->
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
    <form method="POST" action="<?php echo URLROOT?>labController/processPayment"> <!-- Ensure it's using POST -->
      <label for="invoice-id">Invoice Number:</label>
      <input type="text" id="invoice-id" name="invoice_id" placeholder="Enter Invoice ID" required />

      <label for="payment-method">Payment Method:</label>
      <select id="payment-method" name="payment_method" required>
        <option value="cash">Cash</option>
        <option value="card">Credit/Debit Card</option>
        <option value="online">Online Payment</option>
      </select>

      <label for="amount">Amount:</label>
      <input type="number" id="amount" name="payment_amount" placeholder="Enter Amount" required />

      <button type="submit" class="confirm-payment-btn">Confirm Payment</button>
    </form>
</section>

<section class="generate-invoice">
    <h2>Create Invoice</h2>
    <form method="POST" action="<?php echo URLROOT ?>/labController/createInvoice">
        <label for="appointment-id">Appointment ID:</label>
        <input type="number" id="appointment-id" name="appointment_id" placeholder="Enter Appointment ID" required />

        <label for="patient-id">Patient ID:</label>
        <input type="number" id="patient-id" name="patient_id" placeholder="Enter Patient ID" required />

        <label for="lab-id">Lab ID:</label>
        <input type="number" id="lab-id" name="lab_id" placeholder="Enter Lab ID" required />

        <label for="total-amount">Total Amount:</label>
        <input type="number" id="total-amount" name="total_amount" placeholder="Enter Total Amount" required />

        <label for="discount">Discount:</label>
        <input type="number" id="discount" name="discount" placeholder="Enter Discount" value="0" />

        <label for="services">Services:</label>
        <textarea id="services" name="services" placeholder="Enter services provided" required></textarea>

        <button type="submit">Create Invoice</button>
    </form>
</section>

    
<script src="<?php echo URLROOT;?>public/assets/js/doctor/navbar.js"></script>
<script src="<?php echo URLROOT;?>public/assets/js/doctor/revenue.js"></script>
</body>

</html>
