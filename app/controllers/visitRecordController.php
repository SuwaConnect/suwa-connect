<?php

class visitRecordController extends controller{

private $visitRecordModel;
private $permissionModel;
private $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
private $maxFileSize = 5242880; 

public function __construct() 
{
    $this->visitRecordModel = $this->model('visitRecordModel');
    $this->permissionModel = $this->model('requestPermission');
}

public function prescription($patientId,$healthRecordId) {
    $data = [
        'patientId' => $patientId,
        'healthRecordId' => $healthRecordId,
        'searchResults' => [],
        'searchTerm' => '',
        'selectedMedicines' => $this->getSelectedMedicines()
    ];
    
    if(isset($_POST['search']) && !empty($_POST['search'])) {
        $data['searchTerm'] = $_POST['search'];
        $data['searchResults'] = $this->visitRecordModel->searchMedicines($data['searchTerm']);
    }

    if (isset($_POST['add_medicine'])) {
        $this->addMedicineToSelectedList($_POST['add_medicine']);
        header("Location: " . URLROOT . "visitRecordController/prescription/$patientId/$healthRecordId");
        exit(); // Prevent further execution
    }

    try{
    if(isset($_POST['add-prescription'])) {
        $selectedMedicines = $_POST['add-prescription'];
        $prescription = [
            'patient_id' => $patientId,
            'health_record_id' => $healthRecordId,
            'medicines' => $selectedMedicines
        ];
        $isPrescriptionAdded = $this->visitRecordModel->addPrescription($prescription);
        if (!$isPrescriptionAdded) {
           echo 'Failed to add prescription';
            exit();
        } else {
            //echo 'Prescription added successfully';
            redirect('permissionController/viewPatientProfile/'.$patientId);
            exit();
    }
          
    }}catch(Exception $e){
        echo $e->getMessage();
    }
  

    $this->view('doctor/visitRecord2', $data);
}

private function addMedicineToSelectedList($medicineId) {
    if (!$medicineId) {
        $_SESSION['error'] = 'Invalid medicine ID';
        return false;
    }
    
    $medicine = $this->visitRecordModel->getMedicineById($medicineId);
    
    if (!$medicine) {
        $_SESSION['error'] = 'Medicine not found';
        return false;
    }
    
    if (!isset($_SESSION['selectedMedicines'])) {
        $_SESSION['selectedMedicines'] = [];
    }

    foreach ($_SESSION['selectedMedicines'] as $selected) {
        if ($selected->id === $medicine->id) {
            $_SESSION['error'] = 'Medicine already selected';
            return false;
        }
    }
    
    $_SESSION['selectedMedicines'][] = $medicine;
    return true;
}

private function getSelectedMedicines() {
    return $_SESSION['selectedMedicines'] ?? [];
}

public function removeMedicineFromSelectedList($patientId,$healthRecordId) {
    if (isset($_POST['medicine_id'])) {
        $medicineId = $_POST['medicine_id']; // Ensure it's treated as the same type

        $_SESSION['selectedMedicines'] = array_filter($_SESSION['selectedMedicines'], function($med) use ($medicineId) {
            return $med->id != $medicineId; // Use != instead of !== for type flexibility
        });

        // Reset array keys to prevent indexing issues
        $_SESSION['selectedMedicines'] = array_values($_SESSION['selectedMedicines']);
    }

    header("Location: " . URLROOT . "visitRecordController/prescription/$patientId/$healthRecordId");
    exit();
}


private function isAlreadySelected($medicineId, $selectedMedicines) {
    foreach($selectedMedicines as $medicine) {
        if($medicine['id'] == $medicineId) return true;
    }
    return false;
}

public function addHealthRecord($patientId) {
    
    // First verify permissions again
    //$patient_id = $this->permissionModel->getPatientById($patientId);
    $doctorId = $this->permissionModel->getDoctorIdByUserId($_SESSION['user_id']);
    $hasAccess = $this->permissionModel->checkAccessPermission($doctorId, $patientId);

    
    if (!$hasAccess) {
        echo 'Access denied...';
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Display the form
        $patient = $this->permissionModel->getPatientByPatientId($patientId);
        $data = [
            'patientId' => $patient->patient_id,
        ];
        
        $this->view('doctor/visitrecord', $data);
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {

            //$patient_id = $_POST['patient_id'];
            //$visitDate = $_POST['visitDate'];
            $chiefComplaint = $_POST['chiefComplaint'];
            $sistolic = $_POST['sistolic'];
            $diastolic = $_POST['diastolic'];
            $temperature = $_POST['temperature'];
            $bloodSugar = $_POST['bloodSugar'];
            $cholesterol = $_POST['cholesterol'];
            $weight = $_POST['weight'];
            $diagnosis = $_POST['diagnosis'];
            $additional_notes = $_POST['additional_notes'];
        
            // Process initial health record
            $initialDescription = [
                'doctor_id' => $doctorId,
                'patient_id' => $patientId,
                'chief_complaint' => $chiefComplaint,
                'diagnosis' => $diagnosis,
                'additional_notes' => $additional_notes
            ];

            $healthRecordId = $this->visitRecordModel->addInitialHealthRecord($initialDescription);
            if (!$healthRecordId) {
                throw new Exception('Failed to add health record');
            }

            // Process vital signs
            $vitalSigns = [
                'record_id' => $healthRecordId,
                'blood_pressure' => [
                    'sistolic' => $sistolic,
                    'diastolic' => $diastolic
                ],
                'temperature' => $temperature,
                'blood_sugar' => $bloodSugar,
                'cholesterol' => $cholesterol,
                'weight' => $weight
            ];

            $vitalSignsAdded = $this->visitRecordModel->addVitalSigns($vitalSigns);
            if (!$vitalSignsAdded) {
                throw new Exception('Failed to add vital signs');
            }

            // Redirect to reports page
            redirect("visitrecordcontroller/submitReports/$patientId/$healthRecordId");

        } catch (Exception $e) {
           echo $e->getMessage();
            //redirect("doctorController/addHealthRecord/$patientId");
        }
    }
}




public function submitReports($patientId,$healthRecordId) {

    

    // First check permissions
    $doctorId = $this->permissionModel->getDoctorIdByUserId($_SESSION['user_id']);
    //$hasAccess = $this->permissionModel->checkAccessPermission($doctorId, $healthRecordId);
    
    // if (!$hasAccess) {
    //     redirect('pages/accessDenied');
    //     return;
    // }
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Display the form for adding reports
        $data = [
            'patientId' => $patientId,
            'health_record_id' => $healthRecordId
        ];
        
        $this->view('doctor/addReport', $data);
        return;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Process the form submission
        if (!isset($_POST['report_title']) || !is_array($_POST['report_title'])) {
            //flash('report_error', 'No report data submitted', 'alert alert-danger');
            redirect("visitRecordController/submitReports/$patientId/$healthRecordId");
            return;
        }
        
        // Start database transaction
        //$this->visitRecordModel->beginTransaction();
        
        try {
            $reportCount = count($_POST['report_title']);
            $successCount = 0;
            $errors = [];
            
            // Process each report
            for ($i = 0; $i < $reportCount; $i++) {
                $reportTitle = trim($_POST['report_title'][$i]);
                $reportType = trim($_POST['report_type'][$i]);
                $reportDate = $_POST['report_date'][$i];
                $findings = trim($_POST['findings'][$i]);
                //$recommendations = trim($_POST['recommendations'][$i]);
                
                // Basic validation
                if (empty($reportTitle) || empty($reportType) || empty($reportDate)) {
                    $errors[] = "Required fields missing for report #" . ($i + 1);
                    continue;
                }
                
                // Handle file upload
                $file = $_FILES['report_file'];
                
                if (!isset($file['tmp_name'][$i]) || empty($file['tmp_name'][$i])) {
                    $errors[] = "No file uploaded for report #" . ($i + 1);
                    continue;
                }
                
                $uploadedFile = $file['tmp_name'][$i];
                $originalFilename = $file['name'][$i];
                $fileSize = $file['size'][$i];
                $fileError = $file['error'][$i];
                
                // Check file size
                if ($fileSize > $this->maxFileSize) {
                    $errors[] = "File for report #" . ($i + 1) . " exceeds maximum size of 5MB";
                    continue;
                }
                
                // Check file extension
                $fileExt = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));
                if (!in_array($fileExt, $this->allowedExtensions)) {
                    $errors[] = "Invalid file type for report #" . ($i + 1) . ". Allowed types: PDF, JPG, PNG";
                    continue;
                }
                
                // Check for upload errors
                if ($fileError !== UPLOAD_ERR_OK) {
                    $errors[] = "Upload error for report #" . ($i + 1) . ": " . $this->getFileUploadError($fileError);
                    continue;
                }
                
                // Create folder structure if doesn't exist
                $baseDir = __DIR__.'/../../public/uploads/reports/';
                $typeDir = $baseDir . strtolower(str_replace(' ', '-', $reportType)) . '/';
                
                if (!file_exists($baseDir)) {
                    mkdir($baseDir, 0755, true);
                }
                
                if (!file_exists($typeDir)) {
                    mkdir($typeDir, 0755, true);
                }
                
                // Generate unique filename
                $newFilename = md5(time() . rand(1000, 9999) . $originalFilename) . '.' . $fileExt;
                $filePath = $typeDir . $newFilename;
                
                // Move the file
                if (!move_uploaded_file($uploadedFile, $filePath)) {
                    $errors[] = "Failed to save file for report #" . ($i + 1);
                    continue;
                }
                
                // Save to database
                $reportData = [
                    'health_record_id' => $healthRecordId,
                    'title' => $reportTitle,
                    'type' => $reportType,
                    'report_date' => $reportDate,
                    'findings' => $findings,
                    //'recommendations' => $recommendations,
                    'file_path' => $filePath,
                    'original_filename' => $originalFilename
                ];
                
                $reportId = $this->visitRecordModel->addReport($reportData);
                
                if (!$reportId) {
                    $errors[] = "Database error saving report #" . ($i + 1);
                    
                    // Delete uploaded file if database save fails
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    throw new Exception('Failed to save report');
                    continue;
                }
                
                $successCount++;
            }
            
