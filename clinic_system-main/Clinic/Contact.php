<?php
// id	name	email	phone	subject	message
namespace Clini_system_mousa\Clinic_system\Clinic;
use PDO;
class Contact{
    private $id;
    private $name;
    private $email;
    private $phone;
    private $subject;
    private $message;
    public function __construct($id, $name, $email, $phone, $subject, $message)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->subject = $subject;
        $this->message = $message;
    }
    public static function create_contact(PDO $pdo, $name, $email, $phone, $subject, $message): ?self
    {
        try {
            $sql = $pdo->prepare("INSERT INTO contact (name,email,phone,subject,message) VALUES (?, ?, ?, ?, ?)");
            $success = $sql->execute([
                $name,
                $email,
                $phone,
                $subject,
                $message,
            ]);
            if ($success) {
                return new self($pdo->lastInsertId(), $name, $email, $phone, $subject, $message);
            }
            return null;
        } catch (\PDOException $e) {
            // Check if it's a duplicate email error
            if ($e->getCode() == 23000 && strpos($e->getMessage(), 'Duplicate entry') !== false && strpos($e->getMessage(), 'email') !== false) {
                throw new \PDOException('This email address is already registered in our system. Please use a different email address.', 23000, $e);
            }
            // Re-throw other PDO exceptions
            throw $e;
        }
    }
}