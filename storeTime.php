<?php
    session_start();
    $name = $_SESSION["playerName"];
    $con = mysql_connect("localhost","root","5874");
    mysql_select_db("sudoku");
    if(isset($_GET['time'])){
        $ptime = $_GET['time'];
            $sql = mysql_query("update sudokuplayers set p_time='$ptime' where p_name='$name';");
            echo mysql_error();
    }
?>
