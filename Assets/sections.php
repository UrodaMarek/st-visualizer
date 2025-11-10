<?php

function gen_menu(){
    $menu = <<<END
        a
    END;
    return $menu;
}

function gen_push_db_form(){
    return "";
}
function  gen_tables(){
    return "";
}
function gen_check_result(){
    return "";
}
function gen_log_in_form(){
    $log_in_form = <<<END
        <form action="index.php?option=log_in" method="POST">
            <label for="host">Host:</label><br>
            <input type="text" id="host" name="host" placeholder="Wpisz host" required><br><br>

            <label for="login">Login:</label><br>
            <input type="text" id="login" name="login" placeholder="Wpisz login" required><br><br>

            <label for="password">Hasło:</label><br>
            <input type="password" id="password" name="password" placeholder="Wpisz hasło" required><br><br>

            <input type="submit" value="Zaloguj">
        </form>
    END;
    return $log_in_form;
}