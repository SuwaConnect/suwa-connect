<?php

class patientModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getPatientByUserId($user_id) {
        $this->db->query('SELECT * FROM patients WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }

    public function registerNewPatient($data) {
        $this->db->query('INSERT INTO patients(user_id,first_name,last_name,nic_no,gender,email,contact_no,dob,address ) 
        VALUES (:user_id,:first_name, :last_name, :nic_no, :gender, :email, :contact_no, :dob, :address)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':nic_no', $data['nic']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':address', $data['address']);
        

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }

}

public function getRecentVitalSigns($patient_id) {
    // Get the most recent vital signs for a specific patient by joining tables
    $this->db->query('SELECT vs.* ,hr.created_at
                     FROM vital_signs vs
                     JOIN health_records hr ON vs.record_id = hr.record_id
                     WHERE hr.patient_id = :patient_id
                     ORDER BY hr.created_at ASC LIMIT 7');
    $this->db->bind(':patient_id', $patient_id);
    return $this->db->resultSet();
}

}