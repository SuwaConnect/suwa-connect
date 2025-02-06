<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Appointment</title>
    <link rel="stylesheet" href="assets/css/changeApp.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="header">
                <h1>Update Appointment</h1>
            </div>
            <form method="POST">
                <div class="form-row">
                    <div class="form-column">
                        <div class="input-group">
                            <label for="appointment_date">New Date</label>
                            <input type="date" id="appointment_date" name="appointment_date" value="<?= $data['appointment']->appointment_date ?? '' ?>" required>
                        </div>
                        <div class="input-group">
                            <label for="appointment_time">New Time</label>
                            <input type="time" id="appointment_time" name="appointment_time" value="<?= $data['appointment']->appointment_time ?? '' ?>" required>
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <button type="submit" class="up-btn">Update Appointment</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
