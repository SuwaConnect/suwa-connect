<?php

class HomeController extends Controller
{
    private $postModel;

    public function __construct()
    {
        
    }

    public function index()
    {
        $this->view('user/home');
    }

    public function doctor_landing() {
        $this->view('user/index_doctors');
    }
    
    public function organization_landing() {
        $this->view('user/index_organisations');
    }

    public function patientSignIn()
    {
        $this->view('user/login');
    }

    public function selectActor()
    {
        $this->view('user/selectActorforSignup');
    }
}