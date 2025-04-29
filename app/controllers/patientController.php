<?php 
class patientController extends Controller {

    private $patientModel;
    private $userModel;
    private $appointmentModel;
    private $visitRecordModel;
    private $pharmacyModel;
    private $labModel;

    public function __construct() {
        $this->patientModel = $this->model('patientModel');
        $this->userModel = $this->model('UserModel');
        $this->appointmentModel = $this->model('appointmentModel');
        $this->visitRecordModel = $this->model('VisitRecordModel');
        $this->pharmacyModel = $this->model('pharmacyModel');
        $this->labModel = $this->model('m_lab');

        if(!isset($_SESSION['user_id'])) {
    }
    }
    public function confirmRequest() {
        $this->view('patient/confirmRequest');
    }

    

    public function appointments() {

            try{
                $patientId = $this->appointmentModel->getPatientIdByUserId($_SESSION['user_id'])->patient_id;
                $appointments = $this->appointmentModel->getScheduledAppointmentsForPatient($patientId);
                $labAppointments = $this->appointmentModel->getScheduledLabAppointmentsForPatient($patientId);

                $data = [
                    'appointments' => $appointments,
                    'lab_appointments' => $labAppointments
                ];
                //var_dump($data['appointments']);
                $this->view('patient/appointment-updated', $data);
            }catch (Exception $e) {
                // Handle exception (e.g., log the error, show an error message)
                echo "Error: " . $e->getMessage();
            }
            
       
    }

    public function dashboard() {
        $patient_id = $this->patientModel->getPatientByUserId($_SESSION['user_id'])->patient_id;
        $records = $this->patientModel->getAllMedicalRecordsForPatient($patient_id);

        $data= [
            'records' => $records,
            'patient_id' => $patient_id
        ];

        //var_dump($data['records']);
        $this->view('patient/dashboard',$data);
    }

    public function manageHealthInfo(){
        $this->view('patient/health-info');
    }

