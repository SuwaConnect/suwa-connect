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

public function getDoctorinfoFromUsersTable($user_id){
    $this->db->query('SELECT * FROM users WHERE user_id = :id');
    $this->db->bind(':id', $user_id);
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

public function getCountOfTodayappointments($user_id){
    $doctor_id = $this->getDoctorIdByUserId($user_id);
    $this->db->query('SELECT COUNT(*) as count FROM appointments WHERE doctor_id = :doctor_id AND status = "SCHEDULED" AND appointment_date = CURDATE() ');
    $this->db->bind(':doctor_id', $doctor_id);
    $row = $this->db->single();
    return $row->count;
}

public function getCountOfPatientsConsulted($user_id){
    $doctor_id = $this->getDoctorIdByUserId($user_id);
    $this->db->query('SELECT COUNT(*) as count FROM appointments WHERE doctor_id = :doctor_id AND status = "COMPLETED" AND appointment_date = CURDATE() ');
    $this->db->bind(':doctor_id', $doctor_id);
    $row = $this->db->single();
    return $row->count;
}

public function getTotalPatientsForDoctor($user_id){
    $doctor_id = $this->getDoctorIdByUserId($user_id);
    $this->db->query('SELECT COUNT(*) as count FROM permission_requests WHERE doctor_id = :doctor_id AND status = "approved" ');
    $this->db->bind(':doctor_id', $doctor_id);
    $row = $this->db->single();
    return $row->count;
}

public function getTodaysSessions($user_id){
    $doctor_id = $this->getDoctorIdByUserId($user_id);
    $this->db->query('SELECT * FROM doctor_sessions WHERE doctor_id = :doctor_id AND session_date = DAYNAME(CURDATE()) ');
    $this->db->bind(':doctor_id', $doctor_id);
    $results = $this->db->resultSet();
    return $results;
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

// public function getConsultations($user_id){
//     $doctor_id = $this->getDoctorIdByUserId($user_id);
//     $this->db->query("SELECT a.*, p.first_name, p.last_name ,t.slot_time
//                       FROM appointments a
//                       INNER JOIN patients p ON a.patient_id = p.patient_id
//                       Inner JOIN timeslots t ON a.timeslot_id = t.timeslot_id
//                       WHERE a.doctor_id = :user_id 
//                       AND a.status = 'confirmed' 
//                       AND a.consult_status = 'consulted' 
//                       AND a.appointment_date >= CURDATE() 
//                       ORDER BY a.appointment_date ASC");
//     $this->db->bind(':user_id', $doctor_id);
//     $results = $this->db->resultSet();
//     return $results;
// }

public function updateProfileInfo($doctor_id,$data){
    $this->db->query('UPDATE approved_doctors SET firstName = :first_name, lastName = :last_name, contact_no = :contact_no,contact_no2 = :contact_no2,specialization = :specialization,slmc_no = :slmc_no,bio = :bio, street =:street ,city= :city, state = :state,appointment_charges = :appointment_charges WHERE doctor_id = :doctor_id');
    $this->db->bind(':doctor_id', $doctor_id);
    $this->db->bind(':first_name', $data['first_name']);
    $this->db->bind(':last_name', $data['last_name']);
    $this->db->bind(':contact_no', $data['contact1']);
    $this->db->bind(':contact_no2', $data['contact2']);
    $this->db->bind(':specialization', $data['specialization']);
    $this->db->bind(':bio', $data['bio']);
    $this->db->bind(':slmc_no', $data['license']);
    $this->db->bind(':street', $data['street']);
    $this->db->bind(':city', $data['city']);
    $this->db->bind(':state', $data['state']);
    $this->db->bind(':appointment_charges', $data['appointment_charges']);

    if($this->db->execute()){
        return true;
    } else {
        return false;
    }
}



}