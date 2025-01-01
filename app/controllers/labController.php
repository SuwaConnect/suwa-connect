<?php

class labController extends controller{

private $labModel;

public function __construct(){
    

}

public function labSignIn(){
    $this->view('labs/labsignin');
}

public function labHomePage(){
    $this->view('labs/labhome');
}

public function labNotifications(){
    $this->view('labs/labnotifications');
}

public function labProfile(){
    $this->view('labs/labprofile');
}


}