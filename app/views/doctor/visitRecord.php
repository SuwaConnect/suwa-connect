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
                <textarea id="chiefComplaint" placeholder="Primary reason for visit..."  name="chiefComplaint" required></textarea>
            </div>

            <div class="vital-signs">
                <h2>Vital Signs</h2>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="bloodPressure">Blood Pressure</label>
                            <div class="bp-inputs">
                                <input type="number" placeholder="Sistolic"  name="sistolic" min="60" max="250">
                                <input type="number" placeholder="Diastolic"  name="diastolic" min="40" max="150">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="temperature">Temperature (°C)</label>
                            <input type="number" step="1" id="temperature"  name="temperature" min="30" max="45">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="bloodSugar">Blood Sugar (mg/dL)</label>
                            <input type="number" id="bloodSugar"  name="bloodSugar" min="20" max="600">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="cholesterol">Cholesterol (mg/dL)</label>
                            <input type="number" id="cholesterol"  name="cholesterol" min="50" max="500">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="weight">weight</label>
                            <input type="number" id="weight"  name="weight" min="0.1" max="500">
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
                <textarea id="diagnosis" placeholder="Enter diagnosis..."  name="diagnosis" required></textarea>
            </div>
            
            

            <div class="form-group">
                <label for="doctorNotes">Additional Notes</label>
                <textarea id="doctorNotes" placeholder="Any additional notes..." name="additional_notes"></textarea>
            </div>

            <button type="submit">Attach reports</button>
        </form>

        
    </div>


    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
    <!-- <script src="public/js/doctor/js/visitRecord.js"></script> -->
    

    

    
</body>
</html>


