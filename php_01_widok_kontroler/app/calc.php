<?php
// KONTROLER kalkulatora kredytowego
require_once dirname(__FILE__).'/../config.php';

// 1. Pobranie parametrów
$kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
$lata = isset($_REQUEST['lata']) ? $_REQUEST['lata'] : null;
$oprocentowanie = isset($_REQUEST['pro']) ? $_REQUEST['pro'] : null;

// 2. Walidacja parametrów
$messages = [];

if (!isset($kwota, $lata, $oprocentowanie)) {
    $messages[] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

if ($kwota === "") {
    $messages[] = 'Nie podano kwoty kredytu.';
}
if ($lata === "") {
    $messages[] = 'Nie podano liczby lat.';
}
if ($oprocentowanie === "") {
    $messages[] = 'Nie podano oprocentowania.';
}

if (empty($messages)) {
    if (!is_numeric($kwota) || $kwota <= 0) {
        $messages[] = 'Kwota kredytu musi być liczbą dodatnią.';
    }
    if (!is_numeric($lata) || $lata <= 0) {
        $messages[] = 'Liczba lat musi być liczbą dodatnią.';
    }
    if (!is_numeric($oprocentowanie) || $oprocentowanie <= 0) {
        $messages[] = 'Oprocentowanie musi być liczbą dodatnią.';
    }
}

// 3. Obliczenia, jeśli brak błędów
if (empty($messages)) {
    $kwota = floatval($kwota);
    $lata = intval($lata);
    $oprocentowanie = floatval($oprocentowanie);

    $miesieczna_stopa = $oprocentowanie / 100 / 12;
    $liczba_rat = $lata * 12;

    // Formuła obliczeniowa dla raty kredytu
    $rata = ($kwota * $miesieczna_stopa) / (1 - pow(1 + $miesieczna_stopa, -$liczba_rat));
    $result = number_format($rata, 2);
}

// 4. Wywołanie widoku
include 'calc_view.php';
