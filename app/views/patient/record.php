<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/records.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <title>Suwa-Connect</title>
</head>

<body>

    <?php include  "navbar-patient.php";?>
    
    <div class="containerf">
        <div class="container">
            <div class="main-content">
                <h1>Hey, manilka!</h1>
                <p id="current-date"></p>

                <div class="boxes">
                    <div class="box">
                        <div class="box-header">
                            <img src="<?php echo URLROOT?>public/assets/images/Health Records/BS.png" alt="Icon" class="box-icon">
                            <h3>Blood Sugar</h3>
                        </div>
                        <div class="box-data">
                            <span class="value">80</span>
                            <span class="unit">mg/dL</span>
                        </div>
                        <img src="<?php echo URLROOT?>public/assets/images/Health Records/BSgraph.png" alt="Graph" class="graph-icon">
                    </div>

                    <div class="box">
                        <div class="box-header">
                            <img src="<?php echo URLROOT?>public/assets/images/Health Records/BP.png" alt="Icon" class="box-icon">
                            <h3>Blood Pressure</h3>
                        </div>
                        <div class="box-data">
                            <span class="value">120</span>
                            <span class="unit">mmHg</span>
                        </div>
                        <img src="<?php echo URLROOT?>public/assets/images/Health Records/BPgraph.png" alt="Graph" class="graph-icon">
                    </div>

                    <div class="box">
                        <div class="box-header">
                            <img src="<?php echo URLROOT?>public/assets/images/Health Records/HR.png" alt="Icon" class="box-icon">
                            <h3>Heart Rate</h3>
                        </div>
                        <div class="box-data">
                            <span class="value">200</span>
                            <span class="unit">mg/dL</span>
                        </div>
                        <img src="<?php echo URLROOT?>public/assets/images/Health Records/HRgraph.png" alt="Graph" class="graph-icon">
                    </div>
                </div>
                <div class="blue-background"></div>
            </div>
        </div>
        
        <div class="live-graph">
            <h2>Blood Pressure Levels Over Time</h2>
            <div class="graph-container">
                <div class="graph-bar" data-month="January" style="height: 50%;"></div>
                <div class="graph-bar" data-month="February" style="height: 60%;"></div>
                <div class="graph-bar" data-month="March" style="height: 45%;"></div>
                <div class="graph-bar" data-month="April" style="height: 70%;"></div>
                <div class="graph-bar" data-month="May" style="height: 65%;"></div>
                <div class="graph-bar" data-month="June" style="height: 55%;"></div>
                <div class="graph-bar" data-month="July" style="height: 80%;"></div>
                <div class="graph-bar" data-month="August" style="height: 75%;"></div>
                <div class="graph-bar" data-month="September" style="height: 90%;"></div>
                <div class="graph-bar" data-month="October" style="height: 85%;"></div>
                <div class="graph-bar" data-month="November" style="height: 60%;"></div>
                <div class="graph-bar" data-month="December" style="height: 70%;"></div>
            </div>
            <div class="graph-labels">
                <span>Jan</span>
                <span>Feb</span>
                <span>Mar</span>
                <span>Apr</span>
                <span>May</span>
                <span>Jun</span>
                <span>Jul</span>
                <span>Aug</span>
                <span>Sep</span>
                <span>Oct</span>
                <span>Nov</span>
                <span>Dec</span>
            </div>
        </div>
        

        <div class="side-box">
            <div class="bmi-calculator">
                <h3>BMI Calculator</h3>
                <select class="dropdown">
                    <option value="last-week">Last Week</option>
                    <option value="last-month">Last Month</option>
                </select>
            </div>
            <div class="boxes-wrapper">
                <div class="smallboxset">
                    <div class="data-box small-box1">
                        <div class="text-container">
                            <div class="height-container">
                                <p class="label">Height</p>
                                <p class="value">170cm</p>
                            </div>
                        </div>
                    </div>
                    <div class="data-box small-box1">
                        <div class="text-container">
                            <div class="height-container">
                                <p class="label">Weight</p>
                                <p class="value">72KG</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="data-box large-box">
                    <div class="bmititle">
                        <h3>Body Mass Index</h3>
                        <div class="bmi-info">
                            <div class="bmi-value">24.5</div>
                            <button class="status">You are Healthy</button>
                        </div>
                        <div class="slider-container">
                            <div class="slider">
                                <div class="slider-track">
                                    <div class="slider-thumb" style="left: 45%;"></div>
                                </div>
                            </div>
                            <div class="slider-label">
                                <span>15</span>
                                <span class="last">40</span>
                            </div>
                        </div>
                    </div>
                </div>

                <img src="<?php echo URLROOT?>public/assets/images/Health Records/human.png" alt="Description of the image" class="bmi-image">
            </div>
        </div>
        
    </div>
    

    <script src="<?php echo URLROOT?>public/assets/js/navbartwo.js"></script>
    <script src="<?php echo URLROOT?>public/assets/js/record.js"></script>
</body>

</html>
