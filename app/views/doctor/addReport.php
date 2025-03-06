<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>patient profile</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/addReport.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
   
</head>



<body >
    <?php include 'navbarbhagya.php'; ?>

    <div class="main-content">
    
    <div class="header">
        <h2 >Add Medical Reports</h2>
        
    </div>

    <div class="form-container-main">
    <form action="<?php echo URLROOT; ?>visitRecordController/submitReports/<?php echo $data['patientId']?>/<?php echo $data['health_record_id']; ?>" method="POST" enctype="multipart/form-data">
        
        <div id="reportContainer">
            <!-- Initial Report Entry -->
            <div class="report-entry">
                <div class="form-group">
                    <label class="form-label">Report Title</label>
                    <input type="text" name="report_title[]" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Report Type</label>
                    <select name="report_type[]" class="form-input" required>
                        <option value="x-ray">X-ray</option>
                        <option value="mri">MRI</option>
                        <option value="blood-test">Blood Test</option>
                        <option value="ecg">ECG</option>
                        <option value="ultrasound">Ultrasound</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Report Date</label>
                    <input type="date" name="report_date[]" class="form-input" value="<?php echo date('Y-m-d'); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Findings/Observations</label>
                    <textarea name="findings[]" class="form-input textarea" required></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Attach Report File</label>
                    <input type="file" name="report_file[]" class="form-input" required>
                    <small class="text-muted">Accepted formats: PDF, JPG, PNG (Max: 5MB)</small>
                </div>

                <button type="button" class="remove-btn removeReport">Remove report</button>
            </div>
        </div>

        <!-- Global Buttons -->
        <div class="buttons">
            <button type="button" id="addReport" class="action-btn add-btn">Add Another Report</button>
            <button type="submit" class="action-btn submit-btn">Submit Reports</button>
        </div>
    </form>
    </div>
    </div>








    <script>
        

        document.getElementById('addReport').addEventListener('click', function () {
    const reportContainer = document.getElementById('reportContainer');
    const firstReport = reportContainer.querySelector('.report-entry');
    const newReport = firstReport.cloneNode(true);

    // Clear input values in the cloned report
    newReport.querySelectorAll('input, select, textarea').forEach(input => {
        if (input.type !== 'file') input.value = '';
    });

    // Add event listener to the new "Remove" button
    newReport.querySelector('.removeReport').addEventListener('click', function () {
        if (reportContainer.querySelectorAll('.report-entry').length > 1) {
            newReport.remove();
        } else {
            alert('You cannot remove the last report.');
        }
    });

    // Append the new report to the container
    reportContainer.appendChild(newReport);
});

// Add event listeners to existing "Remove" buttons
document.querySelectorAll('.removeReport').forEach(button => {
    button.addEventListener('click', function () {
        const reportContainer = document.getElementById('reportContainer');
        if (reportContainer.querySelectorAll('.report-entry').length > 1) {
            this.closest('.report-entry').remove();
        } else {
            alert('You cannot remove the last report.');
        }
    });
});
    </script>


        <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

</body>
</html>
