<?php

class appointmentModel{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getDoctorById($doctor_id){
        $this->db->query('SELECT * FROM approved_doctors WHERE doctor_id = :doctor_id');
        $this->db->bind(':doctor_id', $doctor_id);
        $row = $this->db->single();
        return $row;
    }

    public function getAllTimeSlots() {
        $this->db->query('SELECT * FROM timeslots ORDER BY slot_time');
        return $this->db->resultSet();
    }
    
    // Get available time slots for a specific date and doctor
    public function getAvailableTimeSlots($doctorId, $date) {
        $this->db->query('SELECT t.* 
                         FROM timeslots t 
                         WHERE t.timeslot_id NOT IN (
                             SELECT a.timeslot_id 
                             FROM appointments a 
                             WHERE a.doctor_id = :doctor_id 
                             AND a.appointment_date = :appointment_date
                             AND a.status != "cancelled"
                         )
                         ORDER BY t.slot_time');
                         
        $this->db->bind(':doctor_id', $doctorId);
        $this->db->bind(':appointment_date', $date);
        
        return $this->db->resultSet();
    }
    
    // Get a specific time slot by ID
    public function getTimeSlotById($timeslotId) {
        $this->db->query('SELECT * FROM timeslots WHERE timeslot_id = :timeslot_id');
        $this->db->bind(':timeslot_id', $timeslotId);
        return $this->db->single();
    }




    public function createAppointment($data) {
        $this->db->query('INSERT INTO appointments 
                         (doctor_id, patient_id, appointment_date, session_id, reason) 
                         VALUES 
                         (:doctor_id, :patient_id, :appointment_date, :session_id, :reason)');
        
        // Bind values
        $this->db->bind(':doctor_id', $data['doctor_id']);
        $this->db->bind(':patient_id', $data['patient_id']);
        $this->db->bind(':appointment_date', $data['appointment_date']);
        $this->db->bind(':session_id', $data['session_id']);
        $this->db->bind(':reason', $data['reason']);
        // $this->db->bind(':status', $data['status']);
        
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Check if timeslot is available
    public function isTimeSlotAvailable($doctorId, $date, $timeslotId) {
        $this->db->query('SELECT COUNT(*) as count 
                         FROM appointments 
                         WHERE doctor_id = :doctor_id 
                         AND appointment_date = :appointment_date 
                         AND timeslot_id = :timeslot_id 
                         AND status != "cancelled"');
                         
        $this->db->bind(':doctor_id', $doctorId);
        $this->db->bind(':appointment_date', $date);
        $this->db->bind(':timeslot_id', $timeslotId);
        
        $result = $this->db->single();
        return $result->count == 0;
    }
    
    // Get all appointments for a patient
    public function getPatientAppointments($patientId) {
        $this->db->query('SELECT a.*, t.slot_time, d.firstName as doctor_name 
                         FROM appointments a 
                         JOIN timeslots t ON a.timeslot_id = t.timeslot_id 
                         JOIN doctors d ON a.doctor_id = d.doctor_id 
                         WHERE a.patient_id = :patient_id 
                         ORDER BY a.appointment_date DESC, t.slot_time DESC');
                         
        $this->db->bind(':patient_id', $patientId);
        return $this->db->resultSet();
    }
    
    // Get all appointments for a doctor
    public function getDoctorAppointments($doctorId) {
        $this->db->query('SELECT a.*, t.slot_time, p.name as patient_name 
                         FROM appointments a 
                         JOIN timeslots t ON a.timeslot_id = t.timeslot_id 
                         JOIN patients p ON a.patient_id = p.patient_id 
                         WHERE a.doctor_id = :doctor_id 
                         ORDER BY a.appointment_date DESC, t.slot_time DESC');
                         
        $this->db->bind(':doctor_id', $doctorId);
        return $this->db->resultSet();
    }
    
    // Get specific appointment by ID
    public function getAppointmentById($appointmentId) {
        $this->db->query('SELECT a.*, t.slot_time, d.firstName as doctor_name, p.name as patient_name 
                         FROM appointments a 
                         JOIN timeslots t ON a.timeslot_id = t.timeslot_id 
                         JOIN doctors d ON a.doctor_id = d.doctor_id 
                         JOIN patients p ON a.patient_id = p.patient_id 
                         WHERE a.appointment_id = :appointment_id');
                         
        $this->db->bind(':appointment_id', $appointmentId);
        return $this->db->single();
    }
    
    
    
    // Get appointments for specific date and doctor
    public function getDoctorAppointmentsByDate($doctorId, $date) {
        $this->db->query('SELECT a.*, t.slot_time, p.name as patient_name 
                         FROM appointments a 
                         JOIN timeslots t ON a.timeslot_id = t.timeslot_id 
                         JOIN patients p ON a.patient_id = p.patient_id 
                         WHERE a.doctor_id = :doctor_id 
                         AND a.appointment_date = :appointment_date 
                         AND a.status != "cancelled" 
                         ORDER BY t.slot_time');
                         
        $this->db->bind(':doctor_id', $doctorId);
        $this->db->bind(':appointment_date', $date);
        
        return $this->db->resultSet();
    }

    public function getPatientIdByUserId($user_id){
        $this->db->query('SELECT patient_id FROM patients WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
        return $row;
    }

    public function getDoctorIdByUserId($user_id){
        $this->db->query('SELECT doctor_id FROM approved_doctors WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
        return $row;
    }

    

    public function getPendingAppointments($doctor_id, $date) {
        try {
            $this->db->query('SELECT 
                                a.appointment_id,
                                a.appointment_date,
                                a.status,
                                a.reason,
                                t.slot_time,
                                p.first_name as patient_name,
                                p.patient_id
                             FROM appointments a 
                             JOIN timeslots t ON a.timeslot_id = t.timeslot_id 
                             JOIN patients p ON a.patient_id = p.patient_id 
                             WHERE a.doctor_id = :doctor_id 
                             AND a.appointment_date = :appointment_date 
                             AND a.status = "pending" 
                             ORDER BY t.slot_time');
                             
            $this->db->bind(':doctor_id', $doctor_id);
            $this->db->bind(':appointment_date', $date);
            
            return $this->db->resultSet();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }

    public function getApprovedAppointments($doctor_id, $date) {
        try {
            $this->db->query('SELECT 
                                a.appointment_id,
                                a.appointment_date,
                                a.status,
                                a.reason,
                                t.slot_time,
                                p.first_name as patient_name,
                                p.patient_id
                             FROM appointments a 
                             JOIN timeslots t ON a.timeslot_id = t.timeslot_id 
                             JOIN patients p ON a.patient_id = p.patient_id 
                             WHERE a.doctor_id = :doctor_id 
                             AND a.appointment_date = :appointment_date 
                             AND a.status = "confirmed" 
                             And a.consult_status = "not consulted"
                             ORDER BY t.slot_time');
                             
            $this->db->bind(':doctor_id', $doctor_id);
            $this->db->bind(':appointment_date', $date);
            
            return $this->db->resultSet();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }

    public function updateAppointmentStatus($appointment_id, $status) {
        try {
            $this->db->query('UPDATE appointments 
                             SET status = :status   
                             WHERE appointment_id = :appointment_id');
            
            $this->db->bind(':status', $status);
            $this->db->bind(':appointment_id', $appointment_id);
            
            return $this->db->execute();
        } catch (PDOException $e) {
            error_log("Error updating appointment status: " . $e->getMessage());
            throw new Exception("Database error occurred");
        }
    }

    public function getAllAppointments($doctor_id) {
        try {
            $this->db->query('SELECT 
                                a.appointment_id,
                                a.appointment_date,
                                a.status,
                                a.reason,
                                a.consult_status,
                                t.slot_time,
                                p.first_name as patient_name,
                                p.patient_id
                             FROM appointments a 
                             JOIN timeslots t ON a.timeslot_id = t.timeslot_id 
                             JOIN patients p ON a.patient_id = p.patient_id 
                             WHERE a.doctor_id = :doctor_id AND a.status = "confirmed" AND a.consult_status = "not consulted" 
                             ORDER BY a.appointment_date DESC, t.slot_time DESC');
                             
            $this->db->bind(':doctor_id', $doctor_id);
            
            return $this->db->resultSet();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }

    // Add method to send notification to patient (optional)
    public function notifyPatient($appointment_id, $status) {
        // Get patient details
        $this->db->query('SELECT p.email, p.name, a.appointment_date, t.slot_time 
                         FROM appointments a
                         JOIN patients p ON a.patient_id = p.patient_id
                         JOIN timeslots t ON a.timeslot_id = t.timeslot_id
                         WHERE a.appointment_id = :appointment_id');
        
        $this->db->bind(':appointment_id', $appointment_id);
        $patientDetails = $this->db->single();
        
        if($patientDetails) {
            // Send email notification
            // Implement your email sending logic here
            return true;
        }
        return false;
    }

    public function markAppointmentAsCompleted($appointment_id) {
        try {
            $this->db->query('UPDATE appointments 
                             SET consult_status = "consulted"   
                             WHERE appointment_id = :appointment_id');
            
            $this->db->bind(':appointment_id', $appointment_id);
            
            return $this->db->execute();
        } catch (PDOException $e) {
            error_log("Error updating appointment status: " . $e->getMessage());
            throw new Exception("Database error occurred");
        }
    }



















    public function getSessionsForTheSelecteddate($doctor_id, $date, $dayOfWeek) {
        try {
            $this->db->query("SELECT 
                    ds.session_id, 
                    TIME_FORMAT(ds.start_time, '%H:%i') AS start_time, 
                    TIME_FORMAT(ds.end_time, '%H:%i') AS end_time, 
                    ds.max_patients,
                    ds.session_date,
                    (ds.max_patients - COALESCE(booked_appointments.appointment_count, 0)) AS available_seats
                FROM 
                    doctor_sessions ds
                LEFT JOIN (
                    SELECT 
                        session_id, 
                        COUNT(appointment_id) AS appointment_count
                    FROM 
                        appointments
                    WHERE 
                        status = 'SCHEDULED'
                        AND appointment_date = :date
                    GROUP BY 
                        session_id
                ) booked_appointments ON ds.session_id = booked_appointments.session_id
                WHERE 
                    ds.doctor_id = :doctor_id 
                    AND ds.session_date = :day_of_week
                ORDER BY 
                    ds.start_time");
        
            $this->db->bind(':doctor_id', $doctor_id);
            $this->db->bind(':day_of_week', $dayOfWeek);
            $this->db->bind(':date', $date);
            
            if ($this->db->execute()) {
                return $this->db->resultSet();
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Simply echo the error message
            echo $e->getMessage();
            return false;
        }
    }

}