<?php

class requestPermission {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


public function getDoctorIdByUserId($userId) {
    $this->db->query("SELECT doctor_id FROM approved_doctors WHERE user_id = :user_id");
    $this->db->bind(':user_id', $userId);
    $result = $this->db->single();
    
    return $result->doctor_id ?? null;
}

public function getPatientById($userId) {
    $this->db->query("SELECT * FROM patients WHERE patient_id = :user_id");
    $this->db->bind(':user_id', $userId);
    $result = $this->db->single();
    
    return $result ?? 'none';
}



public function getRequestStatus($doctorId, $patientId) {
    $this->db->query("SELECT status FROM permission_requests 
                     WHERE doctor_id = :doctor_id 
                     AND patient_id = :patient_id");
    
    $this->db->bind(':doctor_id', $doctorId);
    $this->db->bind(':patient_id', $patientId);
    
    $result = $this->db->single();
    
    return $result ? $result->status : 'none';
}

public function sendAccessRequest($doctorId,$patientId){
    try{
        $this->db->query("INSERT INTO permission_requests (doctor_id, patient_id, status) 
                         VALUES (:doctor_id, :patient_id, 'pending')");
        $this->db->bind(':doctor_id', $doctorId);
        $this->db->bind(':patient_id', $patientId);
        
        if ($this->db->execute()) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Permission request sent successfully'
            ]);
            exit;
        } else {
            throw new Exception('Failed to send permission request');
        }
        
    } catch (Exception $e){
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

public function checkAccessPermission($doctorId, $patientId) {
    $this->db->query("SELECT status FROM permission_requests 
                     WHERE doctor_id = :doctor_id 
                     AND patient_id = :patient_id");
    $this->db->bind(':doctor_id', $doctorId);
    $this->db->bind(':patient_id', $patientId);
    
    $result = $this->db->single();
    
    return $result && $result->status === 'approved';
}


}