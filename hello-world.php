<?php
header('content-type: application/json');

include_once 'W18T.class.php';

$environment = new W18T();
echo $environment;

?>