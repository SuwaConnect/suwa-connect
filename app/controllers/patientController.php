<?php 
class patientController extends Controller {

    private $patientModel;

    public function __construct() {
        #$this->patientModel = $this->model('Patient');
    }

    public function confirmRequest() {
        $this->view('patient/confirmRequest');
    }

    
}