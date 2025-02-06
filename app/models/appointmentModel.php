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
                         (doctor_id, patient_id, appointment_date, timeslot_id, reason, status) 
                         VALUES 
                         (:doctor_id, :patient_id, :appointment_date, :timeslot_id, :reason, :status)');
        
        // Bind values
        $this->db->bind(':doctor_id', $data['doctor_id']);
        $this->db->bind(':patient_id', $data['patient_id']);
        $this->db->bind(':appointment_date', $data['appointment_date']);
        $this->db->bind(':timeslot_id', $data['timeslot_id']);
        $this->db->bind(':reason', $data['reason']);
        $this->db->bind(':status', $data['status']);
        
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
    
    // Update appointment status
    public function updateStatus($appointmentId, $status) {
        $this->db->query('UPDATE appointments 
                         SET status = :status 
                         WHERE appointment_id = :appointment_id');
                         
        $this->db->bind(':appointment_id', $appointmentId);
        $this->db->bind(':status', $status);
        
        return $this->db->execute();
    }
    
    // Cancel appointment
    public function cancelAppointment($appointmentId) {
        return $this->updateStatus($appointmentId, 'cancelled');
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
        $this->db->query('SELECT doctor_id FROM doctors WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
        return $row;
    }

    public function getAppointments(){}

}