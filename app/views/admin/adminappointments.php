<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/admin/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/admin/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/admin/appointments.css">

    <title>Suwa-Connect</title>
</head>

<body>
    <?php include 'adminNavbar.php'?>
    <div class="main-content">
        <!-- Header Section -->
        <header class="header">
            <h1>Appointments Management</h1>
            <p>Monitor and manage all appointments scheduled between patients and healthcare providers.</p>
        </header>

        <!-- Appointments Overview Section -->
        <section class="overview">
            <div class="overview-card">
                <h3>Total Appointments</h3>
                <p><?= $data['totalAppointments'] ?? '0' ?></p>
            </div>
            <div class="overview-card">
                <h3>Upcoming Appointments</h3>
                <p><?= $data['upcomingAppointments'] ?? '0' ?></p>
            </div>
            <div class="overview-card">
                <h3>Completed Appointments</h3>
                <p><?= $data['completedAppointments'] ?? '0' ?></p>
            </div>
            <div class="overview-card">
                <h3>Canceled Appointments</h3>
                <p><?= $data['cancelledAppointments'] ?? '0' ?></p>
            </div>
        </section>

        <!-- Appointments Table -->
        <section class="appointments-table">
            <h2>Appointments List</h2>
            

            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Appointment Date</th>
                        <th>Status</th>
                        <th>Type of Consultation</th>
                    </tr>
                </thead>
                <tbody id="appointmentsBody">
                    <?php if (!empty($data['appointments'])): ?>
                        <?php foreach ($data['appointments'] as $appointment): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($appointment->patient_name); ?></td>
                                <td><?php echo htmlspecialchars($appointment->doctor_name); ?></td>
                                <td><?php echo htmlspecialchars($appointment->appointment_date); ?></td>
                                <td><?php echo htmlspecialchars($appointment->status); ?></td>
                                <td><?php echo htmlspecialchars($appointment->reason); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No appointments found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            
        </section>

        <!-- Footer Section -->
        <footer>
            <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
            <a href="#"></a>
        </footer> 

    </div>


    <script src="./js/appointments.js"></script>
    <script src="<?php echo URLROOT?>public/assets/js/navbar.js"></script>
</body>

</html>