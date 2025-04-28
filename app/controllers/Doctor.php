<?php

class Doctor extends Controller
{
    private $doctorModel;
    private $userModel;
    private $appointmentModel;

    public function __construct(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->doctorModel = $this->model('m_doctor');
        $this->appointmentModel = $this->model('appointmentModel');
    }

    public function home(){

        $data = [
             'today_appointments' => $this->doctorModel->getCountOfTodayappointments($_SESSION['user_id']),
             'total_patients' => $this->doctorModel->getTotalPatientsForDoctor($_SESSION['user_id']),
             'patients_consulted' => $this->doctorModel->getCountOfPatientsConsulted($_SESSION['user_id']),
             'todays sessions' => $this->doctorModel->getTodaysSessions($_SESSION['user_id']),
             'appointmentDates' => $this->doctorModel->getAppointmentDates($_SESSION['user_id']),
             'upcoming_appointments' => $this->doctorModel->getUpcomingAppointments($_SESSION['user_id']),
        ];

        $this->view('doctor/doctor_homepage',$data);
        //var_dump($data['appointmentsDates']);
        //var_dump($data['upcoming_appointments']);
        
    }

    public function appointments(){

        try {
            // Get the doctor ID from the logged-in user
            $doctorId = $this->appointmentModel->getDoctorIdByUserId($_SESSION['user_id'])->doctor_id;
            
            // Get the date from POST request
            $date = date('Y-m-d');
            //echo $date;
            // // Convert date to day of week (Monday, Tuesday, etc.)
             $dayOfWeek = date('l', strtotime($date));
    
            // // Get sessions for this doctor on this day of week
             $doctorSessions = $this->appointmentModel->getSessionsByDoctorAndDay($doctorId, $dayOfWeek);
            
            // // Initialize array to hold sessions and their appointments
             $sessions = [];
            
            // // For each session, get the appointments
            foreach ($doctorSessions as $session) {
                $sessionId = $session->session_id;
                
                // Get appointments for this session on the specified date
                $appointments = $this->appointmentModel->getAppointmentsForSession($sessionId, $date);
                
                // Add session info and its appointments to the result
                $sessions[$sessionId] = [
                    'session_info' => $session,
                    'appointments' => $appointments,
                    'current_count' => count($appointments),
                    'max_patients' => $session->max_patients
                ];
            }
            
            // // Check if we have any sessions for this day
            if (empty($sessions)) {
                $data = [
                    'date' => $date,
                    'message' => 'No sessions scheduled for ' . $dayOfWeek
                ];
            } else {
                $data = [
                    'date' => $date,
                    'day_of_week' => $dayOfWeek,
                    'sessions' => $sessions
                ];
            }
            
            // // Load the view with the data
             $this->view('doctor/appointments', $data);
            
        } catch (Exception $e) {
            // Handle error
            $data = [
                // 'date' => $_POST['date'] ?? date('Y-m-d'),
                'message' => 'Error: ' . $e->getMessage()
            ];
            
            //$this->view('doctor/appointments', $data);
        }

        //$this->view('doctor/appointments');
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
                'state' => trim($_POST['state']),
                'appointment_charges'=> trim($_POST['appointment_charges'])
            ];
            

          $this->doctorModel->updateProfileInfo($doctor_id,$dataForApprovedDoctorTable); 
          $this->updateProfile();

            
            
        } }catch(Exception $e){
            // Handle the exception here (e.g., log it, show an error message, etc.)
            echo 'Error: ' . $e->getMessage();
        }
   

    
    }


    public function getDoctorDetails($doctor_id) {
        try {
            // Set Content-Type header for JSON response
            header('Content-Type: application/json');
            
            // Validate that doctor_id is a valid integer
            if (!is_numeric($doctor_id) || $doctor_id <= 0) {
                http_response_code(400); // Bad Request
                echo json_encode(['error' => 'Invalid doctor ID']);
                return;
            }
            
            // Get the doctor details from the model
            $doctor = $this->doctorModel->getDoctorByIdFromApprovedDoctors($doctor_id);
            
            // Check if doctor was found
            if (!$doctor) {
                http_response_code(404); // Not Found
                echo json_encode(['error' => 'Doctor not found']);
                return;
            }
            
            // Return doctor data as JSON
            echo json_encode($doctor);
            
        } catch (Exception $e) {
            // Log the error (if you have a logging system)
            // error_log('Error in getDoctorDetails: ' . $e->getMessage());
            
            // Send proper error response
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => 'An error occurred while fetching doctor details']);
        }
    }

   
    
    
   

}
