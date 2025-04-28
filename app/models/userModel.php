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

public function getUserById($id) {
    $this->db->query('SELECT * FROM users WHERE user_id = :id');
    $this->db->bind(':id', $id);
    $row = $this->db->single();

    return $row;
}

public function updateProfilePicture($newFileName, $id) {
    $this->db->query('UPDATE users SET profile_picture = :profile_picture WHERE user_id = :id');
    $this->db->bind(':profile_picture', $newFileName);
    $this->db->bind(':id', $id);

    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

public function updateDoctorProfilePicture($newFileName,$id,){
    $this->db->query('UPDATE approved_doctors SET profile_picture_name = :profile_picture WHERE user_id = :id');
    $this->db->bind(':profile_picture', $newFileName);
    $this->db->bind(':id', $id);

    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

public function updatePharmacyProfilePicture($newFileName,$id,){
    $this->db->query('UPDATE approved_pharmacy SET profile_picture_name = :profile_picture WHERE user_id = :id');
    $this->db->bind(':profile_picture', $newFileName);
    $this->db->bind(':id', $id);

    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

public function updatePatientProfilePicture($newFileName,$id,){
    $this->db->query('UPDATE patients SET profile_picture_name = :profile_picture WHERE user_id = :id');
    $this->db->bind(':profile_picture', $newFileName);
    $this->db->bind(':id', $id);

    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

// public function searchUser($searchTerm){
//     $this->db->query("SELECT * FROM users WHERE 
//                      user_name LIKE :term OR 
//                      email LIKE :term OR 
//                      role LIKE :term");
//     $this->db->bind(':term', '%' . $searchTerm . '%');
//     $users = $this->db->resultSet();
//     return $users;

// }


public function getAllUsers() {
    $this->db->query("SELECT * FROM users ORDER BY created_at DESC");
    return $this->db->resultSet();
}

// Search users by name, email, or user type
public function searchUsers($query) {
    $this->db->query("SELECT * FROM users WHERE 
                     user_name LIKE :query OR 
                     email LIKE :query OR 
                     role LIKE :query
                     ORDER BY created_at DESC");
    
    $this->db->bind(':query', '%' . $query . '%');
    return $this->db->resultSet();
}

// Update user status (activate/deactivate)
public function updateUserStatus($userId, $status) {
    $this->db->query("UPDATE users SET status = :status WHERE user_id = :userId");
    $this->db->bind(':status', $status);
    $this->db->bind(':userId', $userId);
    
    
    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}
}