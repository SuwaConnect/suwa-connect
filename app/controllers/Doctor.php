<?php

class Doctor extends Controller
{
    private $doctorModel;
    private $userModel;

    public function __construct(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->doctorModel = $this->model('m_doctor');
    }

    public function home(){

        $data = [
            // 'new_appointments' => $this->doctorModel->getCountOfNewappointments($_SESSION['user_id']),
            // 'appointments' => $this->doctorModel->getAppointments($_SESSION['user_id']),
            // 'consultations' => $this->doctorModel->getConsultations($_SESSION['user_id']),
        ];

        $this->view('doctor/doctor_homepage',$data);
        
    }

    public function appointments(){
        $this->view('doctor/appointments');
    }

    public function viewSignup1(){
        $this->view('doctor/signup1');
    }

    public function viewSignup2(){
        $this->view('doctor/signup2');
    }

    public function addNewrecord(){
        $this->view('doctor/addNewRecord');
    }

    public function seeRecords(){
        $this->view('doctor/seeRecords');
    }

    public function patientProfile(){
        $this->view('doctor/patientProfile');
    }

    public function updateProfile(){
        try {
            $doctor_id = $this->doctorModel->getDoctorIdByUserId($_SESSION['user_id']);
            $doctor = $this->doctorModel->getDoctorByIdFromApprovedDoctors($doctor_id);
            $user = $this->doctorModel->getDoctorinfoFromUsersTable($_SESSION['user_id']);
            $data = [
                'doctor' => $doctor,
                'user' => $user
                
            ];
            $this->view('doctor/updateProfile',$data);
        } catch (Exception $e) {
            // Handle the exception here (e.g., log it, show an error message, etc.)
            echo 'Error: ' . $e->getMessage();
        }
       
    }

    public function searchPatient(){
        $this->view('doctor/searchPatient');
    }

    public function doctorLogIn(){
        $this->view('doctor/doctorsignin');
    }

    public function visitRecords(){
        $this->view('doctor/visitRecord');
    }

    public function visitRecords2(){
        $this->view('doctor/visitRecord2');
    }

    public function patientGeneralInfo(){
        $this->view('doctor/patientGeneralInfo');
    }

    public function addReport(){
        $this->view('doctor/addReport');
    }



    public function register() {
        
        #session_start();
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $firstName = trim($_POST['firstName']);
            $lastName = trim($_POST['lastName']);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $contactNo = trim($_POST['contactNo']);
            $slmcNo = trim($_POST['slmc_no']);

            $_SESSION['registration'] = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'contact_no' => $contactNo,
                'slmc_no' => $slmcNo
            ];


    
            if ($_SESSION['registration']['email']) {
                header('Location: ' . URLROOT . 'doctor/signUpStep2');
                
            } else {
                $data['error'] = "Invalid email format.";
            }
        }
    
        $this->view('doctor/signUp1', $data ?? []);
    }


    public function signUpStep2() {
     
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newFileName = '';
            if (isset($_FILES['medicalLicenseCopy'])) {
                
                $uploadDir = __DIR__.'/../../public/uploads/medical_licenses/doctor_license/';  // Make sure this directory exists in your project
                $fileTmpPath = $_FILES['medicalLicenseCopy']['tmp_name'];
                $fileName = basename($_FILES['medicalLicenseCopy']['name']);
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
                if (in_array($fileExtension, $allowedExtensions)) {
                    $newFileName = uniqid('id_copy_', true) . '.' . $fileExtension;
                    $destination = $uploadDir . $newFileName;
    
                    if (!move_uploaded_file($fileTmpPath, $destination)) {
                        #$_SESSION['medical_license_copy'] = $newFileName;
                        echo 'File upload failed.';
                    }
                }else{
                    echo 'Invalid file format.';
                }
            }else{
                echo 'No file selected.';
            }
    
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['confirm_password'] = $_POST['confirm_password'];
            $checkbox = isset($_POST['checkbox']) ? 1 : 0;

            $password = $_SESSION['password'];
            $confirmPassword = $_SESSION['confirm_password'];

    
            if ($_SESSION['password'] === $_SESSION['confirm_password']) {
                // Add doctor to the database
                $this->doctorModel = $this->model('m_doctor');

                $registrationData = [
                    'first_name' => $_SESSION['registration']['first_name'],
                    'last_name' => $_SESSION['registration']['last_name'],
                    'email' => $_SESSION['registration']['email'],
                    'contact_no' => $_SESSION['registration']['contact_no'],
                    'slmc_no' => $_SESSION['registration']['slmc_no'],
                    'medical_license_copy' => $newFileName,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    // 'password' => $password,
                    'checkbox' => $checkbox
                ];
                
                //$this->userModel->registerNewUser($registrationData);
                $this->doctorModel->registerNewDoctor($registrationData);
                
                // Redirect on success
                echo 'Doctor registered successfully!';
                header('Location: ' . URLROOT . 'homecontroller/index');
                exit();
            } else {
                $data['error'] = "Passwords do not match.";
            }
        }
    
        $this->view('doctor/signUp2', $data ?? []);
    }

    public function updateProfileInfo(){
        try{
           if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $doctor_id = $this->doctorModel->getDoctorIdByUserId($_SESSION['user_id']);
            $dataForApprovedDoctorTable = [
                'first_name' => trim($_POST['firstname']),
                'last_name' => trim($_POST['lastname']),
                // 'email' => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
                'contact1' => trim($_POST['contact1']),
                'contact2' => trim($_POST['contact2']),
                'specialization' => trim($_POST['specialization']),
                'license' => trim($_POST['licenseNo']),
                'bio' => trim($_POST['bio']),
                'street' => trim($_POST['street']),
                'city' => trim($_POST['city']),
                'state' => trim($_POST['state'])
            ];
            

          $this->doctorModel->updateProfileInfo($doctor_id,$dataForApprovedDoctorTable); 
          $this->updateProfile();

            
            
        } }catch(Exception $e){
            // Handle the exception here (e.g., log it, show an error message, etc.)
            echo 'Error: ' . $e->getMessage();
        }
   

    
    }

   
    
    
   

}
