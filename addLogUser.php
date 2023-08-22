<?php 
include_once('conn.php');
include_once('database/dbChatlog.php');
include_once('database/dbChatID.php');
$con=connect();
if(!$con){
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['textUser']) && isset($_GET['chatID'])) {
  $textUser = $_POST['textUser'];
  $id = $_GET['chatID'];
  addUserChat($id,$textUser);
}

?>