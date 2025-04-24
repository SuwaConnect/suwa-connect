
<?php

class pharmacyModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Assuming Database class is already defined
    }

    public function getPharmacyId($user_id) {
        $this->db->query('SELECT pharmacy_id FROM approved_pharmacy WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }
    
    

    public function addPendingpharmacy($data) {
        try{
        $this->db->query('INSERT INTO pending_pharmacy (pharmacy_name, contact_person, email, contact_no, pharmacy_reg_number, pharmacy_license_copy, password, terms_accepted) VALUES (:pharmacy_name, :contact_person, :email, :contact_no, :pharmacyRegNo, :pharmacy_license_copy, :password, :terms_accepted)');
        $this->db->bind(':pharmacy_name', $data['pharmacy_name']);
        $this->db->bind(':contact_person', $data['contact_person']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':pharmacyRegNo', $data['pharmacyRegNo']);
        $this->db->bind(':pharmacy_license_copy', $data['pharmacy_license_copy']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':terms_accepted', $data['terms_accepted']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        } catch (Exception $e) {
            // Handle exception (e.g., log the error, return false, etc.)
            return false;
        }
    }

    public function markPendingPharmacyAsApproved($pharmacy_id){
        $this->db->query('UPDATE pending_pharmacy SET status = "approved" WHERE pharmacy_id = :id');
        $this->db->bind(':id', $pharmacy_id);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getPendingpharmacies(){
        $this->db->query('SELECT * FROM pending_pharmacy WHERE status = "pending"');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPharmacyByIdFromPendingPharmacies($pharmacy_id) {
        $this->db->query('SELECT * FROM pending_pharmacy WHERE pharmacy_id = :id');
        $this->db->bind(':id', $pharmacy_id);
    
        return $this->db->single();
    }

    public function insertApprovedPharmacy($data) {
        $this->db->query('INSERT INTO approved_pharmacy (user_id, pharmacy_name, contact_person, pharmacy_reg_number, contact_no, pharmacy_license_copy) VALUES (:user_id, :pharmacy_name, :contact_person, :pharmacy_reg_number, :contact_no, :pharmacy_license_copy)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':pharmacy_name', $data['pharmacy_name']);
        $this->db->bind(':contact_person', $data['contact_person']);
        $this->db->bind(':pharmacy_reg_number', $data['pharmacy_reg_no']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':pharmacy_license_copy', $data['pharmacyLicenseCopyName']);

        return $this->db->execute();
    }

    public function searchPharmacy($searchTerm){
        $this->db->query('SELECT * FROM approved_pharmacy WHERE pharmacy_name LIKE :searchTerm OR contact_person LIKE :searchTerm  ');
        $this->db->bind(':searchTerm', '%' . $searchTerm . '%');
        return $this->db->resultSet();

    }

    public function getRelevantMedicines($record_id){
        $this->db->query('SELECT id,name,dosage FROM medicines m 
                            JOIN prescriptions p ON p.medicine_id = m.id
                            WHERE health_record_id = :record_id');
        $this->db->bind(':record_id', $record_id);
        return $this->db->resultSet();
    }

    public function createOrder($patientId, $pharmacyId, $specialInstructions, $deliveryMethod, $recordId){
        $this->db->query('INSERT INTO orders (patient_id, pharmacy_id, special_instructions, delivery_method, record_id) VALUES (:patient_id, :pharmacy_id, :special_instructions, :delivery_method, :record_id)');
        $this->db->bind(':patient_id', $patientId);
        $this->db->bind(':pharmacy_id', $pharmacyId);
        $this->db->bind(':special_instructions', $specialInstructions);
        $this->db->bind(':delivery_method', $deliveryMethod);
        $this->db->bind(':record_id', $recordId);

        if($this->db->execute()){
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    
    // In your pharmacyModel class
public function getPendingOrders($pharmacy_id) {
    // Using the optimized query approach
    $this->db->query('SELECT o.*, p.*
                     FROM orders o
                     JOIN patients p ON o.patient_id = p.patient_id
                     WHERE o.pharmacy_id = :pharmacy_id 
                     AND o.order_status = "pending"');
    
    $this->db->bind(':pharmacy_id', $pharmacy_id);
    $orders = $this->db->resultSet();
    
    // If you need prescription data for each order
    foreach ($orders as &$order) {
        $this->db->query('SELECT * FROM prescriptions 
                         WHERE health_record_id = :record_id');
        $this->db->bind(':record_id', $order->record_id);
        $order->prescriptions = $this->db->resultSet();
    }
    
    return $orders;
}

public function getHealthRecordIdFromOrder($order_id){
    $this->db->query('SELECT record_id FROM orders WHERE order_id = :order_id');
    $this->db->bind(':order_id', $order_id);
    return $this->db->single()->record_id;
}


 public function getmedicinesInPrescription($record_id){
    $this->db->query('SELECT * FROM prescriptions 
    JOIN medicines ON prescriptions.medicine_id = medicines.id
    WHERE health_record_id = :record_id');
    $this->db->bind(':record_id', $record_id);
    return $this->db->resultSet();   

    
}

public function getPatientDetailsFromOrder($order_id){
    $this->db->query('SELECT * FROM patients 
    JOIN orders ON patients.patient_id = orders.patient_id
    WHERE order_id = :order_id');
    $this->db->bind(':order_id', $order_id);
    return $this->db->single();             
}

public function getOrderById($order_id){
    $this->db->query('SELECT * FROM orders WHERE order_id = :order_id');
    $this->db->bind(':order_id', $order_id);
    return $this->db->single();             
}

public function updateOrderStatus($order_id, $status){
    $this->db->query('UPDATE orders SET order_status = :status WHERE order_id = :order_id');
    $this->db->bind(':status', $status);
    $this->db->bind(':order_id', $order_id);
    if($this->db->execute()){
        return true;
    } else {
        return false;
    }
                

}
}