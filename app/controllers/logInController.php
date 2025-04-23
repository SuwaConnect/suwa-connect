<?php

class logInController extends controller{

    private  $loginModel;

    public function __construct(){
        $this->loginModel = $this->model('logInModel');
    }

 

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('login');
        }

        // Sanitize and validate input
        $data = $this->validateLoginInput();
        
        if (!empty($data['errors']['email']) || !empty($data['errors']['password'])) {
            $this->view('user/login', $data);
            return;
        }

        // Attempt login
        $result = $this->loginModel->verifyCredentials($data['email'], $data['password']);

        switch ($result['status']) {
            case 'approved':
                $this->createUserSession($result['data']);
                $this->redirectBasedOnRole($result['data']->role);
                break;
            
            case 'pending':
                // Store necessary info in session for the status page
                $_SESSION['temp_status'] = [
                    'type' => 'pending',
                    'message' => $result['message'],
                    'user_type' => $result['type'],
                    'email' => $data['email']
                ];
                redirect(URLROOT . '/login/status');
                break;
            
            case 'rejected':
                // Store necessary info in session for the status page
                $_SESSION['temp_status'] = [
                    'type' => 'rejected',
                    'message' => $result['message'],
                    'rejection_reason' => $result['data']->rejection_reason ?? 'No reason provided',
                    'email' => $data['email']
                ];
                redirect(URLROOT . '/login/status');
                break;
            
            case 'invalid':
                $data['errors']['login'] = $result['message'];
                $this->view('user/login', $data);
                break;
        }
    }

    public function status() {
        if (!isset($_SESSION['temp_status'])) {
            redirect('login');
        }

        $data = [
            'status' => $_SESSION['temp_status']
        ];

        // Clear the temporary session data after displaying
        unset($_SESSION['temp_status']);

        $this->view('users/account_status', $data);
    }

    private function redirectBasedOnRole($role) {
        switch ($role) {
            case 'admin':
                header('location: ' . URLROOT . 'adminController/home');
                break;
            case 'doctor':
                header('location: ' . URLROOT . 'doctor/home');
                break;
            case 'patient':
                header('location: ' . URLROOT . 'patientcontroller/dashboard');
                break;
            case 'pharmacy':
                header('location: ' . URLROOT . 'pharmacycontroller/pharmacyHome');
                break;
            case 'lab':
                header('location: ' . URLROOT . 'labcontroller/labhomepage');
                break;
            default:
                header('location: ' . URLROOT . 'login');
                break;
        }
    }



    private function validateLoginInput() {
        $data = [
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'errors' => [
                'email' => '',
                'password' => ''
            ]
        ];

        if (empty($data['email'])) {
            $data['errors']['email'] = 'Please enter email';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $data['errors']['email'] = 'Please enter a valid email';
        }

        if (empty($data['password'])) {
            $data['errors']['password'] = 'Please enter password';
        }

        return $data;
    }

    public function createUserSession($user) {
        session_start();
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['role'] = $user->role;
        $_SESSION['user_name'] = $user->user_name;
        $_SESSION['profile_picture'] = $user->profile_picture;
        
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['role']);
        session_destroy();
        header('location: ' . URLROOT . 'homecontroller/index');
    }

    public function isLoggedIn() {
        if(isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    

}
