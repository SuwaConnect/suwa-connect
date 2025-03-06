<?php

class logInModel{

private $db;

public function __construct()
{
    $this->db = new Database;
}

public function doctorLogIn($email, $password) {
    $this->db->query('SELECT * FROM users WHERE email = :email');
    $this->db->bind(':email', $email);
    $row = $this->db->single();
    
    if($row) {
        $verify_result = password_verify($password, $row->password);
        if($verify_result) {
            return $row;
        }
    }
    return false;
}


public function doctorStillnotApproved($email){
    $this->db->query('SELECT * FROM pending_doctors WHERE email = :email');
    $this->db->bind(':email', $email);
    $row = $this->db->single();
    if($row->status == 'pending'){
        return true;
    } else {
        return false;
    }
}

public function labStillnotApproved($email){
    $this->db->query('SELECT * FROM pending_labs WHERE email = :email');
    $this->db->bind(':email', $email);
    $row = $this->db->single();
    if($row->status == 'pending'){
        return true;
    } else {
        return false;
    }
}

public function pharmacyStillnotApproved($email){
    $this->db->query('SELECT * FROM pending_pharmacists WHERE email = :email');
    $this->db->bind(':email', $email);
    $row = $this->db->single();
    if($row->status == 'pending'){
        return true;
    } else {
        return false;
    }
}

public function getApprovedUserByEmail($email) {
    $this->db->query('SELECT * FROM users WHERE email = :email');
    $this->db->bind(':email', $email);
    return $this->db->single();
}


public function checkPendingDoctor($email) {
    $this->db->query('SELECT * FROM pending_doctors WHERE email = :email');
    $this->db->bind(':email', $email);
    return $this->db->single();
}

public function checkPendingPharmacy($email) {
    $this->db->query('SELECT * FROM pending_pharmacy WHERE email = :email');
    $this->db->bind(':email', $email);
    return $this->db->single();
}

public function checkPendingLab($email) {
    $this->db->query('SELECT * FROM pending_labs WHERE email = :email');
    $this->db->bind(':email', $email);
    return $this->db->single();
}

public function verifyCredentials($email, $password) {
    // Check approved users first
    $user = $this->getApprovedUserByEmail($email);
    
    if ($user) {
        if (password_verify($password, $user->password)) {
            return [
                'status' => 'approved',
                'data' => $user
            ];
        }
        return [
            'status' => 'invalid',
            'message' => 'Invalid credentials'
        ];
    }


    // Check pending users
    $pendingDoctor = $this->checkPendingDoctor($email);
    if ($pendingDoctor && password_verify($password, $pendingDoctor->password)) {
        return [
            'status' => 'pending',
            'data' => $pendingDoctor,
            'type' => 'doctor',
            'message' => 'Your doctor account is pending admin approval'
        ];
    }

    $pendingPharmacy = $this->checkPendingPharmacy($email);
    if ($pendingPharmacy && password_verify($password, $pendingPharmacy->password)) {
        return [
            'status' => 'pending',
            'data' => $pendingPharmacy,
            'type' => 'pharmacy',
            'message' => 'Your pharmacy account is pending admin approval'
        ];
    }

    $pendingLab = $this->checkPendingLab($email);
    if ($pendingLab && password_verify($password, $pendingLab->password)) {
        return [
            'status' => 'pending',
            'data' => $pendingLab,
            'type' => 'lab',
            'message' => 'Your laboratory account is pending admin approval'
        ];
    }

    return [
        'status' => 'invalid',
        'message' => 'Invalid credentials'
    ];
}





}