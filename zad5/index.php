<?php
require_once dirname(__FILE__) . '/app/config.php';
require_once dirname(__FILE__) . '/app/smarty_init.php';

$action = $_GET['action'] ?? 'home'; // Domyślna akcja to 'home'

switch ($action) {
    case 'calc':
        include dirname(__FILE__) . '/app/actions/credit_calc.php';
        break;
    case 'home':
    default:
        include dirname(__FILE__) . '/app/actions/home.php';
        break;
}
?>