    public function records() {
        try{
            // Fetch patient data from the model
            $patient_id = $this->patientModel->getPatientByUserId($_SESSION['user_id'])->patient_id;
            $patient = $this->patientModel->getPatientByUserId($_SESSION['user_id']);
            $vitalSigns = $this->patientModel->getRecentVitalSigns($patient_id);
            $data = [
                'vitalSigns' => $vitalSigns,
                'patient_id' => $patient_id,
                'patient' => $patient,
                $count = count($vitalSigns)-1
            ];
           //var_dump($data['count']);
            $this->view('patient/record', $data);
        } catch (Exception $e) {
            // Handle exception (e.g., log the error, show an error message)
            echo "Error: " . $e->getMessage();
        }
       
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

    public function updateProfile() {
        $patient = $this->patientModel->getPatientByUserId($_SESSION['user_id']);

        $data=[
            'first_name' => $patient->first_name,
            'last_name' => $patient->last_name,
            'contact_no' => $patient->contact_no,
            'address' => $patient->address,
            'email' => $patient->email,
            'height' => $patient->height,
            'blood_type' => $patient->blood_type,
            'chronic_conditions' => $patient->chronic_conditions,
            'allergies' => $patient->allergies,
            'past_surgeries' => $patient->past_surgeries,
            'additional_health_notes' => $patient->additional_health_notes

        ];
        $this->view('patient/updateProfile',$data);
    }

    public function searchDoctorToMakeAppointment(){
        $this->view('patient/searchDoctor');
    }

    public function searchLabToMakeAppointment(){
        $data=  $this->labModel->getAllLabs();
        
        $this->view('patient/searchLabs', $data);
    }

    public function makeLabAppointment($lab_id){
        $data = [
            'lab' => $this->labModel->getLabByLabId($lab_id),
            'patient' => $this->patientModel->getPatientByUserId($_SESSION['user_id']),
        ];
        $this->view('patient/makeLabAppointment', $data);
    }
    

public function patientRegister() {
    try{
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Create data array to store validation errors
        $errors = [];
        
        // Sanitize and validate inputs
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $nic = $_POST['nic'];
        $gender = $_POST['gender'];
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $contactNo = $_POST['contact_no'];
        $dateOfBirth = $_POST['dob'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

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
    $this->view('patient/patientSignup', $data ?? ['errors' => []]);}
    catch (Exception $e) {
        // Handle exception (e.g., log the error, show an error message)
        echo "Error: " . $e->getMessage();
    }
}

public function viewHealthRecord($healthRecordId) {
    try {
        $healthRecord = $this->visitRecordModel->getHealthRecordById($healthRecordId);
        $doctor_id = $healthRecord->doctor_id;
        if (!$healthRecord) {
            throw new Exception('Health record not found');
        }
        
        
        $data = [
            'healthRecord' => $healthRecord,
            'vitalSigns' => $this->visitRecordModel->getVitalSignsByRecordId($healthRecordId),
            'reports' => $this->visitRecordModel->getReportsByRecordId($healthRecordId),
            'prescription' => $this->visitRecordModel->getPrescriptionsByRecordId($healthRecordId),
            'doctor'=> $this ->appointmentModel->getDoctorById($doctor_id),
        ];
        
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        return;
    }
    
     // Check permissions again
    
    $this->view('patient/viewHealthRecord',$data);

}

public function searchHealthRecord(){
    
    try{
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $searchTerm =$_POST['search'];
        $patient_id = $this->patientModel->getPatientByUserId($_SESSION['user_id'])->patient_id;
        $records = $this->patientModel->searchHealthRecord($patient_id, $searchTerm);
        $data = [
            'records' => $records,
            'patient_id' => $patient_id
        ];
        //var_dump($data['records']);
        $this->view('patient/dashboard',$data);
       
    }
    } catch (Exception $e) {
        // Handle exception (e.g., log the error, show an error message)
        echo "Error: " . $e->getMessage();
}
}

public function sendPrescriptionToPharmacy($record_id) {
    
    $data = [
        'record_id' => $record_id,
       
    ];

    $this->view('patient/searchPharmacy', $data);
}

public function searchPharmacy(){
    try{
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $searchTerm = $data['searchQuery'];
            $pharmacies = $this->pharmacyModel->searchPharmacy($searchTerm);
            $data = [
                'pharmacies' => $pharmacies
            ];
            
            echo json_encode($data);
            exit;
        }
    } catch (Exception $e) {
        // Handle exception (e.g., log the error, show an error message)
        echo "Error: " . $e->getMessage();
    }
}

public function sendPrescription($record_id,$pharmacy_id){
    try{
        $medicines = $this->pharmacyModel->getrelevantMedicines($record_id);

        $data = [
            'record_id' => $record_id,
            'pharmacy_id' => $pharmacy_id,
            'medicines' => $medicines
        ];
         $this->view('patient/sendPrescription', $data);
        //var_dump($medicines);

    }catch (Exception $e) {
        // Handle exception (e.g., log the error, show an error message)
        echo "Error: " . $e->getMessage();
    }
   
    
}

public function addToOrder() {
    try{
    // Set proper JSON content type header
    header('Content-Type: application/json');
    
    // Create response array
    $response = [
        'success' => false,
        'message' => 'Invalid request'
    ];
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Check if request is AJAX with JSON
        $input = json_decode(file_get_contents('php://input'), true);
        
        if(isset($input['recordId'])){
           // $medicineIds = $input['medicineIds'];
            $specialInstructions = $input['specialInstructions'];
            $deliveryMethod = $input['deliveryMethod'];
            $patientId = $this->patientModel->getPatientByUserId($_SESSION['user_id'])->patient_id;
            $recordId = $input['recordId'];
            $pharmacyId = $input['pharmacyId'];

            $order_id = $this->pharmacyModel->createOrder($patientId, $pharmacyId, $specialInstructions, $deliveryMethod, $recordId);
            
            if($order_id){
                $response = [
                    'success' => true,
                    'message' => 'Prescription sent to pharmacy successfully'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to send prescription to pharmacy'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Medicine IDs are required'
            ];
        }
    }
    
    // Output JSON response
    echo json_encode($response);
    exit; // Stop execution after sending response
}catch (Exception $e) {
        // Handle exception (e.g., log the error, show an error message)
        echo "Error: " . $e->getMessage();
    }
}

public function manageAccess(){

    $patient_id = $this->patientModel->getPatientByUserId($_SESSION['user_id'])->patient_id;
    $doctors = $this->patientModel->getDoctorsWithAccess($patient_id);
    $data = [
        'doctors' => $doctors,
        'patient_id' => $patient_id
    ];
    //var_dump($data['doctors']);
    $this->view('patient/revokeAccess', $data);
}

public function revokeAccess(){
    // Set proper JSON content type header
    header('Content-Type: application/json');
    
    // Create response array
    $response = [
        'success' => false,
        'message' => 'Invalid request'
    ];
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Check if request is AJAX with JSON
        $input = json_decode(file_get_contents('php://input'), true);
        
        if(isset($input['doctor_id'])){
            $doctor_id = $input['doctor_id'];
            $patient_id = $this->patientModel->getPatientByUserId($_SESSION['user_id'])->patient_id;
            
            if($this->patientModel->revokeAccess($doctor_id, $patient_id)){
                $response = [
                    'success' => true,
                    'message' => 'Access revoked successfully'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to revoke access'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Doctor ID is required'
            ];
        }
    }
    
    // Output JSON response
    echo json_encode($response);
    exit; // Stop execution after sending response
}

public function searchLabs(){
    try{if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $searchTerm = $data['searchQuery'];
        $labs = $this->labModel->searchLabs($searchTerm);
        $data = [
            'labs' => $labs
        ];
        
        echo json_encode($data);
        exit;
    }
        
    } catch (Exception $e) {
        // Handle exception (e.g., log the error, show an error message)
        echo "Error: " . $e->getMessage();
    }
}



