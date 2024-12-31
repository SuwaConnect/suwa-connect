<?php

class pages extends Controller
{
    private $pagesModel;

public function __construct(){
$this->pagesModel=$this->model('m_pages');
}

public function index($name,$age){
$data=[
'name'=>$name,
'age'=>$age
];

$this->view('v_about',$data);
}

public function users(){
    $users = $this->pagesModel->getUsers();
    $data = [
        'users' => $users
    ];

    $this->view('v_about', $data);

}
}