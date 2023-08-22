<?php 
include_once('conn.php');
include_once('database/dbChatlog.php');
include_once('database/dbChatID.php');
$con=connect();
if(!$con){
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['textBot']) && isset($_GET['chatID'])) {
  $textBot = $_POST['textBot'];
  $id = $_GET['chatID'];
  addBotChat($id,$textBot);
}
?>