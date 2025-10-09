<?php

namespace Clini_system_mousa\Clinic_system\Clinic;

use PDO;

class Doctor
{
    private $id;
    private $name;
    private $email;

    private $phone;

    private $major;

    public function __construct($id, $name, $email, $phone, $major)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->major = $major;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getMajor()
    {
        return $this->major;
    }
    // ____________________________________________________________________________________________________//get_info_doctors//
    public static function get_info_doctros(PDO $pdo): array
    {
        $sql = $pdo->prepare("SELECT * FROM doctor");
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        $doctors = [];
        foreach ($rows as $row) {
            $doctors[] = new self($row['id'], $row['name'], $row['email'], $row['phone'], $row['major']);
        }
        return $doctors;
    }
    // ____________________________________________________________________________________________________//get_doctor_by_id//
    public static function get_doctor_by_id(PDO $pdo, $id): ?self
    {
        $sql = $pdo->prepare("SELECT * FROM doctor WHERE id = ?");
        $success =  $sql->execute([$id]);
        if ($success) {
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return new self($row['id'], $row['name'], $row['email'], $row['phone'], $row['major']);
        }
        return null;
    }
    // ____________________________________________________________________________________________________//get_doctors_by_major//
    public static function get_doctors_by_major(PDO $pdo, $major): array
    {
        $sql = $pdo->prepare("SELECT * FROM doctor WHERE major = ?");
        $success = $sql->execute([$major]);
        $doctors = [];
        if ($success) {
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $doctors[] = new self($row['id'], $row['name'], $row['email'], $row['phone'], $row['major']);
            }
        }
        return $doctors;
    }

    // ____________________________________________________________________________________________________//get_all_majors//
    public static function get_all_majors(PDO $pdo): array
    {
        $sql = $pdo->prepare("SELECT DISTINCT major FROM doctor ORDER BY major");
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        $majors = [];
        foreach ($rows as $row) {
            $majors[] = $row['major'];
        }
        return $majors;
    }

    // ____________________________________________________________________________________________________//get_doctor_by_name//
    public static function get_doctor_by_name(PDO $pdo, $name): ?self
    {
        $sql = $pdo->prepare("SELECT * FROM doctor where name=?");
        $success = $sql->execute([$name]);
        if ($success) {
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return new self($row['id'], $row['name'], $row['email'], $row['phone'], $row['major']);
        }
        return null;
    }
    // ____________________________________________________________________________________________________//get_all_doctor_by_name//
    public static function get_all_doctor_by_name(PDO $pdo): ?array
    {
        $sql = $pdo->prepare("SELECT name from doctor order by name");
        $success = $sql->execute();
        if ($success) {
            $name = [];
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $name[] = $row['name'];
            }
            return $name;
        }
        return null;
    }

    // ____________________________________________________________________________________________________//get_doctor_by_email//

    public static function get_doctor_by_email(PDO $pdo, $email): ?self
    {
        $sql = $pdo->prepare("SELECT * FROM doctor where email=?");
        $success = $sql->execute([$email]);
        if ($success) {
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return new self($row['id'], $row['name'], $row['email'], $row['phone'], $row['major']);
        }
        return null;
    }
    // ____________________________________________________________________________________________________//create_doctor//
    public static function create_doctor(PDO $pdo, $name, $email, $phone, $majors)
    {

        $sql = $pdo->prepare("INSERT INTO doctor (name,email,phone,major) VALUES (?,?,?,?)");
        $success = $sql->execute([$name, $email, $phone, $majors]);
        if ($success) {
            $id = $pdo->lastInsertId();

            return new self($id, $name, $email, $phone, $majors);
        }
        return  null;
    }
}




