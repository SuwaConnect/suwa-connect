<?php

class m_doctor
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function registerNewDoctor($data){
        $this->db->query('INSERT INTO pending_doctors (firstName,lastName,email,contact_no,slmc_no,medicalLicenseCopyName,password) VALUES (:first_name,:last_name,:email,:contact_no,:slmc_no,:medical_license_copy,:password)');
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':slmc_no', $data['slmc_no']);
        $this->db->bind(':medical_license_copy', $data['medical_license_copy']);
        $this->db->bind(':password', $data['password']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
}

public function doctorLogIn($email, $password) {
    $this->db->query('SELECT * FROM pending_doctors WHERE email = :email');
    $this->db->bind(':email', $email);
    $row = $this->db->single();
    //var_dump($row);
    
    if($row->password && $row->verification_status == 'approved') {
        $verify_result = password_verify($password, $row->password);
        if($verify_result) {
            return $row;
        }
    }
    return false;
}

public function doctorStillnotApproved($email){
    $this->db->query('SELECT * FROM pending_doctors WHERE email = :email');
    $this->db->bind(':email', $email);
    $row = $this->db->single();
    if($row->verification_status == 'pending'){
        return true;
    } else {
        return false;
    }
}

public function getPendingDoctors(){
    $this->db->query('SELECT * FROM pending_doctors WHERE verification_status = "pending"');
    $results = $this->db->resultSet();
    return $results;
    #var_dump($results);
}

public function markPendingDoctorAsApproved($doctor_id){
    $this->db->query('UPDATE pending_doctors SET verification_status = "approved" WHERE doctor_id = :id');
    $this->db->bind(':id', $doctor_id);
    if($this->db->execute()){
        return true;
    } else {
        return false;
    }
}

public function rejectDoctor($doctor_id){
    $this->db->query('UPDATE pending_doctors SET verification_status = "rejected" WHERE doctor_id = :id');
    $this->db->bind(':id', $doctor_id);
    if($this->db->execute()){
        return true;
    } else {
        return false;
    }
}

public function getDoctorByIdFromPendingDoctors($doctor_id){
    $this->db->query('SELECT * FROM pending_doctors WHERE doctor_id = :id');
    $this->db->bind(':id', $doctor_id);
    $row = $this->db->single();
    return $row;
}

public function getDoctorByIdFromApprovedDoctors($doctor_id){
    $this->db->query('SELECT * FROM approved_doctors WHERE doctor_id = :id');
    $this->db->bind(':id', $doctor_id);
    $row = $this->db->single();
    return $row;
}

public function insertApprovedDoctor($doctorData) {
    $this->db->query('INSERT INTO approved_doctors 
                     (user_id, name, email, specialization, experience, qualifications)
                     VALUES (:user_id, :name, :email, :specialization, :experience, :qualifications)');
    
    $this->db->bind(':user_id', $doctorData['user_id']);
    $this->db->bind(':name', $doctorData['name']);
    $this->db->bind(':email', $doctorData['email']);
    $this->db->bind(':specialization', $doctorData['specialization']);
    $this->db->bind(':experience', $doctorData['experience']);
    $this->db->bind(':qualifications', $doctorData['qualifications']);
    
    if($this->db->execute()) {
        return $this->db->lastInsertId();
    }
    return false;
}

}