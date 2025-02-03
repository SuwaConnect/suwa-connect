
const URLROOT = 'http://localhost/newFramework';

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const resultsDiv = document.getElementById('patientList');
    let searchTimeout;
    
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const searchTerm = this.value.trim();
        
        // Don't search if input is empty
        if (searchTerm === '') {
            resultsDiv.innerHTML = 'Enter the patient name to search.';
            return;
        }

        // Add delay to prevent too many requests
        searchTimeout = setTimeout(() => {
            searchPatients(searchTerm);
        }, 300);
    });

    function searchPatients(searchTerm) {
        const formData = new FormData();
        formData.append('search', searchTerm);
        formData.append('ajax', '1');
    
        fetch(`${URLROOT}/searchController/search`, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            // Log the raw response
            response.clone().text().then(text => {
                console.log('Raw response:', text);
            });
            
            return response.json();
        })
        .then(patients => {
            displayResults(patients);
        })
        .catch(error => {
            console.error('Detailed error:', error);
            resultsDiv.innerHTML = 'an error occurred';
        });
    }

    function displayResults(patients) {
        if (patients.length === 0) {
            resultsDiv.innerHTML = '<div class="no-results">No patients found</div>';
            return;
        }

        const html = `
        <div class="patientList">
            ${patients.map(patient => `
                <div class="patient">
                    <div class="patient-image">
                        <img src="${URLROOT}/public/images/doctor/images/profile.png" alt="patient icon">
                    </div>
                    <div id="patient-details">
                        <div class="patient-id">
                            <span id="patientId">${patient.patient_id}</span>
                        </div>
                        <div class="patient-name">
                            <span id="name">${patient.firstName}</span>
                        </div>
                        <div class="patient-age">
                            <span id="age">${patient.age}</span><span> years</span>
                        </div>
                        <div class="request-access-btn">
                            <button data-patient-id="${patient.patient_id}">request access</button>
                        </div>
                        <div class="visit-profile-btn">
                            <button data-patient-id="${patient.patient_id}">visit profile</button>
                        </div>
                    </div>
                </div>
            `).join('')}
        </div>`;


        resultsDiv.innerHTML = html;

        addButtonEventListeners();
    }


    function addButtonEventListeners() {
        // Add listeners for request access buttons
        document.querySelectorAll('.request-access-btn button').forEach(button => {
            button.addEventListener('click', function() {
                const patientId = this.getAttribute('data-patient-id');
                requestAccess(patientId);
            });
        });

        // Add listeners for visit profile buttons
        document.querySelectorAll('.visit-profile-btn button').forEach(button => {
            button.addEventListener('click', function() {
                const patientId = this.getAttribute('data-patient-id');
                visitProfile(patientId);
            });
        });
    }

    function requestAccess(patientId) {
        const formData = new FormData();
        formData.append('patient_id', patientId);
        console.log(patientId);
        
        fetch(`${URLROOT}/permissionController/requestAccess`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Find the button within the specific patient card
                const patientCard = document.querySelector(`[id="patientId"][innerHTML="${patientId}"]`)
                                   .closest('.patient');
                const requestButton = patientCard.querySelector('.request-access-btn button');
                
                if (requestButton) {
                    requestButton.textContent = 'Request Sent';
                    requestButton.disabled = true;
                    requestButton.style.backgroundColor = '#808080';
                }
                alert(data.message);
            } else {
                alert(data.message || 'Failed to send request');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while sending the request');
        });
    }

    function visitProfile(patientId) {
        // Add your visit profile logic here
        console.log('Visit profile for patient:', patientId);
    }
});

    


