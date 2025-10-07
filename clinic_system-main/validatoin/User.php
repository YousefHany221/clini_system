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
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO patient (name, email, phone, password) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);

            if ($stmt->execute([$name, $email, $phone, $hashedPassword])) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            // Check if it's a duplicate email error
            if ($ex->getCode() == 23000 && strpos($ex->getMessage(), 'Duplicate entry') !== false && strpos($ex->getMessage(), 'email') !== false) {
                throw new PDOException('This email address is already registered. Please use a different email address or try logging in.', 23000, $ex);
            }
            // Re-throw other PDO exceptions
            throw $ex;
        }
    }
}
