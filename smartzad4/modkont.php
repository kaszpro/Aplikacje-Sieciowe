<?php
require_once dirname(__FILE__) . '/../config.php';
require_once dirname(__FILE__) . '/../smarty_init.php';
include _ROOT_PATH . '/app/security/check.php';

// Pobranie parametrów
$amount = $_REQUEST['amount'];
$years = $_REQUEST['years'];
$interest = $_REQUEST['interest'];
$messages = [];

// Walidacja parametrów
if (!isset($amount) || !isset($years) || !isset($interest)) {
    $messages[] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

if ($amount == "") {
    $messages[] = 'Nie podano kwoty kredytu';
}
if ($years == "") {
    $messages[] = 'Nie podano okresu spłaty';
}
if ($interest == "") {
    $messages[] = 'Nie podano oprocentowania';
}

if (empty($messages)) {
    if (!is_numeric($amount)) {
        $messages[] = 'Kwota kredytu musi być liczbą';
    }
    if (!is_numeric($years)) {
        $messages[] = 'Okres spłaty musi być liczbą';
    }
    if (!is_numeric($interest)) {
        $messages[] = 'Oprocentowanie musi być liczbą';
    }
}

if (empty($messages)) {
    $amount = floatval($amount);
    $years = intval($years);
    $interest = floatval($interest);

    $monthly_interest = $interest / 12 / 100;
    $months = $years * 12;

    if ($monthly_interest > 0) {
        $monthly_payment = $amount * ($monthly_interest / (1 - pow(1 + $monthly_interest, -$months)));
    } else {
        $monthly_payment = $amount / $months;
    }

    $result = round($monthly_payment, 2);
} else {
    $result = null;
}

// Przekazanie zmiennych do szablonu
$smarty->assign('amount', $amount);
$smarty->assign('years', $years);
$smarty->assign('interest', $interest);
$smarty->assign('messages', $messages);
$smarty->assign('result', $result);

// Renderowanie szablonu
$smarty->display('credit_calc.tpl');
?>