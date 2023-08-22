<?php 
include_once('conn.php');
include_once(dirname(__FILE__).'/../domain/chatLogUser.php');
include_once(dirname(__FILE__).'/../domain/chatLogBot.php');

function addUserChat($id, $chat) {
    $con = connect();
    
    // Use prepared statement
    $query = 'INSERT INTO userchatlog (userChatID, userMessage) VALUES (?, ?)';
    $stmt = mysqli_prepare($con, $query);
    
    // Bind parameters with appropriate data types
    mysqli_stmt_bind_param($stmt, 'ss', $id, $chat);
    
    // Execute the statement
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    
    return $result;
}
function addBotChat($id,$chat){
    $con = connect();
    $query = 'INSERT INTO botchatlog (botChatID, botMessage) VALUES (?, ?)';
    $stmt = mysqli_prepare($con, $query);
    
    // Bind parameters with appropriate data types
    mysqli_stmt_bind_param($stmt, 'ss', $id, $chat);
    
    // Execute the statement
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    
    return $result;
}



?>