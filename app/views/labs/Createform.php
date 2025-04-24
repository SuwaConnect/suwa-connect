<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />

  <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/lab/navbar.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/lab/dashboard.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>public/assets/css/lab/createform.css" />

  <title>Suwa-Connect | Create Report</title>
</head>

<body>
<!-- createReport.php -->
<div class="create-report-container">
  <h2>Create Lab Test Report</h2>

  <form id="reportForm" action="<?php echo URLROOT; ?>/reportcontroller/createReport" method="POST">
  <fieldset>
    <legend>Test Details</legend>

    <label>Test Name:</label>
    <input type="text" name="test_name" required>

    <label>Sample Type:</label>
    <input type="text" name="sample_type" required>

    <label>Test Method:</label>
    <input type="text" name="method">

    <label>Status:</label>
    <select name="status" required>
      <option value="">-- Select --</option>
      <option value="Completed">Completed</option>
      <option value="Pending">Pending</option>
    </select>

    <label>Additional Comments:</label>
    <textarea name="comments" rows="3"></textarea>
  </fieldset>

  <fieldset id="test-results-section">
    <legend>Test Results</legend>

    <div class="test-result-row">
      <label>Parameter:</label>
      <input type="text" name="parameter[]" required>

      <label>Result:</label>
      <input type="text" name="result[]" required>

      <label>Unit:</label>
      <input type="text" name="unit[]" required>

      <label>Reference Range:</label>
      <input type="text" name="range[]" required>

      <label>Flag:</label>
      <input type="text" name="flag[]">
    </div>
  </fieldset>

  <button type="button" onclick="generateReport()">Generate Report</button>
</form>

<script>
  function generateReport() {
    // Optional: validate if needed
    const form = document.getElementById('reportForm');

    // Basic example: check if required inputs are filled (HTML already does this too)
    const requiredFields = form.querySelectorAll('[required]');
    let valid = true;
    requiredFields.forEach(field => {
      if (!field.value.trim()) {
        field.style.border = '1px solid red';
        valid = false;
      } else {
        field.style.border = '';
      }
    });

    if (valid) {
      form.submit(); // ✅ Submits the form to your controller
    } else {
      alert('Please fill all required fields.');
    }
  }
</script>


</body>

</html>
