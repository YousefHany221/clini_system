<?php
require_once "views/layout/header.php";
require_once "views/layout/nav.php";
$page = $_GET['page'] ?? 'home';
switch ($page) {
    case 'contact-controllers':
        require_once "Controllers/ContactControllers.php";
        break;
    case 'home':
        require_once "views/home.php";
        break;
    case 'login':
        require_once "views/login.php";
        break;
    case 'register':
        require_once "views/register.php";
        break;
    case 'contact':
        require_once "views/contact.php";
        break;
    case 'majors':
        require_once "views/majors.php";
        break;
    case 'doctors':
        require_once "views/doctors/index.php";
        break;
    case 'doctor':
        require_once "views/doctors/doctor.php";
        break;
    case 'appointment':
        require_once "views/doctors/doctor.php"; // Using doctor.php as appointment page
        break;
    case 'dashpord':
        require_once "views/admin/dashboard.php"; // Using doctor.php as appointment page
        break;
    case 'create_doctor':
        require_once "views/admin/create_doctor.php"; // Using doctor.php as appointment page
        break;
    case 'apoiments':
        require_once "views/admin/apoiments.php"; // Using doctor.php as appointment page
        break;
    default:
        require_once "views/home.php";
        break;
}
require_once "views/layout/footer.php";
