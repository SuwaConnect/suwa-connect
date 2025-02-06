<?php 

class permissionController extends controller{
    private $permissionModel;
    
    public function __construct() {
        $this->permissionModel = $this->model('requestPermission');
    }
    
    public function requestAccess() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $doctorId = $_SESSION['user_id']; // Assuming doctor's ID is stored in session
            $patientId = $_POST['patient_id'];
           
            
            $result = $this->permissionModel->createRequest($doctorId, $patientId);
            
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }
    
    public function checkPermission() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $doctorId = $_SESSION['doctor_id'];
            $patientId = $data['patient_id'];
            
            $hasPermission = $this->permissionModel->checkPermission($doctorId, $patientId);
            
            header('Content-Type: application/json');
            echo json_encode(['hasPermission' => $hasPermission]);
            exit;
        }
    }

    public function getPendingRequests() {
        $requests = $this->permissionModel->getPendingRequests(1);
        
        header('Content-Type: application/json');
        echo json_encode($requests);
        exit;
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $requestId = $data['request_id'];
            $status = $data['status'];
            
            $result = $this->permissionModel->updateRequest($requestId, $status);
            
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }

}