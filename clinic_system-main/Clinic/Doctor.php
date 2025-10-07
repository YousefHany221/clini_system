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
    public static function get_doctor_by_id(PDO $pdo, $id): ?self{
        $sql = $pdo->prepare("SELECT * FROM doctor WHERE id = ?");
      $success =  $sql->execute([$id]);
      if($success){
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        return new self($row['id'], $row['name'], $row['email'], $row['phone'], $row['major']);
      }
      return null;
    }

    
}

