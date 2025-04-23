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
    <div class="main-content1">
    <div class="containerf">
        <div class="container">
            <div class="main-content">
                <h1>Welcome back <?php echo $data['patient']->first_name?>! </h1>
                <h2>Here's an overview of your past health records...</h2>

                <p id="current-date"></p>

                <div class="boxes">
                    <div class="box">
                        <div class="box-header">
                            <img src="<?php echo URLROOT?>public/assets/images/Health Records/BS.png" alt="Icon" class="box-icon">
                            <h3>Blood Sugar</h3>
                        </div>
                        <div class="box-data">
                            <span class="value"><?php echo end($data['vitalSigns'])->blood_sugar?></span>
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
                            <span class="value"><?php echo end($data['vitalSigns'])->systolic .'/'. end($data['vitalSigns'])->diastolic?></span>
                            <span class="unit">mmHg</span>
                        </div>
                        <img src="<?php echo URLROOT?>public/assets/images/Health Records/BPgraph.png" alt="Graph" class="graph-icon">
                    </div>

                    <div class="box">
                        <div class="box-header">
                            <img src="<?php echo URLROOT?>public/assets/images/Health Records/HR.png" alt="Icon" class="box-icon">
                            <h3>Cholesterol</h3>
                        </div>
                        <div class="box-data">
                            <span class="value"><?php echo end($data['vitalSigns'])->cholesterol?></span>
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
            <div class="bp-graph-container">
                <canvas id="bpChart"></canvas>
            </div>
        </div>

        <div class="charts">

        <div class="chart-container">
            <h2>Cholesterol History</h2>
            <canvas id="cholesterolChart"></canvas>
        </div>

        <div class="chart-container">
            <h2 class="chart-title">Blood Sugar Tracking</h2>
            <div class="chart-wrapper">
                <canvas id="bloodSugarChart"></canvas>
            </div>
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
                                <p class="value"><?php echo end($data['vitalSigns'])->weight?>KG</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="data-box large-box">
                    <div class="bmititle">
                        <h3>Body Mass Index</h3>
                        <div class="bmi-info">
                            <div class="bmi-value"><?php echo end($data['vitalSigns'])->weight?></div>
                            <button class="status">You are Healthy</button>
                        </div>
                        <div class="slider-container">
                            <div class="slider">
                                <div class="slider-track">
                                    <div class="slider-thumb" style="left: 80%;"></div>
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
    </div>

    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js" ></script>
    <script src="<?php echo URLROOT?>public/assets/js/record.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Get vital signs data from PHP
    const vitalSigns = <?php echo json_encode($data['vitalSigns']); ?>;
    
    // Create arrays for the chart data
    // Note: We'll use record_id as the x-axis since there's no date in the data
    const recordIds = vitalSigns.map(record => {
    const date = new Date(record.created_at);
    return date.toLocaleDateString();
    });
    const systolicValues = vitalSigns.map(record => record.systolic);
    const diastolicValues = vitalSigns.map(record => record.diastolic);
    
    // Create the chart
    const ctx = document.getElementById('bpChart').getContext('2d');
    const bpChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: recordIds,
            datasets: [
                {
                    label: 'Systolic (mmHg)',
                    data: systolicValues,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 2,
                    tension: 0.1,
                    fill: false
                },
                {
                    label: 'Diastolic (mmHg)',
                    data: diastolicValues,
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2,
                    tension: 0.1,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: false,
                    min: 0,
                    // Setting max dynamically based on data
                    suggestedMax: Math.max(...systolicValues, ...diastolicValues) + 20,
                    title: {
                        display: true,
                        text: 'Blood Pressure (mmHg)'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const datasetLabel = context.dataset.label || '';
                            const value = context.parsed.y;
                            return datasetLabel + ': ' + value;
                        }
                    }
                }
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Get vital signs data from PHP
    const vitalSigns = <?php echo json_encode($data['vitalSigns']); ?>;
    
    // Create arrays for the chart data
    const recordDates = vitalSigns.map(record => {
        const date = new Date(record.created_at);
        return date.toLocaleDateString();
    });
    const cholesterolValues = vitalSigns.map(record => record.cholesterol);
    
    // Create the cholesterol chart
    const ctxCholesterol = document.getElementById('cholesterolChart').getContext('2d');
    const cholesterolChart = new Chart(ctxCholesterol, {
        type: 'bar',
        data: {
            labels: recordDates,
            datasets: [
                {
                    label: 'Cholesterol (mg/dL)',
                    data: cholesterolValues,
                    backgroundColor: cholesterolValues.map(value => {
                        if (value <= 200) return 'rgba(75, 192, 192, 0.7)'; // Normal - greenish
                        if (value <= 240) return 'rgba(255, 159, 64, 0.7)'; // Borderline - orange
                        return 'rgba(255, 99, 132, 0.7)'; // High - red
                    }),
                    borderColor: cholesterolValues.map(value => {
                        if (value <= 200) return 'rgb(75, 192, 192)';
                        if (value <= 240) return 'rgb(255, 159, 64)';
                        return 'rgb(255, 99, 132)';
                    }),
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: false,
                    min: 100, // Starting from 100 for better visualization
                    // Setting max dynamically based on data
                    suggestedMax: Math.max(...cholesterolValues) + 50,
                    title: {
                        display: true,
                        text: 'Cholesterol Level (mg/dL)'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed.y;
                            let status = '';
                            if (value <= 200) status = ' (Normal)';
                            else if (value <= 240) status = ' (Borderline High)';
                            else status = ' (High)';
                            return 'Cholesterol: ' + value + ' mg/dL' + status;
                        }
                    }
                }
            }
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // Get vital signs data from PHP
    const vitalSigns = <?php echo json_encode($data['vitalSigns']); ?>;
    
    // Create arrays for the chart data
    const recordDates = vitalSigns.map(record => {
        const date = new Date(record.created_at);
        return date.toLocaleDateString();
    });
    const bloodSugarValues = vitalSigns.map(record => record.blood_sugar);
    
    // Create the blood sugar chart
    const ctxBloodSugar = document.getElementById('bloodSugarChart').getContext('2d');
    const bloodSugarChart = new Chart(ctxBloodSugar, {
        type: 'line', // Using line chart for blood sugar to distinguish from cholesterol bar chart
        data: {
            labels: recordDates,
            datasets: [
                {
                    label: 'Blood Sugar (mg/dL)',
                    data: bloodSugarValues,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: bloodSugarValues.map(value => {
                        if (value < 70) return 'rgba(255, 99, 132, 0.8)'; // Low - red
                        if (value <= 140) return 'rgba(75, 192, 192, 0.8)'; // Normal - green
                        if (value <= 200) return 'rgba(255, 159, 64, 0.8)'; // Pre-diabetic - orange
                        return 'rgba(255, 99, 132, 0.8)'; // High - red
                    }),
                    pointRadius: 5,
                    tension: 0.1 // Slight curve to the line
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: false,
                    min: 50, // Starting from 50 for better visualization
                    suggestedMax: Math.max(...bloodSugarValues) + 30,
                    title: {
                        display: true,
                        text: 'Blood Sugar Level (mg/dL)'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed.y;
                            let status = '';
                            if (value < 70) status = ' (Low)';
                            else if (value <= 140) status = ' (Normal)';
                            else if (value <= 200) status = ' (Pre-diabetic)';
                            else status = ' (High)';
                            return 'Blood Sugar: ' + value + ' mg/dL' + status;
                        }
                    }
                }
            }
        }
    });
});
</script>
</body>

</html>
