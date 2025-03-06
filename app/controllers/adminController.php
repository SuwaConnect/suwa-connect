<?php

class adminController extends Controller
{
    private $adminModel;
    private $userModel;
   

    public function __construct(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->adminModel = $this->model('m_doctor');
        $this->userModel = $this->model('userModel');
    }

    public function home(){
        $this->view('admin/adminhome');
    }

    public function appointments(){
        $this->view('admin/adminappointments');
    }

    public function notifications(){
        $this->view('admin/adminnotifications');
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

   

    public function pendingdoctors(){

        $data = $this->adminModel->getPendingDoctors();
        $this->view('admin/pendingdoctor', $data);



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

} 