<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <title>Edit Promotion</title>
    <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/pharmacyaddpromo.css">
    
</head>
<body>
    <?php include 'pharmacyNavbar.php';?>
    <div class="container">
        <!-- Sidebar code remains same as pharmacypromotions.php -->
        <main class="content">
            <div class="form-container">
                <div class="form-header">
                    <h1 id="formTitle">Edit Promotion</h1>
                    <button class="back-btn" onclick="history.back()">
                        <i class="material-icons-round">arrow_back</i> Back
                    </button>
                </div>
                <form id="promotionForm" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="startDate">Start Date*</label>
                        <input type="date" id="startDate" name="startDate" value="<?=$promotion->starting_date ?? ''?>" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date*</label>
                        <input type="date" id="endDate" name="endDate" value="<?=$promotion->ending_date ?? ''?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description*</label>
                    <textarea id="description" name="description" required><?=$promotion->description ?? ''?></textarea>
                </div>

                <div class="form-group">
                    <label for="discountAmount">Discount Amount (%)*</label>
                    <input type="number" id="discountAmount" name="discountAmount" min="0" max="100" value="<?=$promotion->discount_amount ?? ''?>" required>
                </div>

                <div class="form-actions">
                    <button type="button" class="cancel-btn" onclick="history.back()">Cancel</button>
                    <button type="submit" class="save-btn">Update Promotion</button>
                </div>
            </form>
            </div>
        </main>
    </div>
    <script src="<?php echo URLROOT?>public/assets/js/pharmacyaddpromo.js"></script>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

</body>
</html>
