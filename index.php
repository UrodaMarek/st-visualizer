<?php
session_start();

require_once "./Database/db.php";
require_once "./Assets/sections.php";

$is_logged_in = $_SESSION['is_logged_in'];

if ($is_loged_in === TRUE) { 
    $content = gen_menu();
    if (isset($_GET["option"])) {
        switch ($_GET["option"]) {
            case "pusch_db":
                $content = gen_push_db_form();
                break;
            case "show_tables":
                $content = gen_tables();
                break;
            case "check_st":
                $content = gen_check_result();
                break;
        }
    }
} else {
    if (isset($_GET["option"])) {
        switch ($_GET["option"]) {
            case "log_in":
                log_in();
                break;
            default:
                $content = gen_log_in_form();
                break;
        }
    }
}

echo <<<END
        <!DOCTYPE html>
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