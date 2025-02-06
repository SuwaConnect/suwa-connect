<?php 
class patientController extends Controller {

    private $patientModel;
    private $userModel;

    public function __construct() {
        $this->patientModel = $this->model('patientModel');
        $this->userModel = $this->model('UserModel');
    }

    public function confirmRequest() {
        $this->view('patient/confirmRequest');
    }

    public function report() {
        $this->view('patient/report');
    }

    public function appointments() {
        $this->view('patient/appointments');
    }

    public function dashboard() {
        $this->view('patient/dashboard');
    }

    public function records() {
        $this->view('patient/record');
    }

    public function notifications() {
        $this->view('patient/notifications');
    }

    public function settings() {
        $this->view('patient/settings');
    }

    public function support() {
        $this->view('patient/support');
    }

    public function bookAppointment() {
        $this->view('patient/bookAppointment');
    }

    public function searchDoctorToMakeAppointment(){
        $this->view('patient/searchDoctor');
    }
    

public function patientRegister() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Create data array to store validation errors
        $errors = [];
        
        // Sanitize and validate inputs
        $firstName = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
        $lastName = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING));
        $nic = trim(filter_input(INPUT_POST, 'nic', FILTER_SANITIZE_STRING));
        $gender = trim(filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING));
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $contactNo = trim(filter_input(INPUT_POST, 'contact_no', FILTER_SANITIZE_STRING));
        $dateOfBirth = trim(filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING));
        $address = trim(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING));
        $password = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirm_password']);

        // Validate required fields
        if(empty($firstName)) $errors['first_name'] = 'First name is required';
        if(empty($lastName)) $errors['last_name'] = 'Last name is required';
        if(empty($nic)) $errors['nic'] = 'NIC is required';
        if(empty($gender)) $errors['gender'] = 'Gender is required';
        if(!$email) $errors['email'] = 'Valid email is required';
        if(empty($contactNo)) $errors['contact_no'] = 'Contact number is required';
        if(empty($dateOfBirth)) $errors['dob'] = 'Date of birth is required';
        if(empty($address)) $errors['address'] = 'Address is required';
        
        // Password validation
        if(strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters';
        }
        
        if($password !== $confirmPassword) {
            $errors['confirm_password'] = 'Passwords do not match';
        }

        // Check if email already exists
        if($this->userModel->findUserByEmail($email)) {
            $errors['email'] = 'Email already registered';
        }

        if(empty($errors)) {
            // Hash password
            $password = password_hash($password, PASSWORD_DEFAULT);

            $userdata = [
                'email' => $email,
                'password' => $password,
                'role' => 'patient',
                'user_name' => $firstName
            ];

            $user_id = $this->userModel->createUser($userdata);

            if($user_id) {
                $registrationData = [
                    'user_id' => $user_id,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'nic' => $nic,
                    'gender' => $gender,
                    'email' => $email,
                    'contact_no' => $contactNo,
                    'dob' => $dateOfBirth,
                    'address' => $address
                ];

                $isPatientRegistered = $this->patientModel->registerNewPatient($registrationData);

                if($isPatientRegistered) {
                    header('Location: ' . URLROOT . 'homeController/patientSignIn');
                   
                    exit();
                } else {
                    // If patient registration fails, we should ideally delete the created user
                    $this->userModel->deleteUser($user_id);
                    $data['register_error'] = 'Failed to register patient';
                }
            } else {
                $data['register_error'] = 'Failed to create user';
            }
        } else {
            $data['errors'] = $errors;
        }
    }

    // Load view with any error data
    $this->view('patient/patientSignup', $data ?? ['errors' => []]);
}




}