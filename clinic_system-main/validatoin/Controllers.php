<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../Clinic/database.php';
require_once __DIR__ . '/../config/database.php';
require_once 'Validator.php';
require_once 'User.php';

$db = Database::get_instance($config);
$pdo = $db->get_connection();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'register') {
        // Register validation rules
        $rules = [
            'name' => "required|max:255|min:3",
            'email' => "required|email",
            'phone' => "required|number|min:11|max:11",
            'password' => "required|min:8|max:50|confirmed",
        ];

        $validator = new Validator($_POST);

        foreach ($rules as $field => $rule) {
            if (isset($_POST[$field])) {
                $validator->validate($_POST[$field], $field, $rule);
            }
        }

        if ($validator->has_errors()) {
            $_SESSION['errors'] = $validator->get_errors();
            $_SESSION['old'] = $_POST;
            header('Location: ../index.php?page=register');
            exit;
        } else {
            // Here you would normally save to database
            $user = new User($pdo);
            if ($user->register($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['password'])) {
                // Set user session after successful registration
                $_SESSION['user'] = [
                    'email' => $_POST['email'],
                    'name' => $_POST['name'],
                    'logged_in' => true
                ];
                $_SESSION['success'] = "تم التسجيل بنجاح!";
                header('Location: ../index.php?page=home');
                exit;
            } else {
                $_SESSION['errors']['general'][] = "حدث خطأ أثناء التسجيل!";
                $_SESSION['old'] = $_POST;
                header('Location: ../index.php?page=register');
                exit;
            }
        }
    } elseif ($action === 'login') {
        // Login validation rules
        $rules = [
            'email' => "required|email",
            'password' => "required|min:8",
        ];

        $validator = new Validator($_POST);

        foreach ($rules as $field => $rule) {
            if (isset($_POST[$field])) {
                $validator->validate($_POST[$field], $field, $rule);
            }
        }

        if ($validator->has_errors()) {
            $_SESSION['errors'] = $validator->get_errors();
            $_SESSION['old'] = $_POST;
            header('Location: ../index.php?page=login');
            exit;
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $pdo->prepare("SELECT * FROM patient WHERE email = :email LIMIT 1");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Debug: Check if user exists
            if (!$user) {
                $_SESSION['errors']['login'][] = "المستخدم غير موجود. تأكد من البريد الإلكتروني.";
                header('Location: ../index.php?page=login');
                exit;
            }

            // Debug: Check password verification
            if (!password_verify($password, $user['password'])) {
                $_SESSION['errors']['login'][] = "كلمة المرور غير صحيحة.";
                header('Location: ../index.php?page=login');
                exit;
            }

            // If we reach here, login is successful
            $_SESSION['user'] = [
                'email' => $user['email'],
                'name' => $user['name'],
                'logged_in' => true
            ];

            $_SESSION['success'] = "تم تسجيل الدخول بنجاح!";
            header('Location: ../index.php?page=home');
            exit;
        }
    }
}
