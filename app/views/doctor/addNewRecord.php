<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add new record</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/addnewRecord.css" />
    <!-- <link rel="stylesheet" href="navbarcssbhagya.css"> -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <script src="navbar.js" defer></script>
</head>
<body>

    <?php include 'navbarbhagya.php'; ?>
    


    <div class="main-content">
        <div class="grid-container">
            <div class="general-info">
               <!-- <div class="general-info-card"> -->
                  
                    <div class="info-line">
                        <p>date:</p>
                        <p>24/10/2024</p>
                    </div> 
                    
                    <div class="info-line">
                        <p>time:</p>
                        <p>10:30</p> 
                    </div> 
                  
                    <div class="info-line">
                        <p>consulter:</p>
                        <p>Dr. Kim</p>
                    </div> 

                
                
            </div>

            <div class="initial-description">
                <p>Initial description of the record</p>
                <input type="text">
            </div>

            <div class="description">
                <p>Further-Description</p>
                <input type="text">
            </div>

            <div class="prescription">
                <p>Prescription</p>
                <input type="text">
            </div>

            <div class="reports">
                <p>Reports</p>
                <input type="file">
            </div>

            <div class="checkups">
                <p>Blood pressure levels</p>
                <div class="checkups-row">
                <div>
                    <label for="">systolic level</label>
                    <input type="text">
                </div>
                <div>
                    <label for="">diastolic level</label>
                    <input type="text">
                </div>
                </div>
            </div>

            <div class="checkups">
                <p>cholesterol levels</p>
                <div class="checkups-row">
                <div>
                    <label for="">LDL level</label>
                    <input type="text">
                </div>
                <div>
                    <label for="">HDL level</label>
                    <input type="text">
                </div>
                </div>
            </div>

            <div class="checkups">
                <p>blood sugar levels</p>
                <div class="checkups-row">
                <div>
                    <label for="">fasting</label>
                    <input type="text">
                </div>
              
                </div>
            </div>

            <div class="checkups">
                <div class="checkups-row">
                    <div>
                        <label for="">weight</label>
                        <input type="text">
                    </div>
                    
                </div>
            </div>



            <div class="add-record">
                <button>Add Record</button>
            </div>    

        
    </div>
    </div>

    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/calender.js"></script>
</body>
</html>