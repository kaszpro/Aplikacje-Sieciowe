<?php
session_start();
require_once dirname(__FILE__).'/../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Przykładowe dane logowania - możesz zamienić na logowanie z bazy danych
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['loggedin'] = true;
        header("Location: " . _APP_ROOT . "/app/calc.php");
        exit();
    } else {
        $error = "Nieprawidłowy login lub hasło!";
    }
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Logowanie</title>
</head>
<body>
    <h2>Zaloguj się</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="" method="post">
        <label>Login: <input type="text" name="username"></label><br>
        <label>Hasło: <input type="password" name="password"></label><br>
        <input type="submit" value="Zaloguj">
    </form>
</body>
</html>
// koniec
