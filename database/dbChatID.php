<?php 
include_once('conn.php');
include_once(dirname(__FILE__).'/../domain/chatID.php');
include_once(dirname(__FILE__).'/../domain/chatLogUser.php');
include_once(dirname(__FILE__).'/../domain/chatLogBot.php');
function add_ID($id){
    $con = connect();
    $query = 'INSERT INTO chatid (ChatID) VALUES ("'.$id.'")';
    $result = mysqli_query($con, $query);
	mysqli_close($con);
	return $result;
}


?>