            // Decide whether to commit or rollback
            if ($successCount === 0) {
                // All reports failed
                //$this->visitRecordModel->rollback();
                //flash('report_error', 'Failed to save reports: ' . implode('; ', $errors), 'alert alert-danger');
                //redirect("visitrecordController/submitReports/$patientId/$healthRecordId");
                echo 'all reports failed';
                return;
            } else if ($successCount < $reportCount) {
                // Some reports failed, but some succeeded
                //$this->visitRecordModel->commit();
                //flash('report_warning', "Saved $successCount of $reportCount reports. Errors: " . implode('; ', $errors), 'alert alert-warning');
               // redirect("visitRecordController/viewHealthRecord/$healthRecordId");
               echo 'not every report saved';
                return;
            } else {
                // All reports succeeded
               // $this->visitRecordModel->commit();
                //flash('report_success', "Successfully saved all $reportCount reports", 'alert alert-success');
                redirect("visitrecordcontroller/prescription/$patientId/$healthRecordId");
                return;
            }
            
        } catch (Exception $e) {
            //$this->visitRecordModel->rollback();
            //flash('report_error', 'An error occurred: ' . $e->getMessage(), 'alert alert-danger');
            //redirect("reportController/submitReports/$patientId/$healthRecordId");
            echo $e->getMessage();
            // var_dump($errors);
            return;
        }
    }
}


