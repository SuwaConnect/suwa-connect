<?php

class adminController extends Controller
{
    private $adminModel;
    private $userModel;

    public function __construct(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->adminModel = $this->model('m_admin');
    }

    public function home(){
        $this->view('admin/adminhome');
    }

    public function appointments(){
        $this->view('admin/adminappointments');
    }

    public function notifications(){
        $this->view('admin/adminnotifications');
    }

    public function revenue(){
        $this->view('admin/adminrevenue');
    }

    public function settings(){
        $this->view('admin/adminsettings');
    }

    public function signin(){
        $this->view('admin/admin signin');
    }

    public function support(){
        $this->view('admin/adminsupport');
    }

    public function usermanagement(){
        $this->view('admin/adminusermanagement');
    }

    public function pendingDoctors(){
        $this->view('admin/pendingDoctors');
    }

} 