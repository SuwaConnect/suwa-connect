<?php

class Doctor extends Controller
{
    private $doctorModel;

    public function __construct(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->doctorModel = $this->model('m_doctor');
    }

    public function home(){
        $this->view('doctor/doctor_homepage');
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
        $this->view('doctor/updateProfile');
    }

    public function searchPatient(){
        $this->view('doctor/searchPatient');
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
                
                $uploadDir = __DIR__.'/../../uploads/';
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
                    'checkbox' => $checkbox
                ];
    
                $this->doctorModel->registerNewDoctor($registrationData);
    
                // Redirect on success
                echo 'Doctor registered successfully!';
                //header('Location: ' . URLROOT . 'doctor/addNewRecord');
                exit();
            } else {
                $data['error'] = "Passwords do not match.";
            }
        }
    
        $this->view('doctor/signUp2', $data ?? []);
    }
    
    
   


}