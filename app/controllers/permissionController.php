<?php 

class permissionController extends controller{
    private $permissionModel;
    
    public function __construct() {
        $this->permissionModel = $this->model('requestPermission');
    }
    
    // public function requestAccess() {
    //     try {
    //         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //             // Get JSON data from request body
    //             $jsonData = json_decode(file_get_contents('php://input'), true);
                
    //             $doctorId = $this->permissionModel->getDoctorIdByUserId($_SESSION['user_id']);
    //             if (!$doctorId) {
    //                 throw new Exception('Could not find doctor ID');
    //             }
                
    //             if (!isset($jsonData['patient_id'])) {
    //                 throw new Exception('Patient ID is required');
    //             }
    //             $patientId = $jsonData['patient_id'];
                
    //             $result = $this->permissionModel->createRequest($doctorId, $patientId);
                
    //             // Set appropriate HTTP status code based on result
    //             // if ($result['status'] === 'error') {
    //             //     http_response_code(400);
    //             // }
                
    //             // Return JSON response
    //             header('Content-Type: application/json');
    //             echo json_encode($result);
    //             exit;
    //         }
    //     } catch (Exception $e) {
    //         //http_response_code(400);
    //         header('Content-Type: application/json');
    //         echo json_encode([
    //             'status' => 'error',
    //             'message' => $e->getMessage()
    //         ]);
    //         exit;
    //     }
    // }
    
    // public function checkPermission() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $data = json_decode(file_get_contents('php://input'), true);
    //         $doctorId = $_SESSION['doctor_id'];
    //         $patientId = $data['patient_id'];
            
    //         $hasPermission = $this->permissionModel->checkPermission($doctorId, $patientId);
            
    //         header('Content-Type: application/json');
    //         echo json_encode(['hasPermission' => $hasPermission]);
    //         exit;
    //     }
    // }

    // public function getPendingRequests() {
    //     $requests = $this->permissionModel->getPendingRequests(1);
        
    //     header('Content-Type: application/json');
    //     echo json_encode($requests);
    //     exit;
    // }

    
    // public function handleRequest() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $data = json_decode(file_get_contents('php://input'), true);
    //         $requestId = $data['request_id'];
    //         $status = $data['status'];
            
    //         $result = $this->permissionModel->updateRequest($requestId, $status);
            
    //         header('Content-Type: application/json');
    //         echo json_encode($result);
    //         exit;
    //     }
    // }



public function sendAccessRequest(){
    try{
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $doctor_id = $this->permissionModel->getDoctorIdByUserId($_SESSION['user_id']);
            if(!$doctor_id){
                throw new Exception('Could not find doctor ID');
            }
            $patient_id = $_POST['patient_id'];
            $result = $this->permissionModel->sendAccessRequest($doctor_id, $patient_id);
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
        // Redirect to error page or show access denied
        redirect('pages/accessDenied');
        return;
    }
    
    // If has access, get health records
    //$healthRecords = $this->permissionModel->getHealthRecords($patientId) ;
    
    $data = [
        'patient' => $this->permissionModel->getPatientById($patientId),
        //'healthRecords' => $healthRecords
    ];
    
    $this->view('doctor/patientProfile', $data);
}

    
}