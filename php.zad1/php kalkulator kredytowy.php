<?php
// KONTROLER strony kalkulatora kredytowego
require_once dirname(__FILE__).'/../config.php';

// Pobranie parametrów z formularza
$amount = $_REQUEST['amount']; // Kwota kredytu
$years = $_REQUEST['years'];   // Okres spłaty w latach
$interest = $_REQUEST['interest']; // Oprocentowanie

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
    // Sprawdzenie, czy kwota, okres i oprocentowanie są liczbami
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

// Obliczenia kredytowe, jeżeli brak błędów
if (empty($messages)) {
    $amount = floatval($amount); // Kwota kredytu
    $years = intval($years);     // Okres w latach
    $interest = floatval($interest); // Oprocentowanie roczne

    // Obliczenie miesięcznej raty kredytu
    $monthly_interest = $interest / 12 / 100; // Miesięczna stopa procentowa
    $months = $years * 12; // Ilość miesięcy

    if ($monthly_interest > 0) {
        $monthly_payment = $amount * ($monthly_interest / (1 - pow(1 + $monthly_interest, -$months)));
    } else {
        // Jeśli oprocentowanie wynosi 0
        $monthly_payment = $amount / $months;
    }

    $result = round($monthly_payment, 2);
}

// Wywołanie widoku z przekazaniem zmiennych
include 'credit_calc_view.php';
