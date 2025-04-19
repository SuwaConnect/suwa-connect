<?php

class visitRecordModel{

    private $db;

    public function __construct() {
       $this->db = new Database;
    }

    public function searchMedicines($query) {
         $query = '%' . $query . '%';
       

        $this->db->query("SELECT * FROM medicines WHERE name LIKE :query ORDER BY name LIMIT 10");
        $this->db->bind(':query', $query);
        $results = $this->db->resultSet();
        return $results;
       
    }

    public function getMedicineById($id) {
        // $query = "SELECT id, name, dosage FROM medicines WHERE id = ?";
        // $result = $this->db->query($query, [$id]);
        // return $result ? $result[0] : null;
        $this->db->query("SELECT id, name, dosage FROM medicines WHERE id = :id");
        $this->db->bind(':id', $id);
        $result = $this->db->single();
        return $result;
    }

    public function addInitialHealthRecord($data){
        $this->db->query('INSERT INTO health_records (patient_id, doctor_id, diagnosis, additional_notes,chief_complaint) VALUES (:patient_id, :doctor_id,:diagnosis, :additional_notes,:chief_complaint)');
        $this->db->bind(':patient_id', $data['patient_id']);
        $this->db->bind(':doctor_id', $data['doctor_id']);
        $this->db->bind(':chief_complaint', $data['chief_complaint']);
        $this->db->bind(':diagnosis', $data['diagnosis']);
        $this->db->bind(':additional_notes', $data['additional_notes']);
        if($this->db->execute()){
            return $this->db->lastInsertId();
        }else{
            return false;
        }
    }

