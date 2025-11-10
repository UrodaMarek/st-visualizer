<?php

function query($q, $db_name = ""){
    $host = $_SESSION["host"];
    $user = $_SESSION["user"];
    $password = $_SESSION["password"];
    $database = $db_name;
    $assoc_t = [];

    $db = new mysqli("$host","$user","$password", "$database" );
    if ($db -> connect_errno) {
        $assoc_t["err"] = 4003;
    } else {
        $result =  $db -> query ($q);
        $db -> close();
        $assoc_t["result"] = $result;
        $assoc_t["err"] = 1000;
    }
    
    return $assoc_t;
}

function is_db_exists($db_name) {
    $q = "SELECT COUNT(*) AS `exists` FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMATA.SCHEMA_NAME='$db_name'";
    $assoc_t = [];
    $result = query($q);

    if ($result["err"] == 1000) {
        $table = $result["result"] -> fetch_assoc();
        $result["result"] -> close();
        if ($table["exists"] == 1) {
            $assoc_t["err"] = 1000;
        } else if ($table["exists"] == 0) {
            $assoc_t["err"] = 4004; // database not exist
        }
    } else {
        $assoc_t["err"] = 4003; // wrong login or password
    }
    return $assoc_t;
}