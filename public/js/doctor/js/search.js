
const URLROOT = 'http://localhost/newFramework';


    const searchInput = document.getElementById('search');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value;
        
        // Send AJAX request to search endpoint
        fetch(`${URLROOT}/searchController/searchPatientAjax`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `search=${searchTerm}`
        })
        .then(response => response.json())
        .then(data => {
            const patientList = document.getElementById('patientList');
            patientList.innerHTML = ''; // Clear current list
            
            if (data.length === 0) {
                patientList.innerHTML = `
                    <div class="no-patients" style="font-size: 20px; margin-top: 20px; text-align: center; 
                         background-color: #f1f1f1; padding: 40px; border-radius: 10px; width:40%; margin-left: 30%;">
                        <span>No patients found in the search</span>
                    </div>`;
                return;
            }
            
            data.forEach(patient => {
                const patientElement = createPatientElement(patient);
                patientList.appendChild(patientElement);
            });
        })
        .catch(error => console.error('Error:', error));
    });

// }

function calculateAge(dob) {
    // Parse the date of birth
    const birthDate = new Date(dob);
    
    // Get current date
    const today = new Date();
    
    // Calculate the difference in years
    let age = today.getFullYear() - birthDate.getFullYear();
    
    // Check if birthday has occurred this year
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    
    return age;
}

function createPatientElement(patient) {
    const age = calculateAge(patient.dob);
    const div = document.createElement('div');
    div.className = 'patient';
    
    div.innerHTML = `
        <div class="patient-image">
            <img src="${URLROOT}/public/images/doctor/images/profile.png" alt="patient icon">
        </div>
        <div id="patient-details">
            <div class="patient-name">
                <span id="patientId">${patient.first_name} ${patient.last_name}</span>
            </div>
            <div class="patient-gender">
                <span id="name">${patient.gender} </span>
            </div>
            <div class="patient-age">
                <span id="age">${age} years</span>
            </div>
            <div class="patient-contact">
                <span id="dob">${patient.contact_no}</span>
            </div>
            <div class="btns">
                ${generateButtons(patient)}
            </div>
        </div>`;
        
    return div;
}

function generateButtons(patient) {
    if (patient.request_status === 'pending') {
        return `
            <div class="request-access-btn">
                <button disabled style="background-color: #cccccc;">Already Requested</button>
            </div>`;
    } else if (patient.request_status === 'approved') {
        return `
            <div class="visit-profile-btn">
                <button onclick="visitProfile('${patient.patient_id}')">Visit Profile</button>
            </div>`;
    } else {
        return `
            <div class="request-access-btn">
                <button onclick="requestAccess('${patient.patient_id}')" id="request-access-${patient.patient_id}">
                    Request Access
                </button>
            </div>`;
    }
}

function requestAccess(patientId) {
    fetch(`${URLROOT}/permissionController/sendAccessRequest`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `patient_id=${patientId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const button = document.getElementById(`request-access-${patientId}`);
            button.disabled = true;
            button.style.backgroundColor = '#cccccc';
            button.textContent = 'Already Requested';
        }
    })
    .catch(error => console.error('Error:', error));
}

function visitProfile(patientId) {
    // First check if we have permission before redirecting
    fetch(`${URLROOT}/permissionController/checkAccess/${patientId}`)
        .then(response => response.json())
        .then(data => {
            if (data.hasAccess) {
                window.location.href = `${URLROOT}/permissioncontroller/viewPatientProfile/${patientId}`;
            } else {
                alert('You do not have permission to view this profile');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error checking access permissions');
        });
    
}
    


