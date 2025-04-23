<?php

class labController extends controller{

public $m_lab;

public function __construct(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $this->m_lab = $this->model('m_lab');

}

public function labHome(){
    $this->view('labs/labhome');
}

public function labHomePage(){
    $this->dashboard(); 
}

public function labSuccess(){
    $this->view('labs/labsuccess');
}

public function labSignIn(){
    $this->view('labs/labsignin');
}


public function labNotifications(){
    $this->view('labs/notifications');
}

public function labProfile(){
    $this->view('labs/labprofile');
}

public function labReports(){
    $this->view('labs/labreports');
}


public function labSchedule(){
    $this->view('labs/labschedule');
}

public function labSettings(){
    $this->view('labs/labsettings');
}

public function labSupport(){
    $this->view('labs/labsupport');
}

public function labTestRequests(){
    $this->requests();
}


public function labsignup1() {
    // Start the session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $labName = trim($_POST['labName']);
        $contactPerson = trim($_POST['contactPerson']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $contactNo = trim($_POST['contactNo']);
        $labRegNo = trim($_POST['labRegNo']);

        // Store the lab registration data in session
        $_SESSION['lab_registration'] = [
            'lab_name' => $labName,
            'contact_person' => $contactPerson,
            'email' => $email,
            'contact_no' => $contactNo,
            'lab_reg_no' => $labRegNo
        ];

        // Validate the email
        if ($email) {
            // If the email is valid, redirect to the next registration step
            header('Location: ' . URLROOT . 'labController/labsignup2');
            exit(); // Make sure to stop execution after the redirect
        } else {
            // If the email is invalid, show an error message
            $data['error'] = "Invalid email format.";
        }
    }

    // Show the first step view with any error messages
    $this->view('labs/labsignup1', $data ?? []);
}


public function labsignup2() {
    // Start the session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $data = [];

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newFileName = '';
        
        // Check if the lab registration certificate file is uploaded
        if (isset($_FILES['labRegCertificate']) && $_FILES['labRegCertificate']['error'] == UPLOAD_ERR_OK) {
            // Define the upload directory (relative to the current script location)
            $uploadDir = __DIR__ . '/../../public/uploads/';  // Make sure this directory exists in your project

            // Ensure the directory exists, and create it if it doesn't
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);  // This ensures the directory is created if it doesn't exist
            }

            // Get file information
            $fileTmpPath = $_FILES['labRegCertificate']['tmp_name'];
            $fileName = basename($_FILES['labRegCertificate']['name']);
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Allowed file extensions
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
            if (in_array($fileExtension, $allowedExtensions)) {
                // Generate a unique file name to avoid conflicts
                $newFileName = uniqid('lab_cert_', true) . '.' . $fileExtension;
                $destination = $uploadDir . $newFileName;

                // Move the file to the destination
                if (!move_uploaded_file($fileTmpPath, $destination)) {
                    $data['error'] = 'File upload failed.';
                }
            } else {
                $data['error'] = 'Invalid file format. Only JPG, JPEG, PNG, and PDF are allowed.';
            }
        } else {
            $data['error'] = 'No file selected.';
        }

        // Get the other form data
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $contact_person = isset($_POST['contact_person']) ? $_POST['contact_person'] : '';
        $contact_number = isset($_POST['contact_number']) ? $_POST['contact_number'] : '';
        $lab_reg_number = isset($_POST['lab_reg_number']) ? $_POST['lab_reg_number'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
        $termsAccepted = isset($_POST['terms']) ? 1 : 0;

        // Check if passwords match
        if ($password === $confirm_password) {
            // Retrieve lab registration data from session
            if (isset($_SESSION['lab_registration'])) {
                $registrationData = $_SESSION['lab_registration'];

                // Add password, file, and terms to the registration data
                $registrationData['name'] = $name;
                $registrationData['contact_person'] = $contact_person;
                $registrationData['contact_number'] = $contact_number;
                $registrationData['lab_reg_number'] = $lab_reg_number;
                $registrationData['medical_license_copy'] = $newFileName;
                $registrationData['password'] = password_hash($password, PASSWORD_DEFAULT);
                $registrationData['terms_accepted'] = $termsAccepted;

                // Load the model and save the data to the database
                if ($this->m_lab->addPendingLab($registrationData)) {
                    // Registration request has been sent
                    $data['success_message'] = 'Your registration request has been sent. Once approved, you will receive an email notification.';
                    // Redirect to the home page or dashboard
                    header('Location: ' . URLROOT . '/labController/labSuccess');
                    exit();
                } else {
                    $data['error'] = 'Lab registration failed. Please try again.';
                }
            } else {
                $data['error'] = 'Session expired. Please restart the registration process.';
            }
        } else {
            // If passwords don't match, show error
            $data['error'] = "Passwords do not match.";
        }
    }

    // Render the view for lab registration step 2
    $this->view('labs/labsignup2', $data);
}

