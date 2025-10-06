<?php
require_once __DIR__ . '/../Clinic/database.php';
require_once __DIR__ . '/../config/database.php';
class User
{
    private $conn;

    public function __construct( $conn)
    {
        $this->conn= $conn;
    }

    public function register($name, $email, $phone, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO patient (name, email, phone, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $phone, $hashedPassword);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] === 'register') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $user = new User($conn);
    if ($user->register($name, $email, $phone, $password)) {
        $_SESSION['success'] = "تم التسجيل بنجاح!";
    } else {
        $_SESSION['errors']['general'][] = "حدث خطأ أثناء التسجيل!";
    }
    $_SESSION['old'] = $_POST;
    header("Location: ../views/register.php");
    exit;
}