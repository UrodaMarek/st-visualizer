<?php

function gen_menu(){
    $menu = <<<END
        <a href="./index.php?option=push_db">Push Tables</a>  -  
        <a href="./index.php?option=show_tables">Show Tables</a> - 
        <a href="./index.php?option=check_st">Summarize<a/> - 
        <a href="./index.php?option=log_out">Log out</a></br>
    END;
    return $menu;
}

function gen_push_db_form(){
    return "Coming soon";
}
function  gen_tables(){
    $q = "SELECT `barcode` FROM `st`";
    $arr = query($q, "st_visualizer");
    $table = "<h3>Barcodes of scanned st</h3><table>";
    if ($arr["err"] == 1000) {
        while ($data = ($arr["result"] -> fetch_row())) {
            $table .=<<<END
                <tr>
                    <td>
                        $data[0]
                    </td>
                </tr>
            END;
        }
    }
    $table .= "</table>";
    return $table;
}
function gen_check_result(){
    return "c";
}
function gen_log_in_form(){
    $log_in_form = <<<END
        <form action="index.php?option=log_in" method="POST">
            <label for="host">Host:</label><br>
            <input type="text" id="host" name="host" placeholder="Host of database" required><br><br>

            <label for="user">User:</label><br>
            <input type="text" id="user" name="user" placeholder="User" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" placeholder="Password"><br><br>

            <input type="submit" value="Log in">
        </form>
    END;
    return $log_in_form;
}