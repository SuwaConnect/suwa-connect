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
        console.log('Approving doctor:', doctorId);
        
        fetch(`${URLROOT}/adminController/approvedoctor`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'doctor_id=' + doctorId
        })
        .then(async response => {
            // Log the raw response
            const text = await response.text();
            console.log('Raw response:', text);
            
            try {
                // Try to parse as JSON
                const data = JSON.parse(text);
                if (data.success) {
                    location.reload();
                } else {
                    console.error('Approval failed:', data.error);
                    alert('Approval failed: ' + (data.error || 'Unknown error'));
                }
            } catch (e) {
                console.error('Failed to parse response as JSON:', e);
                console.error('Raw response was:', text);
                alert('Error processing response from server');
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            alert('Network error occurred');
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