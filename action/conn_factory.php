<?php
$localhost = "localhost";
$user = "root";
$password = "";
$db = "db_teste";

$conn = new PDO("mysql:dbname=" . $db . "; host=" . $localhost, $user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
