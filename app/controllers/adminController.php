<?php

class adminController extends Controller
{
    private $adminModel;
    private $userModel;

public function __construct(){
    $this->adminModel = $this->model('m_doctor');
    $this->userModel = $this->model('userModel');

}

    public function adminappointments(){
            $this->view('admin/adminappointments');
        }

    public function adminUserManagement(){
            $this->view('admin/adminusermanagement');
        }

    public function adminNotifications(){
            $this->view('admin/adminnotifications');
        }    

    public function adminReports(){
            $this->view('admin/adminreports');
        }

    public function adminRevenue(){
            $this->view('admin/adminrevenue');
        }

    public function adminSettings(){
            $this->view('admin/adminsettings');
        }

    public function adminSignIn(){
            $this->view('admin/adminsignin');
        }

    public function adminsupport(){
            $this->view('admin/adminsupport');
        }

    public function adminhome(){
            $this->view('admin/adminhome');
        }

    public function pendingDoctors(){
            $data = $this->adminModel->getPendingDoctors();
            $this->view('admin/pendingDoctor',$data);
            #var_dump($data);
        }   

        public function approvedoctor() { 
            
            header('Content-Type: application/json');
        
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                echo json_encode(['success' => false, 'error' => 'Invalid request method']);
                return;
            }
    
            try {
                if (!isset($_POST['doctor_id'])) {
                    echo json_encode(['success' => false, 'error' => 'No doctor ID provided']);
                    return;
                }
    
                $doctor_id = $_POST['doctor_id'];
                
                // 1. Get doctor info from pending doctors
                $doctorInfo = $this->adminModel->getDoctorById($doctor_id);
                if (!$doctorInfo) {
                    throw new Exception('Doctor not found in pending applications');
                }
                
                // 2. Create user account first
                $user_data = [
                    'email' => $doctorInfo->email,
                    'password' => $doctorInfo->password, // Assuming it's already hashed
                    'role' => 'doctor'
                ];
                $user_id = $this->adminModel->createUser($user_data);
                if (!$user_id) {
                    throw new Exception('Failed to create user account');
                }
                
                // 3. Insert into approved_doctors with user_id
                $doctor_data = [
                    'user_id' => $user_id,
                    'firstName' => $doctorInfo->name,
                    'lastName' => $doctorInfo->lastName,
                    'contact_no' => $doctorInfo->contact_no,
                    'slmc_no' => $doctorInfo->slmc_no,
                    'medicalLicenseCopyName' => $doctorInfo->medicalLicenseCopyName

                ];
                
                $new_doctor_id = $this->adminModel->insertApprovedDoctor($doctor_data);
                if (!$new_doctor_id) {
                    throw new Exception('Failed to create approved doctor record');
                }
                
                // 4. Mark as approved in pending_doctors
                if (!$this->adminModel->markPendingDoctorAsApproved($doctor_id)) {
                    throw new Exception('Failed to update pending doctor status');
                }
                
                echo json_encode([
                    'success' => true,
                    'user_id' => $user_id,
                    'doctor_id' => $new_doctor_id
                ]);
                
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
            exit;
        }
        

    public function rejectDoctor() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $result = $this->adminModel->rejectDoctor($_POST['doctor_id']);
        echo json_encode(['success' => $result]);
        }
        }

    }