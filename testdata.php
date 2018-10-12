<?php

require('connection.php');
$database = new database();
$database = $database->connec();
$sql = 'SELECT * FROM it_it';
$sth = $database->prepare($sql);
$sth->execute();

$red = $sth->fetchAll(2);