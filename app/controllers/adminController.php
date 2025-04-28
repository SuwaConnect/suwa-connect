<?php

class adminController extends Controller
{
    private $adminModel;
    private $userModel;
    private $pharmacyModel;
    private $labModel;
   

    public function __construct(){
        // if (session_status() === PHP_SESSION_NONE) {
        //     session_start();
        // }
        $this->adminModel = $this->model('m_doctor');
        $this->userModel = $this->model('userModel');
        $this->pharmacyModel = $this->model('pharmacyModel');
        $this->labModel = $this->model('m_lab');
    }

    public function index(){
        $this->view('admin/adminhome');
    }

    public function home(){
        $modelAdmin = $this->model('m_admin');
        $userCount = $modelAdmin->getTotalUsers();
        $activeUserCount = $modelAdmin->getTotalActiveUsers();
        $latestSignups = $modelAdmin->getLatestSignups();
        $totalAppointments = $modelAdmin->getTotalAppointments();
        $userGrowth = $modelAdmin->getUserGrowth();
        $latestNotifications = $modelAdmin->getLatestNotifications();
        $this->view('admin/adminhome',['userCount' => $userCount,
            'activeUserCount' => $activeUserCount,
            'latestSignups' => $latestSignups,
            'totalAppointments' => $totalAppointments,
            'userGrowth' => $userGrowth,
            'latestNotifications' => $latestNotifications
        ]);
    }

    public function appointments(){
        $appointmentModel = $this->model('m_admin');
        $totalAppointments = $appointmentModel->getTotalAppointments();
        $upcomingAppointments = $appointmentModel->getUpcomingAppointments();
        $completedAppointments = $appointmentModel->getCompletedAppointments();
        $canceledAppointments = $appointmentModel->getCanceledAppointments();
        $appointments = $appointmentModel->getAppointments();

        $this->view('admin/adminappointments',[
            'totalAppointments' => $totalAppointments,
            'upcomingAppointments' => $upcomingAppointments,
            'completedAppointments' => $completedAppointments,
            'canceledAppointments' => $canceledAppointments,
            'appointments' => $appointments
        ]);
    }

    public function notifications() {
        $modelAdmin = $this->model('m_admin');
        $notifications = $modelAdmin->getNotifications();

        // Pass notifications to the view
        $this->view('admin/adminnotifications', [
            'notifications' => $notifications
        ]);
    }

    public function revenue(){
        $this->view('admin/adminrevenue');
    }

    public function reports(){
        $this->view('admin/adminreports');
    }

    public function settings(){
        $this->view('admin/adminsettings');
    }

    public function signin(){
        $this->view('admin/admin signin');
    }

    public function support(){
        $this->view('admin/adminsupport');
    }

    public function usermanagement(){
        $this->view('admin/adminusermanagement');
    }

   

    public function pendingUsers(){

        $doctors = $this->adminModel->getPendingDoctors();
        $labs = $this->labModel->getPendingLabs();
        $pharmacies = $this->pharmacyModel->getPendingPharmacies();
        $data = [
            'doctors' => $doctors,
            'labs' => $labs,
            'pharmacies' => $pharmacies
        ];
        $this->view('admin/pendingUsers', $data);
    }

