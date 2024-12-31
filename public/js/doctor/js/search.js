
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
                            <span id="patientId">${patient.id}</span>
                        </div>
                        <div class="patient-name">
                            <span id="name">${patient.name}</span>
                        </div>
                        <div class="patient-age">
                            <span id="age">${patient.age}</span><span> years</span>
                        </div>
                        <div class="request-access-btn">
                            <button onclick="requestAccess(${patient.id})">Request access</button>
                        </div>
                        <div class="visit-profile-btn">
                            <button onclick="visitProfile(${patient.id})">visit profile</button>
                        </div>
                    </div>
                </div>
            `).join('')}
        </div>`;


        resultsDiv.innerHTML = html;
    }
});
