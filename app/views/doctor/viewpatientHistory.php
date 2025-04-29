<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Metrics Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <title>Suwa-Connect</title>
    <style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    list-style: none;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
    
}

body{
    display: flex;
    /* height: 100vh; */
    overflow-x: hidden;
    overflow-y: auto;
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
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        h1 {
            color: #2c3e50;
            font-size: 24px;
            font-weight: 600;
        }
        
        .date-filter {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .date-filter select {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
            font-size: 14px;
        }
        
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        @media (max-width: 768px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .chart-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: transform 0.2s;
        }
        
        .chart-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .chart-title {
            font-weight: 600;
            color: #2c3e50;
            font-size: 18px;
        }
        
        .chart-actions button {
            background-color: transparent;
            border: none;
            color: #3498db;
            cursor: pointer;
            font-size: 14px;
        }
        
        .chart-container {
            height: 250px;
            position: relative;
        }
        
        .metrics-summary {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        
        .metric-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        
        .metric-header {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 5px;
        }
        
        .metric-value {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .metric-change {
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .change-positive {
            color: #27ae60;
        }
        
        .change-negative {
            color: #e74c3c;
        }
        
        .change-neutral {
            color: #7f8c8d;
        }
    </style>
</head>
<body>

        <?php include 'navbarbhagya.php'?>
    <div class="main-content">
    <div class="container">
        <header>
            <h1>Health Metrics Dashboard</h1>
            
        </header>
        
        <div class="charts-grid">
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">Blood Pressure</div>
                    
                </div>
                <div class="chart-container">
                <canvas id="bpChart"></canvas>
                </div>
            </div>
            
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">Blood Sugar Levels</div>
                   
                </div>
                <div class="chart-container">
                <canvas id="bloodSugarChart"></canvas>
                </div>
            </div>
            
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">Cholesterol Levels</div>
                    
                </div>
                <div class="chart-container">
                <canvas id="cholesterolChart"></canvas>
                </div>
            </div>
            
            
        </div>
        
        <div class="metrics-summary">
            
        </div>
    </div>
    </div>

    

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
                <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js" ></script>

</body>
</html>