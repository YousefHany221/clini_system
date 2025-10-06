<?php

namespace Clini_system_mousa\Clinic_system\Clinic;

use PDO;

class Appointment
{

    private $id;
    private $name;
    private $email;
    private $phone;



    public function __construct($id, $name, $email, $phone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    public static function create_appointment(PDO $pdo, $name, $email, $phone): ?self
    {
        $sql = $pdo->prepare("INSERT INTO appointment (name,email,phone) VALUES (?, ?, ?)");
        $success = $sql->execute([
            $name,
            $email,
            $phone,

        ]);
        if ($success) {
            return new self($pdo->lastInsertId(), $name, $email, $phone);
        }
        return null;
    }
}
