<?php

class pharmacyController extends Controller {
    
    private $pharmacyModel;

    public function __construct(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        
        $this->pharmacyModel = $this->model('pharmacyModel');
       
    }

    
    public function pharmacySignIn(){
        $this->view('pharmacy/pharmacylogin');
    }

    public function pharmacyAddPromo(){
        $this->view('pharmacy/pharmacyaddpromo');
    }

    public function pharmacyNotifications(){
        $this->view('pharmacy/pharmacynotifications');
    }
    public function pharmacyHome(){
        //pharmacy dashboard data
        $pharmacy_id = $this->pharmacyModel->getPharmacyByUserId($_SESSION['user_id'])->pharmacy_id;
        $data=[
            'total_orders' => $this->pharmacyModel->getTotalOrders($pharmacy_id),
            'pending_orders' => $this->pharmacyModel->getAllPendingOrdersForPharmacy($pharmacy_id),
            'completed_orders' => $this->pharmacyModel->getAllCompletedOrdersForPharmacy($pharmacy_id),
            'cancelled_orders' => $this->pharmacyModel->getAllCancelledOrdersForPharmacy($pharmacy_id),
            'unprocessed_orders' => $this->pharmacyModel->getNotprocessedOrdersForPharmacy($pharmacy_id),];
        $this->view('pharmacy/pharmacyhome', $data);
        //var_dump($data['unprocessed_orders']);
    }

    public function pharmacyOrders() {
        // Get pharmacy ID first
        $pharmacy_id = $this->pharmacyModel->getPharmacyByUserId($_SESSION['user_id'])->pharmacy_id;
        
        // Calculate all values upfront
        $total_orders = $this->pharmacyModel->getTotalOrders($pharmacy_id);
        $pending_orders = $this->pharmacyModel->getAllPendingOrdersForPharmacy($pharmacy_id);
        $completed_orders = $this->pharmacyModel->getAllCompletedOrdersForPharmacy($pharmacy_id);
        $cancelled_orders = $this->pharmacyModel->getAllCancelledOrdersForPharmacy($pharmacy_id);
        $today_orders = $this->pharmacyModel->getOrdersForToday($pharmacy_id);
        
        // Create data array with calculated values
        $data = [
            'total_orders' => $total_orders,
            'pending_orders' => $pending_orders,
            'completed_orders' => $completed_orders,
            'cancelled_orders' => $cancelled_orders,
            'today_orders' => $today_orders,
        ];
        
        // Load the view with data
        $this->view('pharmacy/pharmacyorders', $data);
    }
    
    public function pharmacyProfile(){
        try{
        $pharmacy = $this->pharmacyModel->getPharmacyByUserId($_SESSION['user_id']);
        $data=[
            'pharmacy' => $pharmacy
        ];
        //var_dump($pharmacy);
        $this->view('pharmacy/pharmacy-profile-updated',$data);
        }
        catch(Exception $e){
            echo "An error occurred: " . $e->getMessage();
        }
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


public function viewPendingOrders(){
    $pharmacy_id = $this->pharmacyModel->getPharmacyId($_SESSION['user_id'])->pharmacy_id;
    // $data['pending_orders'] = $this->pharmacyModel->getPendingOrders($pharmacy_id);

    //var_dump($data['pending_orders']);
    //$pharmacy_id = $this->pharmacyModel->getPharmacyByUserId($_SESSION['user_id'])->pharmacy_id;
        
        // Calculate all values upfront
        $total_orders = $this->pharmacyModel->getTotalOrders($pharmacy_id);
        $pending_orders = $this->pharmacyModel->getAllPendingOrdersForPharmacy($pharmacy_id);
        $completed_orders = $this->pharmacyModel->getAllCompletedOrdersForPharmacy($pharmacy_id);
        $cancelled_orders = $this->pharmacyModel->getAllCancelledOrdersForPharmacy($pharmacy_id);
        $today_orders = $this->pharmacyModel->getOrdersForToday($pharmacy_id);
        
        // Create data array with calculated values
        $data = [
            'orders' => $this->pharmacyModel->getPendingOrders($pharmacy_id),
            'total_orders' => $total_orders,
            'orders_pending' => $pending_orders,
            'completed_orders' => $completed_orders,
            'cancelled_orders' => $cancelled_orders,
            'today_orders' => $today_orders,
        ];

    $this->view('pharmacy/pharmacyorders', $data);
}

public function getPrescriptionDetails($order_id){
   $health_record_id = $this->pharmacyModel->getHealthRecordIdFromOrder($order_id);
   
    $data=[
        'order_id' => $order_id,
        'health_record_id' => $this->pharmacyModel->getHealthRecordIdFromOrder($order_id),
        'medicines'=>$this->pharmacyModel->getmedicinesInPrescription($health_record_id),
        'patient_details'=>$this->pharmacyModel->getPatientDetailsFromOrder($order_id),
        'order_details'=>$this->pharmacyModel->getOrderById($order_id),
    ];

    echo json_encode($data);
    exit();

}

public function updateOrderStatus($order_id = null) {
    // Get JSON data from request body
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);
    
    // Extract status from JSON data
    $status = $data['status'];
    // Get order_id from JSON if not provided in URL
    $order_id = $order_id ?? $data['orderId'];
    
    $updated = $this->pharmacyModel->updateOrderStatus($order_id, $status);
    
    // Set proper JSON content type header
    header('Content-Type: application/json');
    
    if ($updated) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    
    exit();
}

public function markOrderAsProcessed() {
    header('Content-Type: application/json');

    // Read POST first
    $order_id = $_POST['order_id'] ?? null;

    // Now validate
    if (empty($order_id)) {
        echo json_encode(['success' => false, 'message' => 'Order ID is missing']);
        exit();
    }
    
    $isProcessed = $this->pharmacyModel->markOrderAsProcessed($order_id);

    // Return JSON response
    echo json_encode(['success' => $isProcessed]);
    exit();
}



public function updateProfileInfo(){
    try{
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pharmacy_id = $this->pharmacyModel->getPharmacyByUserId($_SESSION['user_id'])->pharmacy_id;
        $dataForApprovedPharmacyTable = [
            'pharmacy_name' => $_POST['pharmacy_name'],
            'contact_person' => $_POST['owner_name'],
            // 'email' => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
            'contact1' => $_POST['contact1'],
            'contact2' => $_POST['contact2'],
            // 'specialization' => trim($_POST['specialization']),
            // 'license' => trim($_POST['licenseNo']),
            // 'bio' => trim($_POST['bio']),
            'street' => $_POST['street'],
            'city' => $_POST['city'],
            'state' => $_POST['state'],
            'start_time'=> $_POST['start_time'],
            'end_time'=> $_POST['end_time']

        ];
        

      $this->pharmacyModel->updatePharmacyProfile($pharmacy_id,$dataForApprovedPharmacyTable); 
      $this->pharmacyProfile();

        
        
    } }catch(Exception $e){
        // Handle the exception here (e.g., log it, show an error message, etc.)
        echo 'Error: ' . $e->getMessage();
    }



}
}