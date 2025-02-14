<html>
    <head></head>
    <body>
        
   
<h2>Pending Doctor Approvals</h2>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>License</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        foreach ($data as $doctor): ?>
        <tr>
            <td><?php echo htmlspecialchars($doctor->firstName); ?></td>
            <td><?php echo htmlspecialchars($doctor->email); ?></td>
            <td>
                <a href="../../../uploads/<?php echo ($doctor->medicalLicenseCopyName); ?>" target="_blank">
                    View License
                </a>
            </td>
            <td>
                <button onclick="approveDoctor(<?php echo $doctor->doctor_id; ?>)">Approve</button>
                <button onclick="rejectDoctor(<?php echo $doctor->doctor_id; ?>)">Reject</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>

    const URLROOT = 'http://localhost/newFramework';

    function approveDoctor(doctorId) {
    if (confirm('Are you sure you want to approve this doctor?')) {
        console.log('Starting approval process for doctor:', doctorId);
        
        fetch(`${URLROOT}/adminController/approvedoctor`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'doctor_id=' + doctorId
        })
        .then(async response => {
            console.log('Response status:', response.status);
            console.log('Response headers:', [...response.headers.entries()]);
            
            const text = await response.text();
            console.log('Raw response text:', text);
            
            if (!text) {
                throw new Error('Empty response from server');
            }
            
            try {
                const data = JSON.parse(text);
                console.log('Parsed response data:', data);
                
                if (data.success) {
                    alert('Doctor approved successfully!');
                    location.reload();
                } else {
                    throw new Error(data.error || 'Unknown error occurred');
                }
            } catch (e) {
                console.error('JSON Parse error:', e);
                console.error('Response that failed to parse:', text);
                throw new Error(`Failed to parse server response: ${e.message}`);
            }
        })
        .catch(error => {
            console.error('Error in approval process:', error);
            alert(`Error: ${error.message}`);
        });
    }
}

function rejectDoctor(doctorId) {
    if (confirm('Are you sure you want to reject this doctor?')) {
        fetch(`${URLROOT}/admincontroller/rejectdoctor`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'doctor_id=' + doctorId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}
</script>
</body>
</html>