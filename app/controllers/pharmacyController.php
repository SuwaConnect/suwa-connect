<?php

class pharmacyController extends Controller {
    
    private $pharmacyModel;

    public function __construct(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        
        $this->pharmacyModel = $this->model('pharmacyModel');
       
    }

    // public function index(){
    //     $this->view('pharmacy/pharmacylogin');
    // }

    public function pharmacySignIn(){
        $this->view('pharmacy/pharmacylogin');
    }

    public function pharmacyAddPromo(){
        $this->view('pharmacy/pharmacyaddpromo');
    }

    public function pharmacyHome(){
        $this->view('pharmacy/pharmacyhome');
    }

    public function pharmacyChangePromo(){
        $this->view('pharmacy/pharmacychangepromo');
    }

    public function pharmacyPrescriptionHistory(){
        $this->view('pharmacy/pharmacyprescriptionhistory');
    }

    public function pharmacyPresManagement(){
        $this->view('pharmacy/pharmacypresmanagement');
    }

    public function pharmacyProfile(){
        $this->view('pharmacy/pharmacyprofile');
    }

    public function pharmacyPromotions(){
        $this->view('pharmacy/pharmacyPromotions');
    }

    // public function pharmacySignUp(){
    //     $this->view('pharmacy/pharmacysignup');
    // }

    public function pharmacySignup1(){
        $this->view('pharmacy/labsignup1');
    
    }
    
    public function pharmacySignup2(){
        $this->view('pharmacy/labsignup2');
    
    }

    public function signup1() {
        // Start the session if not already started
        
    try{
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pharmacyName = trim($_POST['pharmacyName']);
            $contactPerson = trim($_POST['contactPerson']);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $contactNo = trim($_POST['contactNo']);
            $pharmacyRegNo = trim($_POST['pharmacyRegNo']);
    
            // Store the lab registration data in session
            $_SESSION['pharmacy_registration'] = [
                'pharmacy_name' => $pharmacyName,
                'contact_person' => $contactPerson,
                'email' => $email,
                'contact_no' => $contactNo,
                'pharmacy_reg_no' => $pharmacyRegNo
            ];
    
            // Validate the email
            if ($email) {
                // If the email is valid, redirect to the next registration step
                header('Location: ' . URLROOT . 'pharmacyController/signup2');
                exit(); // Make sure to stop execution after the redirect
            } else {
                // If the email is invalid, show an error message
                $data['error'] = "Invalid email format.";
            }
        }
    
        // Show the first step view with any error messages
        $this->view('pharmacy/labsignup1', $data ?? []);
    } catch (Exception $e) {
        // Handle any exceptions that may occur
        echo "An error occurred: " . $e->getMessage();
    }
    }

    public function signup2() {
        // Start the session if not already started
       
    try{
        $data = [];
    
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newFileName = '';
            
            // Check if the lab registration certificate file is uploaded
            if (isset($_FILES['pharmacyRegCertificate']) && $_FILES['pharmacyRegCertificate']['error'] == UPLOAD_ERR_OK) {
                // Define the upload directory (relative to the current script location)
                $uploadDir = __DIR__ . '/../../public/uploads/medical_licenses/pharmacy/';  // Make sure this directory exists in your project
    
                // Ensure the directory exists, and create it if it doesn't
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);  // This ensures the directory is created if it doesn't exist
                }
    
                // Get file information
                $fileTmpPath = $_FILES['pharmacyRegCertificate']['tmp_name'];
                $fileName = basename($_FILES['pharmacyRegCertificate']['name']);
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
                // Allowed file extensions
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
                if (in_array($fileExtension, $allowedExtensions)) {
                    // Generate a unique file name to avoid conflicts
                    $newFileName = uniqid('pharmacy_cert_', true) . '.' . $fileExtension;
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
            //$name = isset($_POST['name']) ? $_POST['name'] : '';
            //$contact_person = isset($_POST['contact_person']) ? $_POST['contact_person'] : '';
            //$contact_number = isset($_POST['contact_number']) ? $_POST['contact_number'] : '';
            //$lab_reg_number = isset($_POST['pharmacy_reg_number']) ? $_POST['pharmacy_reg_number'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
            $termsAccepted = isset($_POST['terms']) ? 1 : 0;
    
            // Check if passwords match
            if ($password === $confirm_password) {
                // Retrieve lab registration data from session
                if (isset($_SESSION['pharmacy_registration'])) {
                    $registrationData = $_SESSION['pharmacy_registration'];
    
            
                $registrationData = [
                    'pharmacy_name' => $_SESSION['pharmacy_registration']['pharmacy_name'],
                    'contact_person' => $_SESSION['pharmacy_registration']['contact_person'],
                    'email' => $_SESSION['pharmacy_registration']['email'],
                    'contact_no' => $_SESSION['pharmacy_registration']['contact_no'],
                    'pharmacyRegNo' => $_SESSION['pharmacy_registration']['pharmacy_reg_no'],
                    'pharmacy_license_copy' => $newFileName,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    // 'password' => $password,
                    'terms_accepted' => $termsAccepted
                ];
    
                    //Load the model and save the data to the database
                    if ($this->pharmacyModel->addPendingPharmacy($registrationData)) {
                        // Registration request has been sent
                        $data['success_message'] = 'Your registration request has been sent. Once approved, you will receive an email notification.';
                        // Redirect to the home page or dashboard
                        //header('Location: ' . URLROOT . '/labController/labSuccess');
                        echo 'successfully registered';
                        header('Location: ' . URLROOT . 'homecontroller/index');
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
        $this->view('pharmacy/labsignup2', $data);
    }
    
    catch (Exception $e) {
        // Handle any exceptions that may occur
        echo "An error occurred: " . $e->getMessage();
    }
}

}