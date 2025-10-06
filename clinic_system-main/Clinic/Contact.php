<?php
// id	name	email	phone	subject	message
namespace Clini_system_mousa\Clinic_system\Clinic\Contact;
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
    }
}