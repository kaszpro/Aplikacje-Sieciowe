<?php
// KONTROLER strony kalkulatora kredytowego
require_once dirname(__FILE__).'/../config.php';

// Pobranie parametrów z formularza
$amount = $_REQUEST['amount']; // Kwota kredytu
$years = $_REQUEST['years'];   // Okres spłaty w latach
$interest = $_REQUEST['interest']; // Oprocentowanie