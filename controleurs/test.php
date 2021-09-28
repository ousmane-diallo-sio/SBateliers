<?php 


$logFile = fopen("/var/log/sbateliers/access.log", 'a+');

$test = "2";

fputs($logFile, "$test\n");
fclose($logFile);


?>