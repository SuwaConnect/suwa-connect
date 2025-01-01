<?php

class pharmacyController extends Controller {
    
    private $pharmacyModel;

    public function __construct(){
       
    }

    public function pharmacySignIn(){
        $this->view('pharmacy/pharmacylogin');
    }
}