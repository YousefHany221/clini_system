<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
$success = $_SESSION['success'] ?? '';
unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['success']);
?>