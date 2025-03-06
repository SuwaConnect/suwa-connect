<?php 

class profileController extends Controller{

    private $profileModel;

    public function __construct(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->profileModel = $this->model('userModel');
       
    }

    public function changeProfilePicture(){

    $user = $this->profileModel->getUserById($_SESSION['user_id']);
    $role = $user->role;
    $newFileName = '';
    $allowed = array('jpg', 'jpeg', 'png');
    $uploadDir = __DIR__.'/../../public/uploads/profile_pictures/'.$role.'/';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_FILES['profile_picture'])){
                $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
                $fileName = basename($_FILES['profile_picture']['name']);
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $newFileName = uniqid('profile_', true) . '.' . $fileExtension;
                $newFilepath = $uploadDir.$newFileName;
                if(in_array($fileExtension, $allowed)){
                    if(move_uploaded_file($fileTmpPath, $uploadDir.$newFileName)){
                        $this->profileModel->updateProfilePicture($newFileName, $_SESSION['user_id']);
                        if($role == 'doctor'){
                            $this->profileModel->updateDoctorProfilePicture($newFileName, $_SESSION['user_id']);
                            echo 'success';
                        }else if($role == 'patient'){
                            $this->profileModel->updatePatientProfilePicture($newFileName, $_SESSION['user_id']);
                            echo 'success';
                        
                        } else if($role == 'admin'){
                            $this->profileModel->updateAdminProfilePicture($newFileName, $_SESSION['user_id']);
                            echo 'success';
                        }elseif($role=='laboratory'){
                            $this->profileModel->updateLaboratoryProfilePicture($newFileName, $_SESSION['user_id']);
                            echo 'success';
                        }
                    
                        else {
                            echo 'error';
                        }
                } else {
                    echo 'error';
                }
            }
        }
    }


}
}