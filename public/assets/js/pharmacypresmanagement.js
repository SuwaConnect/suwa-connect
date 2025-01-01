// JavaScript for toggling the sidebar
document.getElementById("toggleSidebar").addEventListener("click", function () {
    document.querySelector(".sidebar").classList.toggle("collapsed");
    
    // Rotate the chevron icon based on sidebar state
    const toggleIcon = document.querySelector('.toggle-btn i');
    toggleIcon.textContent = toggleIcon.textContent === 'chevron_left' ? 'chevron_right' : 'chevron_left';
});

document.addEventListener('DOMContentLoaded', function() {
    const endSessionBtn = document.getElementById('endSessionBtn');

    endSessionBtn.addEventListener('click', function() {
        // Get the table data
        const tableData = [];
        const rows = document.querySelectorAll('table tbody tr');
        rows.forEach(row => {
            const rowData = [];
            row.querySelectorAll('td').forEach((cell, index) => {
                if (index === 4 || index === 7) { // Checkboxes for Reject and Delivered
                    rowData.push(cell.querySelector('input').checked);
                } else {
                    rowData.push(cell.innerText);
                }
            });
            tableData.push(rowData);
        });

        // Store the data in localStorage (or send it to the server)
        localStorage.setItem('prescriptionData', JSON.stringify(tableData));

        // Redirect to the Prescription History page
        window.location.href = 'prescriptionhistory.html';
    });
});