    public function addVitalSigns($data){
        $this->db->query('INSERT INTO vital_signs (record_id, systolic,diastolic, temperature, blood_sugar, cholesterol, weight) VALUES (:health_record_id,:systolic,:diastolic, :temperature, :blood_sugar, :cholesterol, :weight)');
        $this->db->bind(':health_record_id', $data['record_id']);
        $this->db->bind(':systolic', $data['blood_pressure']['sistolic']);
        $this->db->bind(':diastolic', $data['blood_pressure']['diastolic']);

        $this->db->bind(':temperature', $data['temperature']);
        $this->db->bind(':blood_sugar', $data['blood_sugar']);
        $this->db->bind(':cholesterol', $data['cholesterol']);
        $this->db->bind(':weight', $data['weight']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function addReport($data) {
        $this->db->query('INSERT INTO reports (
            health_record_id, 
            title, 
            type, 
            report_date, 
            findings, 
            file_path, 
            original_filename,
            created_at
        ) VALUES (
            :health_record_id, 
            :title, 
            :type, 
            :report_date, 
            :findings, 
            :file_path, 
            :original_filename,
            NOW()
        )');
        
        // Bind values
        $this->db->bind(':health_record_id', $data['health_record_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':report_date', $data['report_date']);
        $this->db->bind(':findings', $data['findings']);
        //$this->db->bind(':recommendations', $data['recommendations']);
        $this->db->bind(':file_path', $data['file_path']);
        $this->db->bind(':original_filename', $data['original_filename']);
        
        // Execute
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    
    /**
     * Get reports by health record ID
     * 
     * @param int $healthRecordId Health record ID
     * @return array Reports associated with the health record
     */
    public function getReportsByHealthRecordId($healthRecordId) {
        $this->db->query('SELECT * FROM medical_reports WHERE health_record_id = :health_record_id ORDER BY report_date DESC');
        $this->db->bind(':health_record_id', $healthRecordId);
        return $this->db->resultSet();
    }
    
    /**
     * Get a report by ID
     * 
     * @param int $reportId Report ID
     * @return object Report data
     */
    public function getReportById($reportId) {
        $this->db->query('SELECT * FROM medical_reports WHERE id = :id');
        $this->db->bind(':id', $reportId);
        return $this->db->single();
    }
    
    
    public function deleteReport($reportId) {
        // First get the report to find the file path
        $report = $this->getReportById($reportId);
        
        if (!$report) {
            return false;
        }
        
        // Delete the file if it exists
        if (file_exists($report->file_path)) {
            unlink($report->file_path);
        }
        
        // Delete from database
        $this->db->query('DELETE FROM medical_reports WHERE id = :id');
        $this->db->bind(':id', $reportId);
        
        return $this->db->execute();
    }


    public function addPrescription($data) {
        // Check if we have multiple medicines
        if (isset($data['medicines']) ) {
            // Initialize success counter
            $successCount = 0;
            
            // Loop through each medicine ID in the array
            foreach ($data['medicines'] as $medicine) {
                $this->db->query('INSERT INTO prescriptions (health_record_id, medicine_id) VALUES (:health_record_id, :medicine_id)');
                $this->db->bind(':health_record_id', $data['health_record_id']);
                $this->db->bind(':medicine_id', $medicine);
                
                if ($this->db->execute()) {
                    $successCount++;
                }
            }
            
            // Return true if all insertions were successful
            return $successCount == count($data['medicines']);
        } else {
            // Handle single medicine case
            // $this->db->query('INSERT INTO prescriptions (health_record_id, medicine_id) VALUES (:health_record_id, :medicine_id)');
            // $this->db->bind(':health_record_id', $data['health_record_id']);
            // $this->db->bind(':medicine_id', $data['medicine_id']);
            echo "here";
            //return $this->db->execute();
        }
    }

    public function getAllHealthRecords($patient_id, $search = '') {
        $query = "SELECT hr.*, 
            d.firstName AS doctor_name, 
            p.first_name AS patient_name 
            FROM health_records hr
            LEFT JOIN approved_doctors d ON hr.doctor_id = d.doctor_id
            LEFT JOIN patients p ON hr.patient_id = p.patient_id
            WHERE hr.patient_id = :patient_id";
    
        $this->db->query($query);
        $this->db->bind(':patient_id', $patient_id);
    
        if (!empty($search)) {
            $query .= " AND (
                d.firstName LIKE :search OR 
                p.first_name LIKE :search OR 
                hr.diagnosis LIKE :search OR 
                hr.chief_complaint LIKE :search 
            )";
    
            $this->db->query($query);
            $this->db->bind(':patient_id', $patient_id);
            $this->db->bind(':search', "%$search%");
        }
    
        return $this->db->resultSet();
    }

    public function getHealthRecordById($record_id) {
        $this->db->query('SELECT 
                            hr.*, p.*,
                            CONCAT(p.first_name," ",p.last_name) AS patient_name, 
                            p.email AS patient_email, 
                            CONCAT(d.firstName," ",d.lastName) AS doctor_name
                        FROM 
                            health_records hr
                        JOIN 
                            patients p ON hr.patient_id = p.patient_id
                        JOIN 
                            approved_doctors d ON hr.doctor_id = d.doctor_id
                        WHERE 
                            hr.record_id = :record_id');
        $this->db->bind(':record_id', $record_id);
        return $this->db->single();
    }

    public function getVitalSignsByRecordId($record_id) {
        $this->db->query('SELECT * FROM vital_signs WHERE record_id = :record_id');
        $this->db->bind(':record_id', $record_id);
        return $this->db->single();
    }

    public function getReportsByRecordId($record_id) {
        $this->db->query('SELECT * FROM reports WHERE health_record_id = :health_record_id');
        $this->db->bind(':health_record_id', $record_id);
        return $this->db->resultSet();
    } 

    public function getPrescriptionsByRecordId($record_id) {
        $this->db->query('SELECT p.*, m.name AS medicine_name, m.dosage AS medicine_dosage FROM prescriptions p JOIN medicines m ON p.medicine_id = m.id WHERE p.health_record_id = :health_record_id');
        $this->db->bind(':health_record_id', $record_id);
        return $this->db->resultSet();
    }
    
}