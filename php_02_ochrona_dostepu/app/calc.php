<?php
require_once dirname(__FILE__).'/../config.php';

// KONTROLER strony kalkulatora kredytowego

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

// Pobranie parametrów
function getParams(&$amount, &$years, &$rate) {
    $amount = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
    $years = isset($_REQUEST['lata']) ? $_REQUEST['lata'] : null;
    $rate = isset($_REQUEST['pro']) ? $_REQUEST['pro'] : null;
}

// Walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$amount, &$years, &$rate, &$messages) {
    // sprawdzenie, czy parametry zostały przekazane
    if (!(isset($amount) && isset($years) && isset($rate))) {
        return false; // brak parametrów, nie wykonujemy obliczeń
    }

    // sprawdzenie, czy podano wartości
    if ($amount === "") {
        $messages[] = 'Nie podano kwoty kredytu.';
    }
    if ($years === "") {
        $messages[] = 'Nie podano liczby lat.';
    }
    if ($rate === "") {
        $messages[] = 'Nie podano oprocentowania.';
    }

    // nie ma sensu walidować dalej, gdy brak parametrów
    if (count($messages) != 0) return false;

    // sprawdzenie, czy parametry są liczbami dodatnimi
    if (!is_numeric($amount) || $amount <= 0) {
        $messages[] = 'Kwota kredytu musi być liczbą dodatnią.';
    }
    if (!is_numeric($years) || $years <= 0) {
        $messages[] = 'Liczba lat musi być liczbą dodatnią.';
    }
    if (!is_numeric($rate) || $rate <= 0) {
        $messages[] = 'Oprocentowanie musi być liczbą dodatnią.';
    }

    return count($messages) == 0;
}

// Przetwarzanie danych i obliczanie wyniku
function process(&$amount, &$years, &$rate, &$result) {
    // konwersja parametrów
    $amount = floatval($amount);
    $years = intval($years);
    $rate = floatval($rate);

    // obliczenia
    $monthlyRate = $rate / 100 / 12; // miesięczne oprocentowanie
    $months = $years * 12; // liczba miesięcy
    $monthlyPayment = ($amount * $monthlyRate) / (1 - pow(1 + $monthlyRate, -$months));

    // zapis wyniku
    $result = number_format($monthlyPayment, 2);
}

// Definicja zmiennych kontrolera
$amount = null;
$years = null;
$rate = null;
$result = null;
$messages = [];

// Pobranie parametrów i wykonanie obliczeń, jeśli brak błędów
getParams($amount, $years, $rate);
if (validate($amount, $years, $rate, $messages)) {
    process($amount, $years, $rate, $result);
}

// Wywołanie widoku z przekazaniem zmiennych
include 'calc_view.php';
