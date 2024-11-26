<?php
// KONTROLER strony kalkulatora kredytowego
require_once dirname(__FILE__) . '/../config.php';

// 1. Pobranie parametrów
$amount = $_REQUEST['amount'];
$years = $_REQUEST['years'];
$interest = $_REQUEST['interest'];

// 2. Walidacja parametrów z przygotowaniem zmiennych dla widoku
if (!(isset($amount) && isset($years) && isset($interest))) {
    $messages[] = 'Brak jednego z parametrów.';
}

if ($amount == "") {
    $messages[] = 'Nie podano kwoty kredytu.';
}
if ($years == "") {
    $messages[] = 'Nie podano liczby lat.';
}
if ($interest == "") {
    $messages[] = 'Nie podano oprocentowania.';
}

if (empty($messages)) {
    if (!is_numeric($amount) || $amount <= 0) {
        $messages[] = 'Kwota kredytu musi być liczbą dodatnią.';
    }
    if (!is_numeric($years) || $years <= 0) {
        $messages[] = 'Liczba lat musi być liczbą dodatnią.';
    }
    if (!is_numeric($interest) || $interest < 0) {
        $messages[] = 'Oprocentowanie musi być liczbą nieujemną.';
    }
}

// 3. Obliczenia
if (empty($messages)) {
    $amount = floatval($amount);
    $years = intval($years);
    $interest = floatval($interest);

    // Liczba miesięcy
    $months = $years * 12;

    // Miesięczne oprocentowanie
    $monthly_rate = $interest / 100 / 12;

    if ($monthly_rate > 0) {
        $result = $amount * $monthly_rate / (1 - pow(1 + $monthly_rate, -$months));
    } else {
        $result = $amount / $months;
    }
}

// 4. Wywołanie widoku
include 'calc_view.php';
?>
