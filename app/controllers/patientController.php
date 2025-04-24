<?php 
class patientController extends Controller {

    private $patientModel;
    private $userModel;
    private $appointmentModel;
    private $visitRecordModel;
    private $pharmacyModel;

    public function __construct() {
        $this->patientModel = $this->model('patientModel');
        $this->userModel = $this->model('UserModel');
        $this->appointmentModel = $this->model('appointmentModel');
        $this->visitRecordModel = $this->model('VisitRecordModel');
        $this->pharmacyModel = $this->model('pharmacyModel');
    }

    public function confirmRequest() {
        $this->view('patient/confirmRequest');
    }

    public function report() {
        $this->view('patient/report');
    }

    public function appointments() {

            try{
                $patientId = $this->appointmentModel->getPatientIdByUserId($_SESSION['user_id'])->patient_id;
                $appointments = $this->appointmentModel->getScheduledAppointmentsForPatient($patientId);

                $data = [
                    'appointments' => $appointments
                ];
                //var_dump($data['appointments']);
                $this->view('patient/appointments', $data);
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

    public function searchDoctorToMakeAppointment(){
        $this->view('patient/searchDoctor');
    }
    

public function patientRegister() {
    try{
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Create data array to store validation errors
        $errors = [];
        
        // Sanitize and validate inputs
        $firstName = trim($_POST['first_name']);
        $lastName = trim($_POST['last_name']);
        $nic = trim($_POST['nic']);
        $gender = trim($_POST['gender']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $contactNo = trim($_POST['contact_no']);
        $dateOfBirth = trim($_POST['dob']);
        $address = trim($_POST['address']);
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
            $searchTerm =$_POST['searchQuery'];
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
        
        if(isset($input['medicineIds'])){
            $medicineIds = $input['medicineIds'];
            $specialInstructions = $input['specialInstructions'];
            $deliveryMethod = $input['deliveryMethod'];
            $patientId = $this->patientModel->getPatientByUserId($_SESSION['user_id'])->patient_id;
            $recordId = $input['recordId'];
            $pharmacyId = $input['pharmacyId'];

            $order_id = $this->pharmacyModel->createOrder($patientId, $pharmacyId, $specialInstructions, $deliveryMethod, $recordId);

            if($order_id){
                $orderPlaced = $this->pharmacyModel->addMedicinesToOrder($medicineIds, $order_id);
            }
            
            if($orderPlaced){
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
}