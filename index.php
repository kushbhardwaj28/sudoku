<head>
    <style>
        table,tr,td{
            border: 1px solid black;
        }
    </style>
    
</head>

<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="pname" placeholder="Enter your name" required autocomplete="off" />
    <input type="submit" name='submit' value="submit" />
</form>
<?php
    session_start();
    $chk = 0;
    $con = mysql_connect("database_location","php_myadmin_user","php_admin_password");
    mysql_select_db("sudoku");                                                      //make a database named sudoku.in that make a table named
                                                                                    //sudokuplayer with two feilds p_name and p_time
    if(isset($_GET['submit'])){
        $players = mysql_query('select p_name from sudokuplayers');
            while($name = mysql_fetch_row($players)){
                if($_GET['pname'] == $name[0]){
                    echo 'Enter a unique name';
                    $chk = 1;
                    break;
                }
            }
        $pname = $_GET['pname'];
        if($chk == 0){
            $sql = mysql_query("insert into sudokuplayers(p_name) values('$pname')");
            $_SESSION['playerName'] = $pname;
            header("location:index1.php");
        }
    }
    $array1 =array();
    $sql = mysql_query('select * from sudokuplayers ORDER BY p_time');
    echo '<table><tr><td>NAME</td><td>TIME</td></tr>';
    while ($data = mysql_fetch_array($sql)){
        $array1[] = $data;
    }
    echo '<br />';
    $x = 0;
    for ($i = 0; $i<  count($array1); $i++) {
        if ($array1[$i][1] != '00:00:00') {
            //
            $temp1 = $array1[$x++][0];
            $array1[$x-1][0] = $array1[$i][0];
            $array1[$i][0] = $temp1;
            //
            $temp2 = $array1[$x-1][1];
            $array1[$x-1][1] = $array1[$i][1];
            $array1[$i][1] = $temp2;
            //
            $temp3 = $array1[$x-1]['p_name'];
            $array1[$x-1]['p_name'] = $array1[$i]['p_name'];
            $array1[$i]['p_name'] = $temp3;
            //
            $temp4 = $array1[$x-1]['p_time'];
            $array1[$x-1]['p_time'] = $array1[$i]['p_time'];
            $array1[$i]['p_time'] = $temp4;
        }
    }
 
    for ($i = 0; $i<  count($array1); $i++) {
         if($array1[$i]['p_time'] == '00:00:00')
            $array1[$i]['p_time'] = 'Yet Not Solved';
        echo '<tr><td>'.$array1[$i]['p_name'].'</td>'.'<td>'.$array1[$i]['p_time'].'</td></tr>';
    }
    echo '</table>';
?>
