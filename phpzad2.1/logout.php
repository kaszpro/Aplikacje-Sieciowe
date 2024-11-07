<?php
session_start();
session_unset();
session_destroy();
header("Location: " . _APP_ROOT . "/app/security/login.php");
exit();
?>
