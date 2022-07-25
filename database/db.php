<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "chart_check";
$db_conection= mysqli_connect($hostname, $username, $password, $dbname);
if(!$db_conection){
    echo "<br>connection failed :( <br>";
}
// else{
//     echo "ok";
// }

?>