private function getFileUploadError($code) {
    switch ($code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'A PHP extension stopped the file upload';
        default:
            return 'Unknown upload error';
    }
}

public function viewpatientprofile($patientId){
    $patient = $this->permissionModel->getPatientByPatientId($patientId);
    $data = [
        'patient' => $patient
    ];
    
    $this->view('doctor/patientProfile', $data);


}

public function getHealthRecords($patient_id) {
    $search = $_GET['search'] ?? '';
    $records = $this->visitRecordModel->getAllHealthRecords($patient_id, $search);
    
    header('Content-Type: application/json');
    echo json_encode($records);
    exit; 
}

public function viewHealthRecord($healthRecordId) {
    
    try {
        $healthRecord = $this->visitRecordModel->getHealthRecordById($healthRecordId);
        if (!$healthRecord) {
            throw new Exception('Health record not found');
        }
        
        //$reports = $this->visitRecordModel->getReportsByHealthRecordId($healthRecordId);
        
        $data = [
            'healthRecord' => $healthRecord,
            'vitalSigns' => $this->visitRecordModel->getVitalSignsByRecordId($healthRecordId),
            'reports' => $this->visitRecordModel->getReportsByRecordId($healthRecordId),
            'prescription' => $this->visitRecordModel->getPrescriptionsByRecordId($healthRecordId)
        ];
        
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        return;
    }
    
     // Check permissions again
    
    $this->view('doctor/viewHealthRecord',$data);
    

}
}