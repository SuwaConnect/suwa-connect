<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/assets/css/admin/pendingDoctorapproval.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <title>pending labs</title>

    </head>
    <body>

    <?php include 'adminNavbar.php'?>

    <div class="main-content">
        
   
<div class="table">
            <h2>Pending Doctor Approvals</h2>
            <?php if (!empty($data)): ?>
    <table >
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>license no:</th>
            <th>contact no:</th>
            <th>License</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($data as $lab): ?>
            <tr>
            <td><?php echo htmlspecialchars($lab->name); ?></td>
                <td><?php echo htmlspecialchars($lab->email); ?></td>
                <td><?php echo htmlspecialchars($lab->lab_reg_number); ?></td>
                <td><?php echo htmlspecialchars($lab->id); ?></td>
                <td>
                    <a href="<?php echo URLROOT.'uploads/medical_licenses/lab_licenses/'.$lab->lab_certificate;?>" target="_blank">
                        View License
                    </a>
                
                <td>
                    <button id="approve-btn" onclick="approveLab(<?php echo $lab->id; ?>)">Approve</button>
                    <button id="reject-btn" onclick="rejectLab(<?php echo $lab->id; ?>)">Reject</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No pending doctors to approve</p>
<?php endif; ?>


</div>

</div>

<script>

    const URLROOT = 'http://localhost/newFramework';

    function approveLab(labId) {
    if (confirm('Are you sure you want to approve this lab?')) {
        console.log('Starting approval process fo $lab:', labId);
        
        fetch(`${URLROOT}/adminController/approveLab`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'lab_id=' + labId
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
                    alert('lab approved successfully!');
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

function rejectLab(labId) {
    if (confirm('Are you sure you want to reject this lab?')) {
        fetch(`${URLROOT}/admincontroller/rejectLab`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'lab_id=' + labId
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
<script src="<?php echo URLROOT?>public/assets/js/navbar.js"></script>
</body>
</html>