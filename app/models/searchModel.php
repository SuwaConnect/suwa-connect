<?php

class searchModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function searchPatient($data){
        $this->db->query('SELECT * FROM patients WHERE first_name LIKE :searchQuery');
        $this->db->bind(':searchQuery', '%' . $data. '%');
        $results = $this->db->resultSet();
        return $results;
    }

    public function searchDoctor($data){
        $this->db->query('SELECT * FROM approved_doctors WHERE firstName LIKE :searchQuery');
        $this->db->bind(':searchQuery', '%' . $data. '%');
        $results = $this->db->resultSet();
        return $results;
    }

    
}