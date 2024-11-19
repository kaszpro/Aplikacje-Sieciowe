<?php
require_once dirname(__FILE__) . '/../config.php';
require_once dirname(__FILE__) . '/../smarty_init.php';

// Przekazanie danych do szablonu
$smarty->assign('title', 'Strona główna');
$smarty->assign('menu', [
    ['label' => 'Kalkulator kredytowy', 'link' => '?action=calc'],
    ['label' => 'Wyloguj', 'link' => _APP_ROOT . '/app/security/logout.php'],
]);

// Renderowanie szablonu
$smarty->display('home.tpl');
?>
