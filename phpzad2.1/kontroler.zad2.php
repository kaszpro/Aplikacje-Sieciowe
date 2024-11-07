<?php
// KONTROLER strony kalkulatora kredytowego
require_once dirname(__FILE__).'/../config.php';

// Ochrona dostępu
include _ROOT_PATH . '/app/security/check.php';

// Pobranie parametrów z formularza
$amount = $_REQUEST['amount'];
$years = $_REQUEST['years'];
$interest = $_REQUEST['interest'];