public function createLabAppointment() {
    header('Content-Type: application/json');
    try {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $lab_id = filter_var($data['lab_id'], FILTER_VALIDATE_INT);
            $patient = $this->patientModel->getPatientByUserId($_SESSION['user_id']);
            $patient_id = $patient->patient_id;
            $test_name = htmlspecialchars($data['testName']);
            
            // Format date and time if necessary
            $appointment_date = date('Y-m-d', strtotime($data['date']));
            $appointment_time = date('H:i:s', strtotime($data['time']));
           
             if ($this->patientModel->createLabAppointment($lab_id, $patient_id, $test_name, $appointment_date, $appointment_time)) {
                echo json_encode(['success' => true]);
                
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to create appointment']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Exception: ' . $e->getMessage()]);
    }
}

public function updateProfileInfo(){
    try{
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $contactNo = $_POST['contact_no'];
        $address = $_POST['address'];
        $height = $_POST['height'];
        $blood_type = $_POST['blood_type'];
        $chronic_conditions = $_POST['chronic_conditions'];
        $allergies = $_POST['allergies'];
        $past_surgeries = $_POST['past_surgeries'];
        $additionalhealth_notes = $_POST['health_notes'];

        $patient_id = $this->patientModel->getPatientByUserId($_SESSION['user_id'])->patient_id;
        
        $data=[
            'patient_id' => $patient_id,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'contact_no' => $contactNo,
            'address' => $address,
            'height' => $height,
            'blood_type' => $blood_type,
            'chronic_conditions' => $chronic_conditions,
            'allergies' => $allergies,
            'past_surgeries' => $past_surgeries,
            'additionalhealth_notes' => $additionalhealth_notes

        ];
        if($this->patientModel->updatePatientProfile($data)){
            header('Location: ' . URLROOT . 'patientController/updateProfile');
        } 
    
}}catch (Exception $e) {
    // Handle exception (e.g., log the error, show an error message)
    echo "Error: " . $e->getMessage();
}

}

public function viewpatientHistory($patient_id){
    $vitalSigns = $this->patientModel->getRecentVitalSigns($patient_id);
    $data= [
        'vitalSigns' => $vitalSigns,
        'patient_id' => $patient_id
    ];

    //var_dump($data['vitalsigns']);
    $this->view('doctor/viewpatientHistory',$data);
}



}