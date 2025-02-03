<?php

class logInController extends controller{

    private  $loginModel;

    public function __construct(){
        $this->loginModel = $this->model('m_doctor');
    }

    public function logIn() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'email_error' => '',
                'password_error' => ''
            ];
    
            // Validate inputs
            if(empty($data['email'])) {
                $data['email_error'] = 'Please enter email';
            }
            if(empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            }
    
            // Only attempt login if there are no errors
            if(empty($data['email_error']) && empty($data['password_error'])) {
                $loggedInUser = $this->loginModel->doctorLogIn($data['email'], $data['password']);
                
                if($loggedInUser) {
                    // You might want to start a session here
                    $this->createUserSession($loggedInUser);
                    header('location: ' . URLROOT . 'doctor/home');
                    
                }elseif($this->loginModel->doctorStillnotApproved($data['email'])){
                    echo 'please wait until your account is approved...';
                } 
                
                else {
                    echo 'Incorrect email or password';
                }
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => ''
            ];
        }
    }


    public function createUserSession($user) {
        
        $_SESSION['user_id'] = $user->doctor_id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->firstName;
        header('location: ' . URLROOT . '/doctor/home');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        header('location: ' . URLROOT . '/homecontroller/index');
    }

    public function isLoggedIn() {
        if(isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

}