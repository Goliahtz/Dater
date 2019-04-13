<?php
include "src/Dater.php";
$dater = new Dater('now', 'Europe/Istanbul', 'tr');
print_r($dater->getInfo());
?>