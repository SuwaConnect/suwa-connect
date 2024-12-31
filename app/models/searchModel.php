<?php

class searchModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function searchPatient($data){
        $this->db->query('SELECT * FROM patient WHERE name LIKE :searchQuery');
        $this->db->bind(':searchQuery', '%' . $data. '%');
        $results = $this->db->resultSet();
        return $results;
    }

    
}