<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="public/assets/css/dashboardtwo.css">
    <link rel="stylesheet" href="public/assets/css/navbartwo.css">
    <title>Suwa-Connect</title>
    <style>
        :root {
            --primary: #2c5282;
            --primary-light: #4299e1;
            --secondary: #38b2ac;
            --light-gray: #f7fafc;
            --medium-gray: #e2e8f0;
            --dark-gray: #4a5568;
            --danger: #e53e3e;
            --success: #48bb78;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-gray);
            color: #333;
            line-height: 1.6;
        }

        .main-content {
    background-color: #e6f2ff;
    color:#2e2e2e;
    padding: 20px;
    margin-left: 250px; /* To make space for the sidebar */
    padding: 20px;
    width: calc(100% - 250px); /* Take the remaining width */
    overflow-y: auto; /* Enable scrolling if content overflows vertically */
    flex-grow: 1;
    transition: margin-left 0.3s ease, width 0.3s ease; /* Smooth transition for content resize */
    
}

.sideBar.collapsed + .main-content{

    margin-left:80px;
    width: calc(100% - 80px);
    overflow-y: auto;
}
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 15px 0;
            margin-bottom: 30px;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .patient-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .patient-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--medium-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--primary);
        }
        
        .patient-details h1 {
            font-size: 24px;
            color: var(--primary);
            margin-bottom: 5px;
        }
        
        .patient-details p {
            color: var(--dark-gray);
            font-size: 14px;
        }
        
        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .section-title h2 {
            color: var(--primary);
            font-size: 22px;
        }
        
        .btn {
            background-color: var(--primary);
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn:hover {
            background-color: var(--primary-light);
        }
        
        .btn-secondary {
            background-color: white;
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        
        .btn-secondary:hover {
            background-color: var(--light-gray);
        }
        
        /* Health Records Table */
        .records-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .records-table th {
            background-color: var(--primary);
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 500;
        }
        
        .records-table td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--medium-gray);
        }
        
        .records-table tr:last-child td {
            border-bottom: none;
        }
        
        .records-table tr:hover {
            background-color: var(--light-gray);
        }
        
        .view-btn {
            background-color: var(--primary);
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            transition: background-color 0.3s ease;
            display: inline-block;
        }
        
        .view-btn:hover {
            background-color: var(--primary-light);
        }
        
        .record-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            color: white;
            background-color: var(--primary-light);
        }
        
        .badge-urgent {
            background-color: var(--danger);
        }
        
        .badge-regular {
            background-color: var(--primary-light);
        }
        
        .badge-checkup {
            background-color: var(--success);
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 20px;
        }
        
        .pagination a {
            display: inline-block;
            padding: 8px 12px;
            background-color: white;
            border: 1px solid var(--medium-gray);
            border-radius: 4px;
            color: var(--dark-gray);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .pagination a:hover,
        .pagination a.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .patient-info {
                flex-direction: column;
            }
            
            .records-table {
                display: block;
                overflow-x: auto;
            }
            
            .section-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>


<?php include  "navbar-patient.php";?>
  
<div class="main-content">
    <!-- <header>
        <div class="container">
            <div class="header-content">
                <div class="patient-info">
                    <div class="patient-avatar">JD</div>
                    <div class="patient-details">
                        <h1></h1>
                        <p>Patient ID: P12345 | DOB: 01/15/1985 | Gender: Male</p>
                    </div>
                </div>
                <div>
                    <button class="btn">Download All Records</button>
                </div>
            </div>
        </div>
    </header> -->
    
    <div class="container">
        <div class="section-title">
            <h2>My Health Records</h2>
            <div>
                <!-- <button class="btn btn-secondary">Filter Records</button>
                <button class="btn">Request Medical Report</button> -->
                <form action="<?php echo URLROOT . 'patientController/searchHealthRecord'?>" method="post">
                <input type="search" placeholder="Search records..." class="search-input" name="search" >
                <button class="btn btn-secondary">Search</button>
                </form>
            </div>
        </div>
        
        <?php if (!empty($data['records'])): ?>
    <table class="records-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Doctor</th>
                <th>Chief Complaint</th>
                <th>Reports</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['records'] as $record): ?>
                <tr>
                    <td><?php echo htmlspecialchars($record->record_created_at); ?></td>
                    <td><?php echo 'Dr. '.$record->firstName.' '.$record->lastName ;?></td>
                    <td><?php echo htmlspecialchars($record->chief_complaint); ?></td>
                    <td><?php echo htmlspecialchars($record->report_count); ?> Reports</td>
                    <td>
                        <form action="<?php echo URLROOT.'patientController/viewHealthRecord/' .$record->record_id;?>" method="post">
                            <button type="submit" class="view-btn">View record</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No medical records found.</p>
<?php endif; ?>
        
        <!-- <div class="pagination">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">Next »</a>
        </div> -->
    </div>
    </div>
    <script src="<?php echo URLROOT?>public/js/doctor/js/navbar.js" ></script>
    </body>
</html>
