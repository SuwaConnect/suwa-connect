document.addEventListener('DOMContentLoaded', () => {
    // Display current date
    const currentDate = new Date().toLocaleDateString();
    document.getElementById('current-date').innerText = `Date: ${currentDate}`;

    // Sample data
    const reports = [
        { name: 'Blood Test Report', type: 'Blood Test', date: '2024-10-15' },
        { name: 'X-Ray Scan', type: 'X-Ray', date: '2024-10-10'},
        { name: 'MRI Report', type: 'MRI', date: '2024-09-25' },
    ];

    // Populate reports table
    const reportsTable = document.getElementById('reports-table');
    const populateTable = (data) => {
        reportsTable.innerHTML = ''; // Clear table
        data.forEach(report => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${report.name}</td>
                <td>${report.type}</td>
                <td>${report.date}</td>
                <td>
                    <button class="view-btn">View</button>
                    <button class="download-btn">Download</button>
                </td>
            `;
            reportsTable.appendChild(row);
        });
    };

    populateTable(reports);

    // Modal actions
    const requestScanBtn = document.getElementById('request-scan');
    const uploadReportBtn = document.getElementById('upload-report');
    const scanModal = document.getElementById('request-scan-modal');
    const uploadModal = document.getElementById('upload-report-modal');
    const closeScanModal = document.getElementById('close-scan-modal');
    const closeUploadModal = document.getElementById('close-upload-modal');

    requestScanBtn.addEventListener('click', () => {
        scanModal.style.display = 'block';
    });

    uploadReportBtn.addEventListener('click', () => {
        uploadModal.style.display = 'block';
    });

    closeScanModal.addEventListener('click', () => {
        scanModal.style.display = 'none';
    });

    closeUploadModal.addEventListener('click', () => {
        uploadModal.style.display = 'none';
    });

    // Close modals when clicked outside
    window.addEventListener('click', (event) => {
        if (event.target === scanModal) {
            scanModal.style.display = 'none';
        } else if (event.target === uploadModal) {
            uploadModal.style.display = 'none';
        }
    });
});