public function authenticate() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if (empty($email) || empty($password)) {
            $data = [
                'title' => 'Lab/Pharmacy Login',
                'email' => $email,
                'password' => $password,
                'error' => 'Please enter both email and password'
            ];
            $this->view('user/lablogin', $data);
            return;
        }

        $user = $this->m_lab->verifyCredentials($email, $password);

        if ($user) {
            $_SESSION['lab_id'] = $user->lab_id;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['user_email'] = $user->email;

            redirect('labController/labHomePage');
        } else {
            $data = [
                'title' => 'Lab/Pharmacy Login',
                'email' => $email,
                'password' => $password,
                'error' => 'Invalid email or password'
            ];
            $this->view('user/lablogin', $data);
        }
    } else {
        $this->login();
    }
}

public function login() {
    $data = [
        'title' => 'Lab/Pharmacy Login',
        'email' => '',
        'password' => '',
        'error' => ''
    ];
    $this->view('user/lablogin', $data);
}


public function dashboard() {
    $lab_id = $_SESSION['lab_id'];

    // Load model
    $labModel = $this->model('m_lab');

    // Fetch dashboard data
    $totalTestsToday = $labModel->getTotalTestsToday($lab_id);
    $testsInProgress = $labModel->getTestsInProgress();
    $completedTests = $labModel->getCompletedTests();
    $avgTurnaroundTime = $labModel->getAverageTurnaroundTime();
    $upcomingAppointments = $labModel->getUpcomingAppointments($lab_id);
    $notifications = $labModel->generateLabNotificationsData($lab_id); // Fetch notifications




    // Send to view
    $this->view('labs/labhome', [
        'totalTestsToday' => $totalTestsToday,
        'testsInProgress' => $testsInProgress,
        'completedTests' => $completedTests,
        'avgTurnaroundTime' => $avgTurnaroundTime,
        'upcomingAppointments' => $upcomingAppointments,
        'notifications' => $notifications,
    ]);
}

