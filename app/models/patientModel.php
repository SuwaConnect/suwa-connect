<?php

class patientModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
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
            echo "model is here";
            return true;
        } else {
            echo "model is not here";
            return false;
        }

}

}