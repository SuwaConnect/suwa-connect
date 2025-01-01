<?php

class labController extends controller{

private $labModel;

public function __construct(){
    

}

public function labSignIn(){
    $this->view('labs/labsignin');
}


}