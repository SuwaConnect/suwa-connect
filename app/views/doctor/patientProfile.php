<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>patient profile</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/patientProfile.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <script src="navbar.js" defer></script>
</head>
<body>
    <?php include 'navbarbhagya.php'; ?>


    <div class="main-content">
        <div class="grid-container">

            <div class="profile">
                <img src="<?php echo URLROOT;?>public/images/doctor/images/profile.png" alt="">
                <div class="info-list">
                    <p>Name:</p>
                    <p><?php echo $data['patient']->first_name.' '.$data['patient']->last_name;?></p>

                    <p>Age:</p>
                    <p>25</p>

                    <p>Email</p>
                    <p><?php echo $data['patient']->email?></p>

                    <p>Patient ID:</p>
                    <p>0712345678</p>
                    
                </div>

            </div>
            <div class="search">
                <div class="search-bar">
                <input type="search" placeholder="Search health records..." aria-label="Search" />
               
                </div>

                <div class="search-results">
                </div>
            </div>

            <div class="buttons">
                <div class="button-div"><button id="overview-btn">see overview</button></div>
                <div class="button-div"><button id="info-btn">see general info</button></div>
                <div class="button-div"><button id="addRecord-btn" onclick="addHealthRecord(<?php echo $data['patient']->patient_id?>)">add new record</button></div> 
            </div>
        
        </div>

    </div>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

    <script>

const URLROOT = "<?php echo URLROOT;?>";

function addHealthRecord(patientId) {
    window.location.href = `${URLROOT}/visitRecordController/addHealthRecord/${patientId}`;
}



document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('input[type="search"]');
    const resultsContainer = document.querySelector('.search-results');

    // Load all records on page load
    fetchHealthRecords('');

    // Add live search listener
    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.trim();
        fetchHealthRecords(searchTerm);
    });

    // Fetch records from PHP backend
    function fetchHealthRecords(searchTerm = '') {
        const patientId = "<?php echo $data['patient']->patient_id; ?>";
        let apiUrl = `${URLROOT}/visitRecordController/getHealthRecords/${patientId}`;

        if (searchTerm) {
            apiUrl += `?search=${encodeURIComponent(searchTerm)}`;
        }

        resultsContainer.innerHTML = '<p>Loading health records...</p>';

        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                displayRecords(data);
            })
            .catch(error => {
                resultsContainer.innerHTML = `<p>Error loading records: ${error.message}</p>`;
                console.error('Fetch error:', error);
            });
    }

    // Display records
    function displayRecords(records) {
        if (records.length === 0) {
            resultsContainer.innerHTML = '<p>No records found.</p>';
            return;
        }

        let html = '';
        records.forEach(record => {
            const dateOnly = new Date(record.created_at).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            });

            html += `
                <div class="search-item">
                    <p class="date">${dateOnly}</p>
                    <p class="doctorName">Dr. ${record.doctor_name}</p>
                    <p class="report-description">${record.diagnosis}</p>
                    <button class="seeMore" id="seeMore" data-id="${record.record_id}" onclick="seeMoreinfo('${record.record_id}')">see more</button>
                    <button class="delete" id="delete" data-id="${record.record_id}" onclick="deleteRecord('${record.record_id}')">delete</button>
                </div>
            `;
        });

        resultsContainer.innerHTML = html;
    }

});

// Make sure these are global so inline onclick can access them
function seeMoreinfo(recordId) {
    window.location.href = `${URLROOT}visitRecordController/viewHealthRecord/${recordId}`;
}

function deleteRecord(recordId) {
    if (confirm('Are you sure you want to delete this record?')) {
        fetch(`${URLROOT}/visitRecordController/deleteHealthRecord/${recordId}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Record deleted successfully!');
                // Refresh records (make sure search input is still accessible)
                // const searchInput = document.querySelector('input[type="search"]');
                // const searchTerm = searchInput?.value.trim() || '';
                // fetchHealthRecords(searchTerm);
            } else {
                alert('Error deleting record: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting record: ' + error.message);
        });
    }
}


    </script>
    
</body>
</html>