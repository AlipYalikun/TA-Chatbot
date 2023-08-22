<?php 
include_once('conn.php');
include_once('database/dbChatlog.php');
include_once('database/dbChatID.php');
$con=connect();
if(!$con){
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate a unique ID for the new chat
    $uniqueID = uniqid('chat');
    add_ID($uniqueID);

    echo $uniqueID;
}
?>