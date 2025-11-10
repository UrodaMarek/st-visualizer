<!DOCTYPE HTML>
<?php
session_start();

require_once "./Database/db.php";
require_once "./Assets/sections.php";

$is_logged_in = false;
if (isset($_SESSION["user"]) && isset($_SESSION["host"]) && isset($_SESSION["password"])) {
    if ($_SESSION["user"] != "" && $_SESSION["host"] != "") {
        $is_logged_in = true;
        if ((is_db_exists("st-visualizer"))["err"] != 1000) {
            if ((query("CREATE OR REPLACE DATABASE `st-visualizer` CHARACTER SET 'utf8' COLLATE 'utf8_polish_ci'"))["err"] == 4003) {
                $is_logged_in = false;
                $_SESSION["user"] = "";
                $_SESSION["password"] = "";
                $_SESSION["host"] = "";
                header("Location: ./index.php");
            } 
        }
    }
}


if ($is_logged_in === true) { 
    $content = gen_menu();
    if (isset($_GET["option"])) {
        switch ($_GET["option"]) {
            case "pusch_db":
                $content .= gen_push_db_form();
                break;
            case "check_st":
                $content .= gen_check_result();
                break;
            case "show_tables":
            default:
                $content .= gen_tables();
        }
    }
} else {
    
    if (isset($_GET["option"])) {
        switch ($_GET["option"]) {
            case "log_in":
                $flag = false;
                if (isset($_POST["user"]) && isset($_POST["host"]) && isset($_POST["password"])) {
                    if ($_POST["user"] != "" && $_POST["host"] != "") {
                        $_SESSION["user"] = $_POST["user"];
                        $_SESSION["password"] = $_POST["password"];
                        $_SESSION["host"] = $_POST["host"];
                        header("Location: ./index.php?option=show_tables");
                    } else $flag = true;
                } else $flag = true;
                if ($flag) header("Location: ./index.php");
                break;
        }
    } else $content = gen_log_in_form();
}

echo <<<END
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>st-visualizer</title>
        </head>
        <body>
            $content
        </body>
        </html>
END;