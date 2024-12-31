<?php

class m_doctor
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function registerNewDoctor($data){
        $this->db->query('INSERT INTO doctor (firstName,lastName,email,contact_no,slmc_no,medicalLicenseCopyName,password) VALUES (:first_name,:last_name,:email,:contact_no,:slmc_no,:medical_license_copy,:password)');
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':slmc_no', $data['slmc_no']);
        $this->db->bind(':medical_license_copy', $data['medical_license_copy']);
        $this->db->bind(':password', $data['password']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

        

    }


    
}