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

   




public function getSessionsByDoctorAndDay($doctorId, $dayOfWeek) {
    try {
        $this->db->query('SELECT * FROM doctor_sessions 
                         WHERE doctor_id = :doctor_id 
                         AND session_date = :day_of_week 
                         ORDER BY start_time');
        
        $this->db->bind(':doctor_id', $doctorId);
        $this->db->bind(':day_of_week', $dayOfWeek);
        
        return $this->db->resultSet();
    } catch (PDOException $e) {
        error_log("Error fetching doctor sessions: " . $e->getMessage());
        throw new Exception("Could not retrieve doctor sessions");
    }
}


public function getAppointmentsForSession($sessionId, $date) {
    try {
        $this->db->query('SELECT a.*, p.first_name,p.last_name, p.contact_no ,p.patient_id
                         FROM appointments a
                         JOIN patients p ON a.patient_id = p.patient_id
                         WHERE a.session_id = :session_id 
                         AND a.appointment_date = :appointment_date
                            AND a.status = "SCHEDULED"
                         ORDER BY a.created_at');
        
        $this->db->bind(':session_id', $sessionId);
        $this->db->bind(':appointment_date', $date);
        
        return $this->db->resultSet();
    } catch (PDOException $e) {
        error_log("Error fetching appointments for session: " . $e->getMessage());
        throw new Exception("Could not retrieve appointments");
    }
}

public function getNumberOfSessions($doctorId, $dayOfWeek) {
    try {
        $this->db->query('SELECT COUNT(*) as count FROM doctor_sessions 
                         WHERE doctor_id = :doctor_id 
                         AND session_date = :day_of_week');
        
        $this->db->bind(':doctor_id', $doctorId);
        $this->db->bind(':day_of_week', $dayOfWeek);
        
        $result = $this->db->single();
        return $result->count;
    } catch (PDOException $e) {
        error_log("Error counting doctor sessions: " . $e->getMessage());
        throw new Exception("Could not count sessions");
    }
}

public function getAllSessionsForDoctor($doctorId) {
    try {
        $this->db->query('SELECT * FROM doctor_sessions 
                         WHERE doctor_id = :doctor_id 
                         ORDER BY session_date, start_time');
        
        $this->db->bind(':doctor_id', $doctorId);
        
        return $this->db->resultSet();
    } catch (PDOException $e) {
        error_log("Error fetching all sessions for doctor: " . $e->getMessage());
        throw new Exception("Could not retrieve sessions");
    }

}

public function checkOverlappingSessions($doctorId, $sessionDate, $startTime, $endTime) {
    // Query to check if there's any session that overlaps with the new session time
    $this->db->query("SELECT * FROM doctor_sessions 
                      WHERE doctor_id = :doctor_id 
                      AND session_date = :session_date 
                      AND (
                          (start_time <= :start_time AND end_time > :start_time) OR
                          (start_time < :end_time AND end_time >= :end_time) OR
                          (start_time >= :start_time AND end_time <= :end_time)
                      )");
                      
    $this->db->bind(':doctor_id', $doctorId);
    $this->db->bind(':session_date', $sessionDate);
    $this->db->bind(':start_time', $startTime);
    $this->db->bind(':end_time', $endTime);
    
    $results = $this->db->resultSet();
    
    // If any rows are returned, there's an overlap
    //var_dump($results);
    return !empty($results);
}

public function addSession($data) {
    $this->db->query('INSERT INTO doctor_sessions 
                     (doctor_id, session_date, start_time, end_time, max_patients) 
                     VALUES 
                     (:doctor_id, :session_date, :start_time, :end_time, :max_patients)');
    
    // Bind values
    $this->db->bind(':doctor_id', $data['doctor_id']);
    $this->db->bind(':session_date', $data['session_date']);
    $this->db->bind(':start_time', $data['start_time']);
    $this->db->bind(':end_time', $data['end_time']);
    $this->db->bind(':max_patients', $data['max_patients']);
    
    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

public function deleteSession($sessionId) {
    $this->db->query('DELETE FROM doctor_sessions WHERE session_id = :session_id');
    
    // Bind values
    $this->db->bind(':session_id', $sessionId);
    
    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }

}

public function getScheduledAppointmentsForPatient($patientId) {
    $this->db->query('SELECT a.*, d.*,s.start_time
                     FROM appointments a
                     JOIN approved_doctors d ON a.doctor_id = d.doctor_id
                     JOIN doctor_sessions s ON a.session_id = s.session_id
                     WHERE a.patient_id = :patient_id AND a.status = "SCHEDULED"');
    
    // Bind values
    $this->db->bind(':patient_id', $patientId);
    
    return $this->db->resultSet();
}

public function getScheduledLabAppointmentsForPatient($patientId) {
    $this->db->query('SELECT l.*,r.* FROM lab_appointments l 
    JOIN registered_labs r ON l.lab_id = r.lab_id 
    WHERE patient_id = :patient_id AND status ="in_progress"');
    
    // Bind values
    $this->db->bind(':patient_id', $patientId);
    
    return $this->db->resultSet();
}


public function updateAppointmentStatus($appointment_id){
    $this->db->query('UPDATE appointments SET status = "COMPLETED" WHERE appointment_id = :appointment_id');
    
    // Bind values
    $this->db->bind(':appointment_id', $appointment_id);
    
    if($this->db->execute()) {
        return true;
    } else {
        return false;
}
}

}