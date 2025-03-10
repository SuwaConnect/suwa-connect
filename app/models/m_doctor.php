<?php

class m_doctor
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function registerNewDoctor($data){
        $this->db->query('INSERT INTO pending_doctors (firstName,lastName,email,contact_no,slmc_no,medicalLicenseCopyName,password,status) VALUES (:first_name,:last_name,:email,:contact_no,:slmc_no,:medical_license_copy,:password,:status)');
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':slmc_no', $data['slmc_no']);
        $this->db->bind(':medical_license_copy', $data['medical_license_copy']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':status', 'pending');

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
}



public function doctorStillnotApproved($email){
    $this->db->query('SELECT * FROM pending_doctors WHERE email = :email');
    $this->db->bind(':email', $email);
    $row = $this->db->single();
    if($row->status == 'pending'){
        return true;
    } else {
        return false;
    }
}

public function getPendingDoctors(){
    $this->db->query('SELECT * FROM pending_doctors WHERE status = "pending"');
    $results = $this->db->resultSet();
    return $results;
    #var_dump($results);
}

public function markPendingDoctorAsApproved($doctor_id){
    $this->db->query('UPDATE pending_doctors SET status = "approved" WHERE doctor_id = :id');
    $this->db->bind(':id', $doctor_id);
    if($this->db->execute()){
        return true;
    } else {
        return false;
    }
}

public function rejectDoctor($doctor_id){
    $this->db->query('UPDATE pending_doctors SET status = "rejected" WHERE doctor_id = :id');
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
                     (user_id, firstName,lastName,contact_no,slmc_no,medicalLicenseCopyName)
                     VALUES (:user_id, :firstName,:lastName,:contact_no,:slmc_no, :medicalLicenseCopyName)');
    
    $this->db->bind(':user_id', $doctorData['user_id']);
    $this->db->bind(':firstName', $doctorData['firstName']);
    $this->db->bind(':lastName', $doctorData['lastName']);
    $this->db->bind(':slmc_no', $doctorData['slmc_no']);
    $this->db->bind(':contact_no', $doctorData['contact_no']);
    $this->db->bind(':medicalLicenseCopyName', $doctorData['medicalLicenseCopyName']);
    
    if($this->db->execute()) {
        //return $this->db->lastInsertId();
        return true;
    }
    return false;
}

public function getDoctorIdByUserId($user_id){
    $this->db->query('SELECT doctor_id FROM approved_doctors WHERE user_id = :user_id');
    $this->db->bind(':user_id', $user_id);
    $row = $this->db->single();
    return $row->doctor_id;
}

public function getCountOfNewappointments($user_id){
    $doctor_id = $this->getDoctorIdByUserId($user_id);
    $this->db->query('SELECT COUNT(*) as count FROM appointments WHERE doctor_id = :user_id AND status = "pending"');
    $this->db->bind(':user_id', $doctor_id);
    $row = $this->db->single();
    return $row;
}

public function getAppointments($user_id){
    $doctor_id = $this->getDoctorIdByUserId($user_id);
    $this->db->query("SELECT a.*, p.first_name, p.last_name ,t.slot_time
                      FROM appointments a
                      INNER JOIN patients p ON a.patient_id = p.patient_id
                      Inner JOIN timeslots t ON a.timeslot_id = t.timeslot_id
                      WHERE a.doctor_id = :user_id 
                      AND a.status = 'confirmed' 
                      AND a.consult_status = 'not consulted' 
                      AND a.appointment_date = CURDATE() 
                      ORDER BY a.appointment_date ASC");
    $this->db->bind(':user_id', $doctor_id);
    $results = $this->db->resultSet();
    return $results;
}

public function getConsultations($user_id){
    $doctor_id = $this->getDoctorIdByUserId($user_id);
    $this->db->query("SELECT a.*, p.first_name, p.last_name ,t.slot_time
                      FROM appointments a
                      INNER JOIN patients p ON a.patient_id = p.patient_id
                      Inner JOIN timeslots t ON a.timeslot_id = t.timeslot_id
                      WHERE a.doctor_id = :user_id 
                      AND a.status = 'confirmed' 
                      AND a.consult_status = 'consulted' 
                      AND a.appointment_date >= CURDATE() 
                      ORDER BY a.appointment_date ASC");
    $this->db->bind(':user_id', $doctor_id);
    $results = $this->db->resultSet();
    return $results;
}



}