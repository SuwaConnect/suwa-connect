document.getElementById("add-report-btn").addEventListener("click", function() {
    document.getElementById("add-report-modal").style.display = "flex";
});

document.getElementById("close-modal").addEventListener("click", function() {
    document.getElementById("add-report-modal").style.display = "none";
});

document.getElementById("add-report-form").addEventListener("submit", function(event) {
    event.preventDefault();

    const reportName = document.getElementById("reportName").value;
    const reportType = document.getElementById("reportType").value;
    const reportDate = document.getElementById("reportDate").value;
    const lab = document.getElementById("lab").value;

    const row = document.createElement("tr");

    row.innerHTML = `
        <td>${reportName}</td>
        <td>${reportType}</td>
        <td>${reportDate}</td>
        <td>${lab}</td>
    `;

    document.getElementById("reports-table").appendChild(row);
    document.getElementById("add-report-modal").style.display = "none";
});

document.getElementById("skip-btn").addEventListener("click", function() {
    alert("Profile is incomplete. Please complete it when you have the chance.");
});

// Function to show dropdown list when user types
function filterLabs() {
    const input = document.getElementById('lab-search');
    const filter = input.value.toLowerCase();
    const dropdown = document.querySelector('.dropdown');
    const items = dropdown.getElementsByClassName('dropdown-item');

    let hasMatch = false;

    // Loop through all items in the dropdown list and hide those that don't match the search input
    for (let i = 0; i < items.length; i++) {
        const item = items[i];
        const text = item.textContent || item.innerText;
        if (text.toLowerCase().indexOf(filter) > -1) {
            item.style.display = "block";
            hasMatch = true;
        } else {
            item.style.display = "none";
        }
    }

    // Show or hide the dropdown based on whether there's a match
    if (hasMatch) {
        dropdown.classList.add('show');
    } else {
        dropdown.classList.remove('show');
    }
}

// Add event listener to close the dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.querySelector('.dropdown');
    if (!dropdown.contains(event.target)) {
        dropdown.classList.remove('show');
    }
});

// Add event listener to set the selected lab when clicked
document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', function() {
        const labSearch = document.getElementById('lab-search');
        labSearch.value = this.textContent; // Set the selected value in the input
        document.querySelector('.dropdown').classList.remove('show'); // Close dropdown
    });
});

