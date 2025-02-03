<?php

class pharmacyController extends Controller {
    
    private $pharmacyModel;

    public function __construct(){
       
    }

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

    public function pharmacySignUp(){
        $this->view('pharmacy/pharmacysignup');
    }
}