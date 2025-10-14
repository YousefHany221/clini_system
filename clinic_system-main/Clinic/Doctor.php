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
    private $image;

    public function __construct($id, $name, $email, $phone, $major, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->major = $major;
        $this->image = $image;
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

    public function getImage()
    {
        return $this->image;
    }
    // ____________________________________________________________________________________________________//get_info_doctors//
    public static function get_info_doctros(PDO $pdo): array
    {
        $sql = $pdo->prepare("SELECT * FROM doctor");
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        $doctors = [];
        foreach ($rows as $row) {
            $doctors[] = new self($row['id'], $row['name'], $row['email'], $row['phone'], $row['major'], $row['image']);
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
            return new self($row['id'], $row['name'], $row['email'], $row['phone'], $row['major'], $row['image']);
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
                $doctors[] = new self($row['id'], $row['name'], $row['email'], $row['phone'], $row['major'], $row['image']);
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
            return new self($row['id'], $row['name'], $row['email'], $row['phone'], $row['major'], $row['image']);
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
            return new self($row['id'], $row['name'], $row['email'], $row['phone'], $row['major'], $row['image']);
        }
        return null;
    }
    // ____________________________________________________________________________________________________//create_doctor//
    public static function create_doctor(PDO $pdo, $name, $email, $phone, $majors, $image)
    {

        $sql = $pdo->prepare("INSERT INTO doctor (name,email,phone,major,image) VALUES (?,?,?,?,?)");
        $success = $sql->execute([$name, $email, $phone, $majors, $image]);
        if ($success) {
            $id = $pdo->lastInsertId();

            return new self($id, $name, $email, $phone, $majors, $image);
        }
        return  null;
    }


    // ____________________________________________________________________________________________________//update doctor//

    public static function update_doctor(PDO $pdo, $id, $name, $email, $phone, $majors, $image): ?self
    {
        $sql = $pdo->prepare("UPDATE doctor SET name=?,email=?,phone=?,major=?,image=? WHERE id=?");
        $success = $sql->execute([$name, $email, $phone, $majors, $image, $id]);
        if ($success && $sql->rowCount() > 0) {
            return new self($id, $name, $email, $phone, $majors, $image);
        }
        return null;
    }
    // ____________________________________________________________________________________________________//delete doctor//

    public static function delete_doctor(PDO $pdo, $id): bool
    {
        $sql = $pdo->prepare("DELETE FROM doctor WHERE id=?");
        $success = $sql->execute([$id]);
        return $success && $sql->rowCount() > 0;
    }
    // ____________________________________________________________________________________________________//get_image_major//
    
    public static function get_image_major(PDO $pdo, $major): ?string
   {
       // Get the first doctor with this major to get the image
       $sql = $pdo->prepare("SELECT image FROM doctor WHERE major = ? LIMIT 1");
       $success = $sql->execute([$major]);
       
       if ($success) {
           $row = $sql->fetch(PDO::FETCH_ASSOC);
           if ($row) {
               return $row['image'];
           }
       }
       
       // If no doctor found with this major, return a default image name based on major
       $sanitizedMajor = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($major));
       return $sanitizedMajor . '.jpg';
   }
   // ____________________________________________________________________________________________________//get_count_doctors   //

   public static function get_count_doctors(PDO $pdo): int
   {
       $sql = $pdo->prepare("SELECT COUNT(*) as total FROM doctor");
       $sql->execute();
       $result = $sql->fetch(PDO::FETCH_ASSOC);
       return (int) $result['total'];
   }









}
