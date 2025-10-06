<?php

class User
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function register($name, $email, $phone, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO patient (name, email, phone, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->execute([$name, $email, $phone, $hashedPassword])) {
            return true;
        } else {
            return false;
        }
    }
}