public function requests(){
    $lab_id = $_SESSION['lab_id'];

    // Load model
    $labModel = $this->model('m_lab');

    //accept request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['accept_request']) && isset($_POST['request_id'])) {
            $request_id = $_POST['request_id'];
            $request = $labModel->getAppointmentRequestById($request_id);
    
            if ($request) {
                $lab_appointment_data = [
                    'patient_id' => $request->patient_id,
                    'lab_id' => $request->lab_id,
                    'appointment_date' => $request->appointment_date,
                    'appointment_time' => $request->appointment_time,
                    'status' => 'in_progress',
                ];
    
                $labModel->insertLabAppointment($lab_appointment_data);
                $appointment_id = $labModel->getLastInsertedId();
    
                $start_time = $request->appointment_time;
                $end_time = date('H:i', strtotime($start_time . ' +1 hour'));
    
                $test_data = [
                    'user_id' => $request->patient_id,
                    'lab_id' => $request->lab_id,
                    'test_name' => $request->test_name,
                    'test_date' => $request->appointment_date,
                    'status' => 'in_progress',
                    'is_completed' => 0,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'appointment_id' => $appointment_id,
                ];
    
                $labModel->insertTest($test_data);
    
                // Optional: remove request from pending
                 $labModel->deleteAppointmentRequest($request_id);
    
                header('Location: ' . URLROOT . 'labController/requests');
                exit();
            } else {
                echo "Invalid request.";
            }
        }
    
        if (isset($_POST['cancel_request']) && isset($_POST['request_id'])) {
            $request_id = $_POST['request_id'];
            $labModel->cancelAppointmentRequest($request_id); // you'll define this
            header('Location: ' . URLROOT . 'labController/requests');
            exit();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_appointment'])) {
        $appointment_id = $_POST['request_id'];
        $labModel->cancelAppointmentRequest($appointment_id);
        header('Location: requests');
        exit();
    }
    
    

    // Fetch dashboard data
    $totalAppointmentRequests = $labModel->getTotalAppointmentsRequests($lab_id);
    $totalAppointments = $labModel->getTotalAppointments($lab_id);
    $getUpcomingAppointmentsCount = $labModel->getUpcomingAppointmentsCount($lab_id);
    $getCancelledAppointmentsCount = $labModel->getCancelledAppointmentsCount($lab_id);
    $getTotalTestsCount = $labModel->getTotalTestsCount($lab_id);
    $getPendingTestsCount = $labModel->getPendingTestsCount($lab_id);
    $getCompletedTestsCount = $labModel->getCompletedTestsCount($lab_id);
    $getCancelledTestsCount = $labModel->getCancelledTestsCount($lab_id);
    $getLabAppointmentRequests = $labModel->getLabAppointmentRequests($lab_id);

    $this->view('labs/labtestRequests', [
        'totalAppointmentRequests' => $totalAppointmentRequests,
        'totalAppointments' => $totalAppointments,
        'getUpcomingAppointmentsCount' => $getUpcomingAppointmentsCount,
        'getCancelledAppointmentsCount' => $getCancelledAppointmentsCount,
        'getTotalTestsCount' => $getTotalTestsCount,
        'getPendingTestsCount' => $getPendingTestsCount,
        'getCompletedTestsCount' => $getCompletedTestsCount,
        'getCancelledTestsCount' => $getCancelledTestsCount,
        'lab_appointment_requests' => $getLabAppointmentRequests,
    ]);}


    public function labAppointments(){

        $lab_id = $_SESSION['lab_id'];

        $labModel = $this->model('m_lab');

        $totalAppointmentsToday = $labModel->getTotalAppointmentsToday($lab_id);
        $getUpcomingAppointmentsCount = $labModel->getUpcomingAppointmentsCount($lab_id);
        $getMissedAppointmentsCount = $labModel->getMissedAppointmentsCount($lab_id);
        $getCancelledAppointments = $labModel->getCancelledAppointmentsCount($lab_id);

        $status = $_GET['status'] ?? 'all';  // Default to 'all' if no status is set
        $appointment_date = $_GET['appointment_date'] ?? null;
        $patient_name = $_GET['patient_name'] ?? '';
        $test_type = $_GET['test_type'] ?? '';
         // If provided
        $appointments = $labModel->getAppointments($lab_id, $status, $appointment_date,$patient_name,$test_type);

        $this->view('labs/labappointments',[
            'totalAppointmentsToday' => $totalAppointmentsToday,
            'getUpcomingAppointmentsCount' => $getUpcomingAppointmentsCount,
            'getMissedAppointmentsCount' => $getMissedAppointmentsCount,
            'getCancelledAppointments' => $getCancelledAppointments,
            'appointments' => $appointments,
        ]);
        
        
    }

    public function labRevenue(){

        $lab_id = $_SESSION['lab_id'];

        $labModel = $this->model('m_lab');

        $totalRevenueToday =$labModel->getTotalRevenueToday($lab_id);
        $pendingPayments =$labModel->getPendingPayments($lab_id);
        $totalInvoices =$labModel->getTotalInvoices($lab_id);
        $refundsDiscounts =$labModel->getRefundsDiscounts($lab_id);

        $getLabInvoices = $labModel->getLabInvoices($lab_id);
        // Passing the data to the view


        $this->view('labs/labRevenue',[
            'totalRevenueToday' => $totalRevenueToday,
            'pendingPayments' => $pendingPayments,
            'totalInvoices' => $totalInvoices,
            'refundsDiscounts' => $refundsDiscounts,
            'getLabInvoices' => $getLabInvoices,
        ]);
    }

    public function viewinvoice() {
        $lab_id = $_SESSION['lab_id'];

        $labModel = $this->model('m_lab');
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $invoice_id = $_GET['id'];
    
            $invoice = $labModel->getInvoiceById($invoice_id);
    
            if ($invoice) {
                $data = ['invoice' => $invoice];
                $this->view('labs/labinvoice', $data);
            } else {
                die('Invoice not found.');
            }
        } else {
            die('Invalid or missing invoice ID.');
        }
    }
    
    
    
    

}


    


