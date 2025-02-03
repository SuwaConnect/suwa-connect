<?php

class userModel{

private $db;

public function __construct()
{
    $this->db = new Database;

}

public function createUser($userData) {
    $this->db->query('INSERT INTO users (email, password, role)
                     VALUES (:email, :password, :role)');
    
    $this->db->bind(':email', $userData['email']);
    $this->db->bind(':password', $userData['password']);
    $this->db->bind(':role', $userData['role']);
    
    if($this->db->execute()) {
        return $this->db->lastInsertId();
    }
    return false;
}

}