<?php

class requestPermission {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function createRequest($doctorId, $patientId) {
        // Check for existing pending request
        $this->db->query("SELECT id FROM permission_requests 
                         WHERE doctor_id = :doctor_id 
                         AND patient_id = :patient_id 
                         AND status = 'pending'");
        $this->db->bind(':doctor_id', $doctorId);
        $this->db->bind(':patient_id', $patientId);
        
        if ($this->db->single()) {
            return [
                'status' => 'error',
                'message' => 'A request is already pending for this patient'
            ];
        }
        
        // Create new request
        $this->db->query("INSERT INTO permission_requests (doctor_id, patient_id, status) 
                         VALUES (:doctor_id, :patient_id, 'pending')");
        $this->db->bind(':doctor_id', $doctorId);
        $this->db->bind(':patient_id', $patientId);
        
        if ($this->db->execute()) {
            return [
                'status' => 'success',
                'message' => 'Permission request sent successfully'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to send permission request'
            ];
        }
    }
    
    public function checkPermission($doctorId, $patientId) {
        $this->db->query("SELECT status FROM permission_requests 
                         WHERE doctor_id = :doctor_id 
                         AND patient_id = :patient_id 
                         AND status = 'approved'
                         ORDER BY updated_at DESC LIMIT 1");
        
        $this->db->bind(':doctor_id', $doctorId);
        $this->db->bind(':patient_id', $patientId);
        
        return (bool) $this->db->single();
    }

    // app/models/Permission.php
public function getPendingRequests($patientId) {
    $this->db->query("SELECT * from permission_requests 
                     WHERE patient_id = :patient_id 
                     AND status = 'pending'");
                     
    $this->db->bind(':patient_id', $patientId);
    
    return $this->db->resultSet();
}

public function updateRequestStatus($requestId, $status, $patientId) {
    // Verify the request belongs to this patient
    $this->db->query("UPDATE permission_requests 
                     SET status = :status, 
                         updated_at = NOW() 
                     WHERE id = :request_id 
                     AND patient_id = :patient_id");
                     
    $this->db->bind(':status', $status);
    $this->db->bind(':request_id', $requestId);
    $this->db->bind(':patient_id', $patientId);
    
    if ($this->db->execute()) {
        return [
            'status' => 'success',
            'message' => 'Request ' . ($status === 'approved' ? 'approved' : 'denied') . ' successfully'
        ];
    }
    
    return [
        'status' => 'error',
        'message' => 'Failed to update request status'
    ];
}
}