<?php

class userModel{

private $db;

public function __construct()
{
    $this->db = new Database;

}

public function createUser($userData) {
    $this->db->query('INSERT INTO users (email, password, role,user_name)
                     VALUES (:email, :password, :role, :user_name)');
    
    $this->db->bind(':email', $userData['email']);
    $this->db->bind(':password', $userData['password']);
    $this->db->bind(':role', $userData['role']);
    $this->db->bind(':user_name', $userData['user_name']);

    
    if($this->db->execute()) {
        return $this->db->lastInsertId();
        //return true;
    }
    return false;
}

public function findUserByEmail($email) {
    $this->db->query('SELECT * FROM users WHERE email = :email');
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    if($this->db->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}


public function deleteUser($id) {
    $this->db->query('DELETE FROM users WHERE id = :id');
    $this->db->bind(':id', $id);

    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}






}