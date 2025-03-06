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
    $this->view('labs/notifications');
}

public function labProfile(){
    $this->view('labs/labprofile');
}

public function labReports(){
    $this->view('labs/labreports');
}

public function labRevenue(){
    $this->view('labs/labRevenue');
}

public function labSchedule(){
    $this->view('labs/labschedule');
}

public function labSettings(){
    $this->view('labs/labsettings');
}

public function labSupport(){
    $this->view('labs/labsupport');
}

public function labTestRequests(){
    $this->view('labs/labtestRequests');
}

public function labAppointments(){
    $this->view('labs/labappointments');

}

}