    public function approveDoctor() {
        header('Content-Type: application/json');
        
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'error' => 'Invalid request method']);
            return;
        }
    
        $doctor_id = $_POST['doctor_id'] ?? null;
        
        if (!$doctor_id) {
            echo json_encode(['success' => false, 'error' => 'Doctor ID is required']);
            return;
        }
    
        try {
            if($this->adminModel->markPendingDoctorAsApproved($doctor_id)) {
                $data = $this->adminModel->getDoctorByIdFromPendingDoctors($doctor_id);
                
                if (!$data) {
                    throw new Exception('Doctor data not found');
                }
    
                $userData = [
                    'email' => $data->email,
                    'password' => $data->password,
                    'role' => 'doctor',
                    'user_name' => $data->firstName  // Fixed the typo here
                ];
    
                $user_id = $this->userModel->createUser($userData);
    
                $approvedDoctorData = [
                    'user_id' => $user_id,
                    'firstName' => $data->firstName,
                    'lastName' => $data->lastName,
                    'slmc_no' => $data->slmc_no,
                    'contact_no' => $data->contact_no,
                    'medicalLicenseCopyName' => $data->medicalLicenseCopyName
                ];
    
                $this->adminModel->insertApprovedDoctor($approvedDoctorData);
                
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to approve doctor']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function rejectDoctor(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $doctor_id = $_POST['doctor_id'];
            if($this->adminModel->rejectDoctor($doctor_id)){
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to reject doctor']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        }
    }

    // public function pendingpharmacy(){
    //     $data = $this->pharmacyModel->getPendingPharmacies();
    //     $this->view('admin/pendingpharmacy', $data);
    // }

    public function approvePharmacy() {
        header('Content-Type: application/json');
        
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'error' => 'Invalid request method']);
            return;
        }
    
        $pharmacy_id = $_POST['pharmacy_id'] ?? null;
        
        if (!$pharmacy_id) {
            echo json_encode(['success' => false, 'error' => 'Pharmacy ID is required']);
            return;
        }
    
        try {
            if($this->pharmacyModel->markPendingPharmacyAsApproved($pharmacy_id)) {
                $data = $this->pharmacyModel->getPharmacyByIdFromPendingPharmacies($pharmacy_id);
                
                if (!$data) {
                    throw new Exception('Pharmacy data not found');
                }
    
                $userData = [
                    'email' => $data->email,
                    'password' => $data->password,
                    'role' => 'pharmacy',
                    'user_name' => $data->pharmacy_name  // Fixed the typo here
                ];
    
                $user_id = $this->userModel->createUser($userData);
    
                $approvedPharmacyData = [
                    'user_id' => $user_id,
                    'pharmacy_name' => $data->pharmacy_name,
                    'contact_person' => $data->contact_person,
                    'pharmacy_reg_no' => $data->pharmacy_reg_number,
                    'contact_no' => $data->contact_no,
                    'pharmacyLicenseCopyName' => $data->pharmacy_license_copy

                ];
    
                $this->pharmacyModel->insertApprovedPharmacy($approvedPharmacyData);
                
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to approve pharmacy']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function rejectPharmacy(){
        header('Content-Type: application/json');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $pharmacy_id = $_POST['pharmacy_id'];
            if($this->pharmacyModel->rejectPharmacy($pharmacy_id)){
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to reject pharmacy']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        }
    }


// public function pendingLabs(){
//     $data = $this->labModel->getPendingLabs();
//     $this->view('admin/pendingLab', $data);
// }

public function approveLab(){
    header('Content-Type: application/json');
        
    if($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        return;
    }

    $lab_id = $_POST['lab_id'] ?? null;
    
    if (!$lab_id) {
        echo json_encode(['success' => false, 'error' => 'Pharmacy ID is required']);
        return;
    }

    try {
        if($this->labModel->markPendingLabAsApproved($lab_id)) {
            $data = $this->labModel->getLabByIdFromPendingLabs($lab_id);
            
            if (!$data) {
                throw new Exception('hey Pharmacy data not found');
            }

            $userData = [
                'email' => $data->email,
                'password' => $data->password,
                'role' => 'lab',
                'user_name' => $data->name  // Fixed the typo here
            ];

            $user_id = $this->userModel->createUser($userData);

            $approvedLabData = [
                'user_id' => $user_id,
                'lab_name' => $data->name,
                'contact_person' => $data->contact_person,
                'lab_reg_no' => $data->lab_reg_number,
                'contact_no' => $data->contact_number,
                'lab_license_copy' => $data->lab_certificate

            ];

            $this->labModel->insertApprovedLab($approvedLabData);
            
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to approve pharmacy']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

public function rejectLab(){
    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $lab_id = $_POST['lab_id'];
        if($this->labModel->rejectLab($lab_id)){
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to reject pharmacy']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    }
}


public function getAllUsers() {
   
    try{
    $users = $this->userModel->getAllUsers();
    
    header('Content-Type: application/json');
    echo json_encode($users);}
    catch(Exception $e){
        echo json_encode(['error' => true, 'message' => 'An error occurred while fetching users']);
    }
}

// Search users
public function searchUsers() {
    $query = $_GET['query'] ?? '';
    
    // $userModel = $this->model('User');
    $users = $this->userModel->searchUsers($query);
    
    header('Content-Type: application/json');
    echo json_encode($users);
}

// Update user status (activate/deactivate)
public function updateUserStatus() {
    // Get raw POST data
    try {
        ini_set('display_errors', 0); // Set to 0 to not output errors directly
    error_reporting(E_ALL);
    
    // Log errors to file instead
    ini_set('log_errors', 1);
    ini_set('error_log', 'php_errors.log');
        $rawData = file_get_contents('php://input');
    
    // Log for debugging
    file_put_contents('debug.log', "Raw data: " . $rawData . "\n", FILE_APPEND);
    
    // Decode JSON data
    $data = json_decode($rawData, true);
    
    // Log decoded data
    file_put_contents('debug.log', "Decoded data: " . print_r($data, true) . "\n", FILE_APPEND);
    
    if (!isset($data['userId']) || !isset($data['status'])) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
        return;
    }
    
    $userId = $data['userId'];
    $status = $data['status'];
    
    // Initialize or use existing model
    
    $success = $this->userModel->updateUserStatus($userId, $status);
    
    header('Content-Type: application/json');
    echo json_encode(['success' => $success, 'message' => $success ? 'Status updated successfully' : 'Failed to update status']);
        
    } catch (Exception $e) {
        // Handle error if needed
        echo json_encode(['success' => false, 'message' => 'Failed to read input data']);
        return;
    }
    
}


} 