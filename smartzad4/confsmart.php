<?php
require_once dirname(__FILE__) . '/../vendor/autoload.php';

$smarty = new Smarty();

$smarty->setTemplateDir(dirname(__FILE__) . '/../templates/');
$smarty->setCompileDir(dirname(__FILE__) . '/../templates_c/');
$smarty->setCacheDir(dirname(__FILE__) . '/../cache/');
$smarty->setConfigDir(dirname(__FILE__) . '/../configs/');
?>