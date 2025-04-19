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

public function getDoctorById($userId) {
    $this->db->query("SELECT * FROM approved_doctors WHERE user_id = :user_id");
    $this->db->bind(':doctor_id', $userId);
    $result = $this->db->single();
    
    return $result;
}

public function getPatientById($userId) {
    $this->db->query("SELECT * FROM patients WHERE user_id = :user_id");
    $this->db->bind(':user_id', $userId);
    $result = $this->db->single();
    
    return $result;
}

public function getPatientByPatientId($patientId) {
    $this->db->query("SELECT * FROM patients WHERE patient_id = :patient_id");
    $this->db->bind(':patient_id', $patientId);
    $result = $this->db->single();
    
    return $result;
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

public function getPendingRequests($patient_id){
    $this->db->query(" SELECT pr.id, pr.status, pr.patient_id,pr.doctor_id, pr.requested_at,
               d.firstName,
               d.lastName
        FROM permission_requests pr
        JOIN approved_doctors d ON pr.doctor_id = d.doctor_id
        WHERE pr.status = 'pending'
        AND pr.patient_id = :patient_id");
    $this->db->bind(':patient_id', $patient_id);

    $result = $this->db->resultSet();
    
    return $result;
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
    $this->db->query("SELECT * FROM permission_requests 
                      WHERE doctor_id = :doctor_id 
                      AND patient_id = :patient_id");
    $this->db->bind(':doctor_id', $doctorId);
    $this->db->bind(':patient_id', $patientId);
    
    $result = $this->db->single();

    // Check if result is valid
    if ($result && $result->status == 'approved') {
        return true;
    } else {
        return false;
    }
}


public function updateRequest($requestId, $status) {
    $this->db->query("UPDATE permission_requests 
                     SET status = :status 
                     WHERE id = :request_id");
    $this->db->bind(':status', $status);
    $this->db->bind(':request_id', $requestId);
    
    if ($this->db->execute()) {
        return [
            'success' => true,
            'message' => 'Request updated successfully'
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Failed to update request'
        ];
    }


}

}