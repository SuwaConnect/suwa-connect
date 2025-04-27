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

public function getAllMedicalRecordsForPatient($patient_id) {
    // Get all medical records with count of reports
    $this->db->query('
        SELECT hr.*, 
               vs.*, 
               ad.firstName, 
               ad.lastName, 
               hr.created_at AS record_created_at,
               COUNT(r.report_id) AS report_count
        FROM health_records hr
        JOIN approved_doctors ad ON hr.doctor_id = ad.doctor_id
        JOIN vital_signs vs ON hr.record_id = vs.record_id
        LEFT JOIN reports r ON hr.record_id = r.health_record_id
        WHERE hr.patient_id = :patient_id
        GROUP BY hr.record_id
        ORDER BY hr.created_at DESC
    ');
    $this->db->bind(':patient_id', $patient_id);
    return $this->db->resultSet();
}

public function searchHealthrecord($patient_id, $searchTerm) {
    // Search health records based on the search term
    try{
    $this->db->query('
        SELECT hr.*, 
               vs.*, 
               ad.firstName, 
               ad.lastName, 
               hr.created_at AS record_created_at,
               COUNT(r.report_id) AS report_count
        FROM health_records hr
        JOIN approved_doctors ad ON hr.doctor_id = ad.doctor_id
        JOIN vital_signs vs ON hr.record_id = vs.record_id
        LEFT JOIN reports r ON hr.record_id = r.health_record_id
        WHERE hr.patient_id = :patient_id AND (ad.firstName LIKE :searchTerm OR ad.lastName LIKE :searchTerm OR hr.created_at LIKE :searchTerm OR hr.chief_complaint LIKE :searchTerm OR hr.diagnosis LIKE :searchTerm )
        GROUP BY hr.record_id
        ORDER BY hr.created_at DESC
    ');
    $this->db->bind(':patient_id', $patient_id);
    $this->db->bind(':searchTerm', '%' . $searchTerm . '%');
    return $this->db->resultSet();}
    catch (Exception $e) {
        // Handle exception (e.g., log the error, show an error message)
        echo "Error: " . $e->getMessage();
    }

}

public function getDoctorsWithAccess($patient_id) {
    // Get all doctors who have access to the patient's health records
    $this->db->query('
        SELECT pr.*,ad.* from permission_requests pr
        JOIN approved_doctors ad ON pr.doctor_id = ad.doctor_id
        WHERE pr.patient_id = :patient_id AND pr.status = "approved"
    ');
    $this->db->bind(':patient_id', $patient_id);
    return $this->db->resultSet();
}

public function revokeAccess($doctor_id, $patient_id) {
    // Revoke access for a specific doctor to the patient's health records
    $this->db->query('DELETE FROM permission_requests WHERE doctor_id = :doctor_id AND patient_id = :patient_id');
    $this->db->bind(':doctor_id', $doctor_id);
    $this->db->bind(':patient_id', $patient_id);
    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }

}

public function createLabAppointment($lab_id, $patient_id, $test_name,$appointment_date, $appointment_time) {
    // Create a lab appointment for a specific patient
    $this->db->query('INSERT INTO lab_appointments_requests (lab_id, patient_id,test_name, appointment_date, appointment_time) VALUES (:lab_id, :patient_id, :test_name,:appointment_date, :appointment_time)');
    $this->db->bind(':lab_id', $lab_id);
    $this->db->bind(':patient_id', $patient_id);
    $this->db->bind(':test_name', $test_name); // Assuming a default test type for now
    $this->db->bind(':appointment_date', $appointment_date);
    $this->db->bind(':appointment_time', $appointment_time);
    
    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

public function updatePatientProfile($data){
    // Update patient profile information
    $this->db->query('UPDATE patients SET first_name = :first_name, last_name = :last_name, contact_no = :contact_no,  address = :address,height= :height,blood_type =:blood_type , chronic_conditions= :chronic_conditions ,allergies = :allergies ,past_surgeries = :past_surgeries, additional_health_notes= :additional_health_notes WHERE patient_id = :patient_id');
    $this->db->bind(':first_name', $data['first_name']);
    $this->db->bind(':last_name', $data['last_name']);
    $this->db->bind(':contact_no', $data['contact_no']);
    $this->db->bind(':address', $data['address']);
    $this->db->bind(':height', $data['height']);
    $this->db->bind(':blood_type', $data['blood_type']);
    $this->db->bind(':chronic_conditions', $data['chronic_conditions']);
    $this->db->bind(':allergies', $data['allergies']);
    $this->db->bind(':past_surgeries', $data['past_surgeries']);
    $this->db->bind(':additional_health_notes', $data['additional_health_notes']);
    $this->db->bind(':patient_id', $data['patient_id']);
    
    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

}