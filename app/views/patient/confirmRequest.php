<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        
        

        <title>Suwa-Connect</title>
    </head>

    <body>
        
   
<?php include  "navbar-patient.php";?>
    <!-- <div class="main-content">
    <div class="main-container">
        
        <h1>Doctor Access Requests</h1>
        <p>Manage your doctor access requests below:</p> -->
        <div class="main-content">
<div class="request-container">
    <h2>Doctor Access Requests</h2>
    <div id="requestsList">
        <!-- Requests will be loaded here -->
    </div>
</div>
</div>

<script>
const URLROOT = '<?php echo URLROOT; ?>';


document.addEventListener('DOMContentLoaded', function() {
    loadPendingRequests();
});

function loadPendingRequests() {
    fetch(`${URLROOT}/permissionController/getPendingRequests`)
        .then(response => response.json())
        .then(requests => {
            displayRequests(requests);
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('requestsList').innerHTML = 'Error loading requests!';
        });
}

function displayRequests(requests) {
    const requestsList = document.getElementById('requestsList');
    
    if (requests.length === 0) {
        requestsList.innerHTML = '<p class="no-requests">No pending requests</p>';
        return;
    }
    
    const html = `
        <div class="requests-list">
            ${requests.map(request => `
                <div class="request-card" id="request-${request.id}">
                    <div class="doctor-info">
                        <img src="${URLROOT}/public/images/doctor/images/profile.png" 
                             alt="Doctor profile" 
                             class="doctor-image">
                        <div class="doctor-details">
                            <h3>Dr. ${request.firstName} wants to see your profile.</h3>
                            <p>Requested: ${request.requested_at}</p>                        </div>
                    </div>
                    <div class="request-actions">
                        <button onclick="handleRequest(${request.id}, 'approved')" 
                                class="approve-btn">
                            Approve
                        </button>
                        <button onclick="handleRequest(${request.id}, 'denied')" 
                                class="deny-btn">
                            Deny
                        </button>
                    </div>
                </div>
            `).join('')}
        </div>`;
    
    requestsList.innerHTML = html;
}

function handleRequest(requestId, status) {
    const formData = new FormData();
    formData.append('request_id', requestId);
    formData.append('status', status);
    
    fetch(`${URLROOT}/permissionController/handleRequest`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the request card with animation
            const requestCard = document.getElementById(`request-${requestId}`);
            requestCard.style.animation = 'fadeOut 0.5s';
            setTimeout(() => {
                requestCard.remove();
                // Check if there are no more requests
                if (document.querySelectorAll('.request-card').length === 0) {
                    loadPendingRequests(); // This will show the "No pending requests" message
                }
            }, 500);
        }
        alert(data.message);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while processing the request');
    });
}
</script>

<script src="<?php echo URLROOT?>public\js\doctor\js\navbar.js"></script>



<style>

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
.request-container {
    /* max-width: 800px; */
    width: 100%;
    margin: 2rem auto;
    padding: 0 1rem;
}

.request-card {
    background: white;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.doctor-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.doctor-image {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
}

.doctor-details h3 {
    margin: 0;
    color: #333;
}

.doctor-details p {
    margin: 0.5rem 0 0;
    color: #666;
    font-size: 0.9rem;
}

.request-actions {
    display: flex;
    gap: 1rem;
}

.approve-btn, .deny-btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
    transition: background-color 0.3s;
}

.approve-btn {
    background-color: #4CAF50;
    color: white;
}

.approve-btn:hover {
    background-color: #45a049;
}

.deny-btn {
    background-color: #f44336;
    color: white;
}

.deny-btn:hover {
    background-color: #da190b;
}

.no-requests {
    text-align: center;
    color: #666;
    padding: 2rem;
    background: #f5f5f5;
    border-radius: 8px;
}

@keyframes fadeOut {
    from { opacity: 1; transform: translateX(0); }
    to { opacity: 0; transform: translateX(-20px); }
}

/* Responsive design */
@media (max-width: 600px) {
    .request-card {
        flex-direction: column;
        text-align: center;
    }
    
    .request-actions {
        margin-top: 1rem;
    }
    
    .doctor-info {
        flex-direction: column;
    }
}
</style>
</body>
</html>