<!DOCTYPE html>
<html lang="en">
    
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/visitRecord.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <title>Visit Record</title>
   
   

</head>

<body>

    <?php include 'navbarbhagya.php'; ?>

    <div class="container">
        <h1>Visit Record</h1>
        <form id="visitRecordForm" action="<?php echo URLROOT?>visitRecordController/addHealthRecord/<?php echo $data['patientId']?>" method="post"> 

            <input type="hidden" name="patient_id" value="<?php echo $data['patientId']; ?>">
            
            <div class="form-group">
                <label for="visitDate">Visit Date & Time</label>
                <input type="datetime-local" id="visitDate" name="visitDate" required value="<?php echo date('Y-m-d\TH:i'); ?>">           
             </div>

            <div class="form-group">
                <label for="chiefComplaint">Chief Complaint</label>
                <textarea id="chiefComplaint" placeholder="Primary reason for visit..."  name="chiefComplaint"></textarea>
            </div>

            <div class="vital-signs">
                <h2>Vital Signs</h2>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="bloodPressure">Blood Pressure</label>
                            <div class="bp-inputs">
                                <input type="number" placeholder="Sistolic"  name="sistolic">
                                <input type="number" placeholder="Diastolic"  name="diastolic">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="temperature">Temperature (°C)</label>
                            <input type="number" step="0.1" id="temperature"  name="temperature">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="bloodSugar">Blood Sugar</label>
                            <input type="number" id="bloodSugar"  name="bloodSugar">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="cholesterol">Cholesterol</label>
                            <input type="number" id="cholesterol"  name="cholesterol">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="weight">weight</label>
                            <input type="number" id="weight"  name="weight">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                           
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="diagnosis">Diagnosis</label>
                <textarea id="diagnosis" placeholder="Enter diagnosis..."  name="diagnosis"></textarea>
            </div>
            
            <div class="form-group">
                <!-- <label for="reports">Upload Reports</label>
                <input type="file" id="reports" multiple> -->
                
            </div>

            <div class="form-group">
                <label for="doctorNotes">Additional Notes</label>
                <textarea id="doctorNotes" placeholder="Any additional notes..." name="additional_notes"></textarea>
            </div>

            <button type="submit">Attach reports</button>
        </form>

        <div class="nav-links">
            <a href="">Go to General Information</a>
        </div>
    </div>


    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
    <!-- <script src="public/js/doctor/js/visitRecord.js"></script> -->
    

    

    
</body>
</html>


