document.getElementById("addNewUserBtn").addEventListener("click", function() {
    let form = document.getElementById("addUserModal");
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";  // Show the form
    } else {
        form.style.display = "none";   // Hide the form
    }
});

// Get the modal
let modal = document.querySelector(".modal");

// Get the close button element
let closeButton = document.querySelector(".close-btn");

// Close the modal when the close button is clicked
closeButton.addEventListener("click", function() {
    modal.style.display = "none";  // Hide the modal
});

// Display success message
function showSuccessMessage() {
    let notification = document.getElementById('notification');
    notification.style.display = 'block';
    
    // Hide the message after 6 seconds
    setTimeout(function() {
        notification.style.display = 'none';
    }, 6000);
}

showSuccessMessage()


//Draw a simple pie chart to summarise the number of users

// Getting the canvas element and its 2D drawing context
var canvas = document.getElementById('userSummaryChart');
var ctx = canvas.getContext('2d');

// Legend container
var legendContainer = document.getElementById('chartLegend');

// Data for the pie chart (same data from PHP variables)
var data = [
    { label: 'Active Users', value: activeUsers, color: '#73D237' },
    { label: 'Banned Users', value: bannedUsers, color: '#8424EC' },
    { label: 'Deactivated Users', value: deactivatedUsers, color: '#FCDC3C' }
];

// Calculate total value of all data points
var totalValue = data.reduce(function(sum, dataPoint) {
    return sum + dataPoint.value;
}, 0);

// Pie chart drawing properties
var centerX = canvas.width / 2;
var centerY = canvas.height / 2;
var radius = Math.min(centerX, centerY) - 20; // Leave space for labels

// Start drawing the pie chart
var startAngle = 0;
data.forEach(function(item) {
    // Calculate slice angle
    var sliceAngle = (item.value / totalValue) * 2 * Math.PI;

    // Draw slice
    ctx.beginPath();
    ctx.moveTo(centerX, centerY); // Start from center
    ctx.arc(centerX, centerY, radius, startAngle, startAngle + sliceAngle); // Draw arc
    ctx.closePath();
    ctx.fillStyle = item.color;
    ctx.fill();

    // Update startAngle for the next slice
    startAngle += sliceAngle;

    // Create legend item
    var legendItem = document.createElement('div');
    legendItem.style.display = 'flex';
    legendItem.style.alignItems = 'center';
    legendItem.style.marginBottom = '8px';

    // Create color box
    var colorBox = document.createElement('div');
    colorBox.style.width = '20px';
    colorBox.style.height = '20px';
    colorBox.style.backgroundColor = item.color;
    colorBox.style.marginRight = '10px';

    // Create label text
    var labelText = document.createElement('span');
    labelText.textContent = item.label;

    // Append color box and label to legend item
    legendItem.appendChild(colorBox);
    legendItem.appendChild(labelText);

    // Append legend item to the legend container
    legendContainer.appendChild(legendItem);
});

document.addEventListener('DOMContentLoaded', function() {
    // View Modal
    const viewModal = document.getElementById('viewUserModal');
    const viewBtns = document.querySelectorAll('.view-btn');
    const closeViewBtn = document.querySelector('.close-btn-view');

    viewBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            viewModal.style.display = 'block';
        });
    });

    closeViewBtn.addEventListener('click', function() {
        viewModal.style.display = 'none';
    });

    // Edit Modal
    const editModal = document.getElementById('editUserModal');
    const editBtns = document.querySelectorAll('.edit-btn');
    const closeEditBtn = document.querySelector('.close-btn-edit');

    editBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            editModal.style.display = 'block';
        });
    });

    closeEditBtn.addEventListener('click', function() {
        editModal.style.display = 'none';
    });

    // Close modals when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target == viewModal) {
            viewModal.style.display = 'none';
        }
        if (e.target == editModal) {
            editModal.style.display = 'none';
        }
    });
});

// Add this to your userManagement.js file
function openViewModal(userId) {
    // Get the modal
    const modal = document.getElementById('viewUserModal');
    const modalBody = modal.querySelector('.modal-body');
    
    // Fetch user details using AJAX
    fetch('get_user_details.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `user_id=${userId}`
    })
    .then(response => response.json())
    .then(user => {
        // Create the content based on user type
        let content = `
            <div class="user-details">
                <p><strong>Name:</strong> ${user.name}</p>
                <p><strong>Email:</strong> ${user.email}</p>
                <p><strong>User Type:</strong> ${user.user_type}</p>
                <p><strong>Status:</strong> ${user.status}</p>
                <p><strong>Sign-up Date:</strong> ${user.signup_date}</p>
                <p><strong>Last Login:</strong> ${user.last_login}</p>
        `;

        // Add role-specific information
        switch(user.user_type.toLowerCase()) {
            case 'doctor':
                content += `
                    <div class="role-specific-details">
                        <h3>Doctor Details</h3>
                        <p><strong>Specialization:</strong> ${user.specialization || 'N/A'}</p>
                        <p><strong>License Number:</strong> ${user.license_number || 'N/A'}</p>
                        <p><strong>Total Patients:</strong> ${user.total_patients || '0'}</p>
                        <p><strong>Available Hours:</strong> ${user.available_hours || 'N/A'}</p>
                    </div>
                `;
                break;
            case 'patient':
                content += `
                    <div class="role-specific-details">
                        <h3>Patient Details</h3>
                        <p><strong>Age:</strong> ${user.age || 'N/A'}</p>
                        <p><strong>Blood Type:</strong> ${user.blood_type || 'N/A'}</p>
                        <p><strong>Medical History:</strong> ${user.medical_history || 'None recorded'}</p>
                        <p><strong>Last Appointment:</strong> ${user.last_appointment || 'No appointments'}</p>
                    </div>
                `;
                break;
            case 'laboratory':
                content += `
                    <div class="role-specific-details">
                        <h3>Laboratory Details</h3>
                        <p><strong>Lab License:</strong> ${user.lab_license || 'N/A'}</p>
                        <p><strong>Services:</strong> ${user.services || 'N/A'}</p>
                        <p><strong>Operating Hours:</strong> ${user.operating_hours || 'N/A'}</p>
                        <p><strong>Total Tests:</strong> ${user.total_tests || '0'}</p>
                    </div>
                `;
                break;
            case 'pharmacy':
                content += `
                    <div class="role-specific-details">
                        <h3>Pharmacy Details</h3>
                        <p><strong>License Number:</strong> ${user.pharmacy_license || 'N/A'}</p>
                        <p><strong>Location:</strong> ${user.location || 'N/A'}</p>
                        <p><strong>Operating Hours:</strong> ${user.operating_hours || 'N/A'}</p>
                        <p><strong>Total Orders:</strong> ${user.total_orders || '0'}</p>
                    </div>
                `;
                break;
        }

        content += '</div>';
        modalBody.innerHTML = content;
    })
    .catch(error => {
        modalBody.innerHTML = '<p>Error loading user details. Please try again.</p>';
        console.error('Error:', error);
    });

    // Show the modal
    modal.style.display = "block";

    // Close button functionality
    const closeBtn = modal.querySelector('.close-btn-view');
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    // Click outside to close
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}