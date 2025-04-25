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
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/lab/labinvoice.css">

    <title>Suwa-Connect</title>
</head>

<body>
<?php if (isset($data['invoice'])): 
    $invoice = $data['invoice'];
?>
<div class="bill-container">
    <h2 class="bill-header">Suwa Connect</h2>
    <p class="bill-sub">Invoice</p>
    <hr>

    <table class="bill-table">
        <tr>
            <td><strong>Invoice #</strong></td>
            <td><?= $invoice->invoice_id ?></td>
        </tr>
        <tr>
            <td><strong>Patient</strong></td>
            <td><?= $invoice->patient_name ?></td>
        </tr>
        <tr>
            <td><strong>Date</strong></td>
            <td><?= date('Y-m-d', strtotime($invoice->invoice_date)) ?></td>
        </tr>
        <tr>
            <td><strong>Amount</strong></td>
            <td>Rs. <?= number_format($invoice->total_amount, 2) ?></td>
        </tr>
        <tr>
            <td><strong>Status</strong></td>
            <td><span class="status <?= $invoice->status == 'Paid' ? 'paid' : 'unpaid'; ?>">
                <?= $invoice->status ?>
            </span></td>
        </tr>
    </table>

    <hr>
    <p class="thanks">Thank you for choosing Suwa Connect!</p>

    <div class="print-btn-container">
        <button onclick="window.print()" class="print-btn">Print</button>
    </div>
</div>
<?php else: ?>
    <p>No invoice found.</p>
<?php endif; ?>
</body>
</html>