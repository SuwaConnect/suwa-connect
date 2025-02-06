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
        }   

        public function approvedoctor() {
            header('Content-Type: application/json');
            
            // Debug logging
            error_log("approvedoctor function started");
        
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                error_log("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
                echo json_encode(['success' => false, 'error' => 'Invalid request method']);
                return;
            }
        
            try {
                if (!isset($_POST['doctor_id'])) {
                    error_log("No doctor_id provided in POST data");
                    echo json_encode(['success' => false, 'error' => 'No doctor ID provided']);
                    return;
                }
        
                $doctor_id = $_POST['doctor_id'];
                error_log("Processing doctor_id: " . $doctor_id);
                
                // Get doctor info
                $doctorInfo = $this->adminModel->getDoctorByIdFromPendingDoctors($doctor_id);
                error_log("Doctor info retrieved: " . print_r($doctorInfo, true));
                
                if (!$doctorInfo) {
                    error_log("Doctor not found in pending applications");
                    throw new Exception('Doctor not found in pending applications');
                }
        
                // Debug log before user creation
                error_log("About to create user account");
                
                // Create user account
                $user_data = [
                    'email' => $doctorInfo->email,
                    'password' => $doctorInfo->password,
                    'role' => 'doctor',
                    'user_name' => $doctorInfo->firstName 
                ];
                error_log("User data prepared: " . print_r($user_data, true));
                
                $user_id = $this->userModel->createUser($user_data);
                error_log("User created with ID: " . $user_id);
        
                if (!$user_id) {
                    error_log("Failed to create user account");
                    throw new Exception('Failed to create user account');
                }
                
                // Debug log before doctor data insertion
                error_log("About to insert approved doctor");
                
                $doctor_data = [
                    'user_id' => $user_id,
                    'firstName' => $doctorInfo->firstName,
                    'lastName' => $doctorInfo->lastName,
                    'contact_no' => $doctorInfo->contact_no,
                    'slmc_no' => $doctorInfo->slmc_no,
                    'medicalLicenseCopyName' => $doctorInfo->medicalLicenseCopyName
                ];
                error_log("Doctor data prepared: " . print_r($doctor_data, true));
                
                $new_doctor_id = $this->adminModel->insertApprovedDoctor($doctor_data);
                error_log("Doctor inserted with ID: " . $new_doctor_id);
        
                if (!$new_doctor_id) {
                    error_log("Failed to create approved doctor record");
                    throw new Exception('Failed to create approved doctor record');
                }
                
                if (!$this->adminModel->markPendingDoctorAsApproved($doctor_id)) {
                    error_log("Failed to update pending doctor status");
                    throw new Exception('Failed to update pending doctor status');
                }
                
                $response = [
                    'success' => true,
                    'user_id' => $user_id,
                    'doctor_id' => $new_doctor_id
                ];
                error_log("Sending success response: " . print_r($response, true));
                echo json_encode($response);
                
            } catch (Exception $e) {
                error_log("Error in approvedoctor: " . $e->getMessage());
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
        }
        

    public function rejectDoctor() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $result = $this->adminModel->rejectDoctor($_POST['doctor_id']);
        echo json_encode(['success' => $result]);
        }
        }

    }