<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/lab/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/lab/dashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/lab/appointments.css">
    <title>Suwa-Connect | Appointments</title>
</head>

<body>
    
    <?php include 'labNavbar.php';?>

    <div class="main-content">
        <header>
            <h1>Appointments</h1>
            <p>View, manage, and schedule patient appointments for laboratory tests and consultations.</p>
        </header>

        <section class="overview">
            <div class="card">
                <h3>Total Appointments Today</h3>
                <p><?= $data['totalAppointmentsToday'] ?? 'Not Available' ?></p>
            </div>
            <div class="card">
                <h3>Upcoming Appointments</h3>
                <p><?= $data['getUpcomingAppointmentsCount'] ?? 'Not Available' ?></p>
            </div>
            <div class="card">
                <h3>Missed Appointments</h3>
                <p><?= $data['getMissedAppointmentsCount'] ?? 'Not Available' ?></p>
            </div>
            <div class="card">
                <h3>Cancellations</h3>
                <p><?= $data['getCancelledAppointments'] ?? 'Not Available' ?></p>
            </div>
        </section>

        <section class="appointments-table">
            <h2>Appointment List</h2>
            <section class="filters">
            <h2>Filter Appointments</h2>
            <form method="GET" action="">
    <input type="text" name="patient_name" placeholder="Enter patient name" value="<?= htmlspecialchars($_GET['patient_name'] ?? '') ?>">
    <input type="text" name="test_type" placeholder="Enter test type" value="<?= htmlspecialchars($_GET['test_type'] ?? '') ?>">
    <input type="date" name="appointment_date" value="<?= htmlspecialchars($_GET['appointment_date'] ?? '') ?>">
    <select name="status">
        <option value="all" <?= ($_GET['status'] ?? 'all') === 'all' ? 'selected' : '' ?>>All</option>
        <option value="in_progress" <?= ($_GET['status'] ?? '') === 'pending' ? 'selected' : '' ?>>In Progress</option>
        <option value="completed" <?= ($_GET['status'] ?? '') === 'accepted' ? 'selected' : '' ?>>Completed</option>
        <option value="cancelled" <?= ($_GET['status'] ?? '') === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
    </select>
    <button type="submit">Apply Filters</button>
</form>
        </section>
            <div class="table-wrapper">
            

<table>
    <thead>
        <tr>
            <th>Appointment ID</th>
            <th>Patient Name</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Test Type</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($appointments) && !empty($appointments)): ?>
            <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?= htmlspecialchars($appointment->appointment_id) ?></td>
                    <td><?= htmlspecialchars($appointment->patient_name) ?></td>
                    <td><?= date('Y-m-d', strtotime($appointment->appointment_date)) ?></td>
                    <td><?= htmlspecialchars($appointment->appointment_time) ?></td>
                    <td><?= htmlspecialchars($appointment->test_type) ?></td>
                    <td><?= htmlspecialchars($appointment->status) ?></td>
                    <td>
                        <!-- Actions (view, reschedule, etc.) -->
                        <form method="POST" action="">
                            <input type="hidden" name="appointment_id" value="<?= $appointment->appointment_id ?>">
                            <button type="submit" name="view_appointment" class="view-btn">View</button>
                            <?php if ($appointment->status === 'scheduled'): ?>
                                <button type="submit" name="reschedule_appointment" class="reschedule-btn">Reschedule</button>
                            <?php endif; ?>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">No appointments found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

            </div>
        </section>

        

        <section class="calendar-view">
            <h2>Appointment Calendar</h2>
            <div id="calendar"></div>
        </section>

        <div class="modal" id="appointment-details">
            <h3>Appointment Details</h3>
            <p><strong>Patient Name:</strong> John Doe</p>
            <p><strong>Date & Time:</strong> 2024-11-29 | 10:00 AM</p>
            <p><strong>Test Type:</strong> Blood Test</p>
            <p><strong>Status:</strong> Scheduled</p>
            <p><strong>Doctor's Notes:</strong> Fasting required before the test.</p>
            <button>Close</button>
        </div>

        <section class="notifications">
            <h2>Notifications</h2>
            <ul>
                <li><strong>Upcoming:</strong> Blood Test for John Doe in 30 minutes.</li>
                <li><strong>Missed:</strong> Urine Analysis for Jane Smith at 9:00 AM today.</li>
            </ul>
        </section>

        <section class="appointment-tools">
            <h2>Manage Appointment</h2>
            <button class="reschedule-btn">Reschedule</button>
            <button class="cancel-btn">Cancel</button>
            <button class="complete-btn">Mark as Completed</button>
        </section>

        <section class="feedback">
            <h2>Submit Feedback</h2>
            <textarea placeholder="Enter your feedback here..."></textarea>
            <button>Submit</button>
        </section>

        <!-- Footer Section -->
        <footer>
            <p>&copy; 2024 Suwa Connect. All rights reserved.</p>
            <a href="#"></a>
        </footer> 
    </div>

    <script src="<?php echo URLROOT?>public/assets/js/doctor/navbar.js"></script>
    <script src="<?php echo URLROOT?>public/assets/js/doctor/appointments.js"></script>
</body>

</html>
