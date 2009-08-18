<?php
include('autoload.php');

$authentClass = new Authentification();
$authentClass->logout();
header ('location:/index.php');