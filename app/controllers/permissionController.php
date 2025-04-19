<?php 

class permissionController extends controller{
    private $permissionModel;
    
    public function __construct() {
        $this->permissionModel = $this->model('requestPermission');
    }
    

    public function getPendingRequests() {
        //$this->view('patient/confirmRequest');
        $user_id = $_SESSION['user_id'];

        $patient_id = $this->permissionModel->getPatientById($user_id)->patient_id;
        $requests = $this->permissionModel->getPendingRequests($patient_id);
        
        header('Content-Type: application/json');
        echo json_encode($requests);
        exit;
    }

    
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestId = $_POST['request_id'];
            $status = $_POST['status'];
            
            $result = $this->permissionModel->updateRequest($requestId, $status);
            
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }



public function sendAccessRequest(){
    try{
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $doctor_id = $this->permissionModel->getDoctorIdByUserId($_SESSION['user_id']);
            if(!$doctor_id){
                throw new Exception('Could not find doctor ID');
            }
            $patient_id = $_POST['patient_id'];
            $result = $this->permissionModel->sendAccessRequest($doctor_id, $patient_id);

            // $notificationHelper = notificationHelper::getInstance();
            // $doctor = $this->permissionModel->getDoctorById($_SESSION['user_id']);
            // $notificationHelper->profileAccessRequest(
                
            //     $this->permissionModel->getPatientById($patient_id)->user_id,
            //     $doctor->firstName . ' ' . $doctor->lastName
               
            // );
            return $result;
        }
    } catch (Exception $e){
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

public function checkAccess($patientId) {
    try {
        $doctorId = $this->permissionModel->getDoctorIdByUserId($_SESSION['user_id']);
        $hasAccess = $this->permissionModel->checkAccessPermission($doctorId, $patientId);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'hasAccess' => $hasAccess]);
        
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        
    }
}

public function viewPatientProfile($patientId) {
    // Double-check permissions server-side
    $doctorId = $this->permissionModel->getDoctorIdByUserId($_SESSION['user_id']);
    $hasAccess = $this->permissionModel->checkAccessPermission($doctorId, $patientId);
    
    if (!$hasAccess) {
        echo "Access Denied";
        return;
    }
    
    $data = [
        'patient' => $this->permissionModel->getPatientByPatientId($patientId)
    ];
    
    $this->view('doctor/patientProfile', $data);
}

    
}