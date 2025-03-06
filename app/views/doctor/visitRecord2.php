<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/visitRecord2.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <title>Visit Record</title>
</head>
<body>
        
<?php include 'navbarbhagya.php'; ?>

<div class="main-content">
    <div class="form-group">
        <h1>Add prescription</h1>

        <!-- Search Form -->
        <form method="POST" action="<?php echo URLROOT;?>visitRecordController/prescription/<?php echo $data['patientId']?>/<?php echo $data['healthRecordId']?>" class="search-box">
            <input type="text" name="search" class="form-control" placeholder="Search medicines...">
            <button type="submit" class="submit-button">Search</button>
        </form>

        <!-- Search Results -->
        <?php if (!empty($data['searchResults'])): ?>
            <div class="search-results">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Medicine Name</th>
                            <th>Dosage</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['searchResults'] as $medicine): ?>
                            <tr>
                                <td><?php echo $medicine->name; ?></td>
                                <td><?php echo $medicine->dosage; ?></td>
                                <td>
                                    <form method="POST" action="<?php echo URLROOT;?>visitRecordController/prescription/<?php echo $data['patientId']?>/<?php echo $data['healthRecordId']?>">
                                        <input type="hidden" name="add_medicine" value="<?php echo $medicine->id; ?>">
                                        <button type="submit" name="add_medicine-btn" id="add-medicine-btn">Add</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div class="selected-medicines">
            <h2>Selected Medicines</h2>
            <?php if (empty($data['selectedMedicines'])): ?>
                <p>No medicines selected</p>
            <?php else: ?>
                <table  class="selected-medicines-table">
                    <thead>
                        <tr>
                            <th>Medicine Name</th>
                            <th>Dosage</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['selectedMedicines'] as $medicine): ?>
                            <tr>
                                <td><?php echo $medicine->name; ?></td>
                                <td><?php echo $medicine->dosage; ?></td>
                                <td>
                                    <form method="POST" action="<?php echo URLROOT; ?>visitRecordController/removeMedicineFromSelectedList/<?php echo $data['patientId']?>/<?php echo $data['healthRecordId']?>" style="display: inline;">
                                        <input type="hidden" name="medicine_id" value="<?php echo $medicine->id; ?>">
                                        <button type="submit" class="remove-button">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>


        <?php if (!empty($data['selectedMedicines'])): ?>
            <form action="<?php echo URLROOT; ?>visitrecordcontroller/prescription/<?php echo $data['patientId']; ?>/<?php echo $data['healthRecordId']; ?>" method="POST">
                <div class="add-prescription">
                    <?php foreach ($data['selectedMedicines'] as $medicine): ?>
                        <input type="hidden" name="add-prescription[]" value="<?php echo $medicine->id; ?>">
                    <?php endforeach; ?>
                    <button type="submit" class="submit-button">Add Prescription</button>
                </div> 
            </form>
        <?php else: ?>
            <form action="<?php echo URLROOT; ?>visitRecordController/viewpatientProfile/<?php echo $data['patientId']; ?>" method="post">
                <div class="add-prescription">
                    <button type="submit" class="submit-button" >Add Health Record</button>
                </div> 
            </form>
        <?php endif; ?>
                    
    </div>
        

</div> 
 

<script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

</body>
</html>