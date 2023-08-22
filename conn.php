<?php
function connect() {
    $host = "localhost"; 
    $database = "chatDB";
    $user = "root";
    $pass = "";
    $con = mysqli_connect($host,$user,$pass,$database);
    if (!$con) { echo "not connected to server"; return mysqli_error($con);}
    $selected = mysqli_select_db($con,$database);
    if (!$selected) { echo "database not selected"; return mysqli_error($con); }
    else return $con;
    
}
 
function disconnect($conn)
 {
 $conn -> close();
 }
   
?>