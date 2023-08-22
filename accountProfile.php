<?php
include_once('conn.php');
include_once('database/dbChatlog.php');
include_once('database/dbChatID.php');
$con=connect();
if(!$con){
  die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }
    h2{
        font-family: Arial, sans-serif;
        font-weight: normal;
    }
    .interactionContainer {
        margin:0 auto;
        margin-top:2rem;
        flex: 1;
        display: flex;
        flex-direction: row;
        height: 90vh;
        width:95vw;
        background-color: #fff;
        overflow-y: auto;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px grey;
    }
    .insideLeft{
        margin:0 auto;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width:40vw;
        height: auto;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    .insideLeftTop {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 5px 5px 0 0;
    }
    .profilePic{
        margin: 0 auto;
    }
    .profilePic img{
        width:80px;
        height:80px;
        border-radius: 40%;
    }
    .insideLeftBottom {
        padding: 20px;
        background-color: #fff;
        border-radius: 0 0 5px 5px;
    }
    .insideLeftBottom{
        margin: 0 auto;
        margin-bottom: 28%;
    }
    .emailOfUser{
        margin-top: 6rem;
    }
    .insideRight{
        width:40vw;
        height: auto;
        margin:0 auto;
        display: flex;
        flex-direction: column;
    }
    .signOutWrapper{
        margin-top: auto;
        margin: 0 auto;
        width:100%;
        height: auto;
        background-color: #f5f5f5;
        border-radius: 5px 5px 0 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: absolute;
        bottom: 0px; /* Adjust this value to fine-tune the position */
        left: 50%;
        transform: translateX(-50%); /* Center horizontally */
        text-align: center;
    }
    .signOut{
        padding: 3px;
    }
   
    .orgo{
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        height:40vh;
        margin-bottom:20px;
    }
    .usage{
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        height:40vh;
    }
    a {
      text-decoration: none;
      color: #333; 
    }
    a:hover {
      text-decoration: underline;
      color: royalblue;
    }

</style>
<script>
    function goBack() {
        window.history.back();
    }
</script>
</head>
<body>
<div class="interactionContainer" id="bigGround">
    <div class="insideLeft">
        <div class="insideLeftTop">
            <div class="profilePic">
                <img src='pfp.jpg' alt='profile picture default' id='pfpimg'>
            </div>
        </div>
        <div class="insideLeftBottom">
            <div class="nameOfUser">
                <h2>Name Of User</h2>
            </div>
            <div class="emailOfUser">
                <p>example@email.edu<p>
            </div>
        </div>
        <div class="signOutWrapper">
            <a href="javascript:void(0)" onclick="goBack()">Click to go back</a>
            <div class="signOut">
             <a href="http://localhost/chatbot/login.php">Sign out </a>
            </div>
        </div>
    </div>
    <div class="insideRight">
        <div class="orgo"><p>123</p></div>
        <div class="usage"><p>456</p></div>
    </div>
</div>
</body>
</html>