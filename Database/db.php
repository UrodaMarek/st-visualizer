<?php

function query($q, $db = ''){
    $host = $_SESSION['host'];
    $user = $_SESSION['user'];
    $password = $_SESSION['password'];
    $database = $db;

    $db = new mysqli("$host","$user","$password", "$database" );
    if ($db -> connect_errno) {
        return false;
    }

    $r =  $db -> query ($q);
    $db -> close();

    return $r -> fetch_assoc();
}

function is_db_exists($db_name) {
    $q = "SELECT COUNT(*) AS `exists` FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMATA.SCHEMA_NAME='$db_name'";

    if ($r = query($q)) {
        if ($r["exists"] == 1) {
            return true;
        } else if ($r["exists"] == 0) {
            return false; // database not exist
        }
    } else {
        return false; // wrong login or password
    }
}