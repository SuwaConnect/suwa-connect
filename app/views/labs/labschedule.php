<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an Appointment</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/schedule.css">
</head>
<body>

<?php include "labNavbar.php";?>

    <div class="main-container">
        <div class="appointment-section">
            <h1>Book an Appointment</h1>
            <form class="appointment-form" method="POST" action="labschedule/schedule">
                <label for="appointment-date">Appointment Date</label>
                <input type="date" id="appointment-date" name="appointment_date">

                <label for="appointment-time">Appointment Time</label>
                <input type="time" id="appointment-time" name="appointment_time">

                <label for="lab-select">Select Lab</label>
                <select name="lab_select" id="lab_select">
                    <option value="" selected disabled>Select the lab</option>
                    <?php if(isset($data['labs']) && !empty($data['labs'])): ?>
                        <?php foreach($data['labs'] as $lab): ?>
                            <option value="<?=$lab->lab_id?>"><?=$lab->name?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <label for="notes">Test type</label>
                <textarea id="notes" name="notes" placeholder="Test type"></textarea>

                <button type="submit" class="submit-button">Book Appointment</button>
            </form>
        </div>
    </div>

    <script src="<?php echo URLROOT;?>public/assets/js/schedule.js"></script>
</body>
</html>
