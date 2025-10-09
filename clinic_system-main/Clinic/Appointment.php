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

    public function getId()
    {
        return $this->id;
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
    // ____________________________________________________________________________________________________//get_info_appointment//
    public static function get_info_appointment(PDO $pdo): array
    {
        $sql = $pdo->prepare("SELECT * FROM appointment");
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        $appointments = [];
        foreach ($rows as $row) {
            $appointments[] = new self($row['id'], $row['name'], $row['email'], $row['phone']);
        }
        return $appointments;
    }
    // ____________________________________________________________________________________________________//update appointment//
    public static function update_appointment(PDO $pdo, $id, $name, $email, $phone): ?self
    {
        $sql = $pdo->prepare("UPDATE appointment SET name=?, email=?, phone=? WHERE id=?");
        $success = $sql->execute([$name, $email, $phone, $id]);
        if ($success && $sql->rowCount() > 0) {
            return new self($id, $name, $email, $phone);
        }
        return null;
    }
    // ____________________________________________________________________________________________________//delete appointment//
    public static function delete_appointment(PDO $pdo, $id): bool
    {
        $sql = $pdo->prepare("DELETE FROM appointment WHERE id=?");
        $success = $sql->execute([$id]);
        return $success && $sql->rowCount() > 0;
    }
}
