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
  <title>Teacher Assistance Bot</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <style>
    /* Common Styles */
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    /* Chat Container */
    .bigContainer {
      display: flex;
      flex-direction: row;
      height: 100vh;
    }

    .accountInfoContainer {   
      width: 250px;
      background-image: linear-gradient(30deg, #630031, #CF4420);
      color: #fff;
    }

    aside {
      padding: 20px;
    }

    aside p {
      margin: 0;
      padding: 10px 0;
      font-size: 18px;
      font-weight: bold;
    }

    aside a {
      display: flex;
      align-items: center;
      font-size: 14px;
      color: #fff;
      text-decoration: none;
      padding: 12px;
      padding-left: 30px;
      transition: background-color 0.3s ease;
    }

    aside a:hover {
      background-color: #fff;
      color: #CF4420;
    }

    aside a i {
      margin-right: 10px;
    }

    /* Chat Interface */
    .right_container {
      flex: 1;
      display: flex;
      flex-direction: column;
      background-color: #f4f7fa;
      padding: 20px;
    }

    .interactionContainer {
      flex: 1;
      background-color: #fff;
      overflow-y: auto;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .message {
      margin-bottom: 15px;
    }

    .sender {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .text {
      margin: 0;
    }

    .questionContainer {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    textarea {
      width: 100%;
      resize: none;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 3px;
      min-height: 40px;
    }

    input[type="submit"] {
      padding: 8px 16px;
      background-color: #44a7fd;
      border: none;
      color: #fff;
      font-size: 14px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #3f5efb;
    }
    .messageUser {
    display: flex;
    flex-direction: column; 
    justify-content: flex-end;
    align-items: flex-end;
    margin-bottom: 15px;
    }

    .senderUser {
      font-weight: bold;
      margin-bottom: 5px;
      color: #CF4420; 
    }
    .textUser {
    margin: 0;
    color: black; 
    border-radius: 5px;
    }
    .senderBot{
      font-weight: bold;
      margin-bottom: 5px;
      color: #630031;
    }
    .messageBot{
      margin-bottom: 15px;
    }
    #vtimg{
      margin-left: 15%;
    }
    .copyright{ 
      position: absolute;
      bottom: 0px;
      font-size: 8px;
      margin: 0 auto;
    }
    

  </style>
</head>
<body>
  <div class="bigContainer">
    <div class="accountInfoContainer">
      <aside>
        <img src='vt.png' alt='vt logo' id='vtimg' width='120px' height='70px'>
        <p>Menu</p>
        <a href="javascript:void(0)" id='newChat'>
          <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
          Start New Chat
        </a>
        <a href="javascript:void(0)" id='accountInfo'>
          <i class="fa fa-address-card-o fa-fw" aria-hidden="true"></i>
          View Account
        </a>
        <a href="javascript:void(0)" id='chathis'>
          <i class="fa fa-archive fa-fw" aria-hidden="true"></i>
          Chat History
        </a>
        <a href="http://localhost/chatbot/login.php">
          <i class="fa fa-sign-out fa-lg fa-fw" aria-hidden="true"></i>
          Sign out
        </a>
      </aside>
      <div class="copyright"><p><span>&copy; Author of this chatbot: Alip</span></p></div>
    </div>
    <div class="right_container">
      <div class="interactionContainer" id="chatMessages">
        <!-- Chat messages go here -->
      </div>
      <div class="questionContainer">
        <form action="" id="chatForm" method="post">
          <p><label for="ask">Ask anything you would like:</label></p>
          <textarea id="ask" name="askQuestion" placeholder="Type your message"></textarea>
          <input type="submit" value="Send" id="enterK">
        </form>
      </div>
    </div>
  </div>
   
  </body>
  <script>
    const chatForm = document.getElementById('chatForm');
    const chatMessages = document.getElementById('chatMessages');
    document.getElementById('ask').addEventListener("keydown",function(e){
      if(e.keyCode == 13 && !e.shiftKey){
        e.preventDefault();
        document.getElementById("enterK").click();
      } 
    });

    // Get the current URL
    const currentUrl = window.location.href;
    // Parse the URL to extract parameters
    const urlParams = new URLSearchParams(new URL(currentUrl).search);
    // Get the value of the chatID parameter
    const chatID = urlParams.get('chatID');
    chatForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const messageInput = document.getElementById('ask');
      const message = messageInput.value.trim();
      if (message !== '') {
        displayMessageUser('User', message);
        messageInput.value = '';
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'addLogUser.php?chatID=' + chatID, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              console.log('User message stored');
              console.log('Sending user message:', message);
            } else {
              console.error('Error storing user message');
            }
          }
        };
        xhr.send('textUser=' + encodeURIComponent(message));
        setTimeout(function() {
        displayMessageBot('Chatbot', 'This is a response from the chatbot.');
        // AJAX request to store bot message
        const botXhr = new XMLHttpRequest();
        botXhr.open('POST', 'addLogBot.php?chatID=' + chatID, true);
        botXhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        botXhr.onreadystatechange = function() {
          if (botXhr.readyState === XMLHttpRequest.DONE) {
            if (botXhr.status === 200) {
              console.log('Bot message stored');
            } else {
              console.error('Error storing bot message');
            } }
          };
          botXhr.send('textBot=' + encodeURIComponent('This is a response from the chatbot.'));
        }, 1000);
      }
      });
    
    //to account information
    document.getElementById('accountInfo').addEventListener("click", function(event){
            event.preventDefault();
            window.location.href = "accountProfile.php";
    });
    //to chat history 
    document.getElementById('chathis').addEventListener("click", function(event){
            event.preventDefault();
            window.location.href = "chatHistory.php";
    });
    document.getElementById("newChat").addEventListener("click", function(event) {
            event.preventDefault();
            // Make an AJAX request to newChatID.php to generate the unique ID
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "newChatID.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Once the chat ID is generated, redirect to the same page with the unique ID
                        var chatID = xhr.responseText;
                        window.location.href = "main.php?chatID=" + chatID;
                    } else {
                        console.error("Error creating new chat.");
                    }
                }
              };
            xhr.send();
      });
    
    // message architechture
    function displayMessageUser(sender, text) {
      const messageDiv = document.createElement('div');
      messageDiv.className = 'messageUser';

      const senderDiv = document.createElement('div');
      senderDiv.className = 'senderUser';
      senderDiv.textContent = sender;

      const textDiv = document.createElement('div');
      textDiv.className = 'textUser';
      textDiv.textContent = text;

      messageDiv.appendChild(senderDiv);
      messageDiv.appendChild(textDiv); 

      chatMessages.appendChild(messageDiv);
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    function displayMessageBot(sender, text) {
      const messageDiv = document.createElement('div');
      messageDiv.className = 'messageBot';

      const senderDiv = document.createElement('div');
      senderDiv.className = 'senderBot';
      senderDiv.textContent = sender;

      const textDiv = document.createElement('div');
      textDiv.className = 'textBot';
      textDiv.textContent = text;

      messageDiv.appendChild(senderDiv);
      messageDiv.appendChild(textDiv); 

      chatMessages.appendChild(messageDiv);
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }
  </script>
</body>
</html>