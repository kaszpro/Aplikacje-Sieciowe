<?php
require_once dirname(__FILE__) . '/../config.php';
require_once dirname(__FILE__) . '/LoanCalculator.php';
require_once dirname(__FILE__) . '/RequestValidator.php';
require_once dirname(__FILE__) . '/LoanResult.php';
require_once dirname(__FILE__) . '/../smarty_init.php';
include _ROOT_PATH . '/app/security/check.php';

// Pobranie danych wejściowych
$data = $_REQUEST;

// Walidacja danych
$validator = new RequestValidator();
$result = new LoanResult();

if ($validator->validate($data)) {
    // Dane są poprawne
    $calculator = new LoanCalculator(floatval($data['amount']), intval($data['years']), floatval($data['interest']));
    $monthlyPayment = $calculator->calculateMonthlyPayment();
    $result->setMonthlyPayment(round($monthlyPayment, 2));
} else {
    // Dane są niepoprawne
    $result->setErrors($validator->getErrors());
}

// Przekazanie danych do szablonu
$smarty->assign('amount', $data['amount'] ?? '');
$smarty->assign('years', $data['years'] ?? '');
$smarty->assign('interest', $data['interest'] ?? '');
$smarty->assign('messages', $result->getErrors());
$smarty->assign('result', $result->getMonthlyPayment());

// Renderowanie widoku
$smarty->display('credit_calc.tpl');
?>