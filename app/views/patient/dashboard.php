<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/dashboardtwo.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/navbartwo.css">
    <title>Suwa-Connect</title>
</head>
<body>

<?php include  "navbar-patient.php";?>

    <div class="container">
        <h1>Patient Record</h1>

        <!-- Patient Information -->
        <div class="patient-info">
            <h2>Basic Details</h2>
            <p><strong>Full Name:</strong> John Doe</p>
            <p><strong>Age:</strong> 45</p>
            <p><strong>Gender:</strong> Male</p>
            <p><strong>Contact:</strong> +1 234 567 890</p>
            <p><strong>Address:</strong> 123 Wellness Lane, Health City</p>
        </div>

        <!-- Health Measurements -->
        <div class="health-details">
            <h2>Current Health Metrics</h2>
            <ul>
                <li><strong>Blood Pressure:</strong> 120/80 mmHg</li>
                <li><strong>Heart Rate (BPM):</strong> 72</li>
                <li><strong>Blood Sugar Level:</strong> 5.6 mmol/L</li>
                <li><strong>Cholesterol Level:</strong> 190 mg/dL</li>
                <li><strong>Weight:</strong> 75 kg</li>
                <li><strong>Height:</strong> 180 cm</li>
                <li><strong>BMI:</strong> 23.1 (Normal)</li>
            </ul>
        </div>

        <!-- Checkup History -->
        <div class="records-section">
            <h2>Checkup History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Doctor</th>
                        <th>Blood Pressure</th>
                        <th>Heart Rate</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2024-11-30</td>
                        <td>Dr. Smith</td>
                        <td>120/80</td>
                        <td>72 BPM</td>
                        <td>Healthy</td>
                    </tr>
                    <tr>
                        <td>2024-10-25</td>
                        <td>Dr. Clark</td>
                        <td>130/85</td>
                        <td>78 BPM</td>
                        <td>Advised diet change</td>
                    </tr>
                    <tr>
                        <td>2024-09-10</td>
                        <td>Dr. Lopez</td>
                        <td>135/88</td>
                        <td>80 BPM</td>
                        <td>Prescribed medication</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="<?php echo URLROOT?>public/assets/js/navbartwo.js"></script>
</body>
</html>
