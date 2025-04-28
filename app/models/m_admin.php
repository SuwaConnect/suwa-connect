<?php

class m_admin {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Assuming Database class is already defined
    }
    public function getTotalUsers() {
        $this->db->query("SELECT COUNT(*) as total FROM users");
        $result = $this->db->single();
        return $result->total;
    }

    public function getTotalActiveUsers() {
        $this->db->query("SELECT COUNT(*) as total FROM users where status = 'active'");
        $result = $this->db->single();
        return $result->total;
    }

    public function getLatestSignups() {
        $this->db->query("SELECT COUNT(*) as total FROM users where created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
        $result = $this->db->single();
        return $result->total;
    }

    public function getTotalAppointments() {
        $this->db->query(" SELECT 
            (SELECT COUNT(*) FROM appointments) + 
            (SELECT COUNT(*) FROM lab_appointments) 
        AS total");
        $result = $this->db->single();
        return $result->total;
    }

    public function getUserGrowth() {
        // Count the users 30 days ago (total users before the last 30 days)
        $this->db->query("SELECT COUNT(*) as users_before_30_days FROM users WHERE created_at < DATE_SUB(CURDATE(), INTERVAL 30 DAY)");
        $beforeResult = $this->db->single();
        $usersBefore30Days = $beforeResult->users_before_30_days;
    
        // Count the new users in the last 30 days
        $this->db->query("SELECT COUNT(*) as new_users FROM users WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)");
        $newResult = $this->db->single();
        $newUsers = $newResult->new_users;
    
        // Calculate the growth percentage
        if ($usersBefore30Days > 0) {
            $growth = (($newUsers / $usersBefore30Days) * 100);
        } else {
            $growth = 0; // If there were no users before the last 30 days
        }
    
        return round($growth, 2);
    }

    public function getLatestNotifications() {
        // Query to fetch the latest 5 messages
        $this->db->query("SELECT message 
                          FROM notifications 
                          ORDER BY created_at DESC 
                          LIMIT 5");
    
        // Execute the query and return the result
        $result = $this->db->resultSet();  // this will return an array of notifications
    
        return $result;
    }

    // Method to get upcoming appointments
    public function getUpcomingAppointments() {
        $this->db->query("SELECT COUNT(*) as total FROM appointments WHERE appointment_date > NOW()");
        $result = $this->db->single();
        return $result->total;
    }

    // Method to get completed appointments
    public function getCompletedAppointments() {
        $this->db->query("SELECT COUNT(*) as total FROM appointments WHERE status = 'completed'");
        $result = $this->db->single();
        return $result->total;
    }

    // Method to get canceled appointments
    public function getCanceledAppointments() {
        $this->db->query("SELECT COUNT(*) as total FROM appointments WHERE status = 'canceled'");
        $result = $this->db->single();
        return $result->total;
    }
    
    public function getAppointments() {
        $this->db->query("
        SELECT 
            appointments.*, 
            patients.first_name AS patient_name, 
            approved_doctors.firstName AS doctor_name 
        FROM 
            appointments
        LEFT JOIN 
            patients ON patients.patient_id = appointments.patient_id
        LEFT JOIN 
            approved_doctors ON approved_doctors.doctor_id = appointments.doctor_id
        ORDER BY 
            appointments.appointment_date DESC
    ");
        $result = $this->db->resultSet(); // this will return an array of appointments
        return $result;
    }
    public function getNotifications() {
        // Query to fetch the latest 5 messages
        $this->db->query("SELECT message 
                          FROM notifications 
                          ORDER BY created_at DESC");
    
        // Execute the query and return the result
        $result = $this->db->resultSet();  // this will return an array of notifications
    
        return $result;
    }

}
?>