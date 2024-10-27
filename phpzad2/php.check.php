<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: " . _APP_ROOT . "/app/security/login.php");
    exit();
}
?>
