<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (name, email, phone, password) VALUES (:name, :email, :phone, :password)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':password', $data['password']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email_phone, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email_phone OR phone = :email_phone');
        $this->db->bind(':email_phone', $email_phone);

        $row = $this->db->single();
        $hashed_pass = $row->password;
        if (password_verify($password, $hashed_pass)) {
            return $row;
        } else {
            echo json_encode(array("message" => "Login failed.", "password" => $password));
            return false;
        }
    }
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');

        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserByPhone($phone)
    {
        $this->db->query('SELECT * FROM users WHERE phone = :phone');

        $this->db->bind(':phone', $phone);

        $row = $this->db->single();

        if ($this->db->rowCount() != 0) {
            return true;
        } else {
            return false;
        }
    }
}
