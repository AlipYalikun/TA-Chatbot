<?php
include_once('conn.php');
$con = connect();
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Chat History</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  
  * {
    box-sizing: border-box;
  }

  body {
    font-family: Arial, sans-serif;
    margin:0px;
    margin-bottom:0px;
  }

  .chatAndRefresh{
    display: flex;
    flex-direction: row;
    border: 1px solid #f8f8f8;
    justify-content: space-between;
    background-color: white;
    margin-bottom: 4px; 
    box-shadow:  0px 25px 20px -20px rgba(0, 0, 0, 0.5);
    padding-left: 40px; 
    padding-right:16px;
    padding-top: 10px;
    padding-bottom: 10px;
  }
  .searchbarWrapper{
    padding: 20px 5px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-content: center; 
    background-color: #f4f4f4;
  }
  .searchBar{
    margin-left: auto;
    display: flex;
    align-items: center;
  }
  .searchInput {
    padding: 6px 10px; 
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 200px;
    line-height: 1;
  }
  .searchButton {
    background-color: #f4f4f4;
    border: none; 
    padding: 6px 10px;
    border-radius: 4px;
    cursor: pointer;
    line-height: 1;
    color: black;
  }
  input::placeholder{
    font-style:italic;
  }

  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #f4f4f4;
  }

  tr {
    border-bottom: 1px solid #ddd;
  }
  tr:hover {
    background-color: #f5f5f5;
    cursor: pointer;
  }
  h4{
    font-weight: normal;
  }
  th{
    font-weight: normal;
    color: #494f55;
  }
  .refreshB{
    color: black;
  }
  .theadFixed th {
    position: sticky;
    top: 0;
    background-color: #f4f4f4;
    z-index: 1;
  }
  .scrollableContainer {
    max-height:60vh;
    overflow-y: auto;
  }
  a {
      text-decoration: none;
      color: #333; 
    }
  a:hover {
      text-decoration: underline;
      color: royalblue;
  }
  .signOutWrapper{
    padding-top: 30px;
    padding-bottom: 30px;
    padding-left: 10px;
    padding-right:20px;
    display: flex;
    height:auto;
    flex-direction: row;
    justify-content: space-between;
    align-content: center; 
    background-color: #f4f4f4;
  }
</style>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const rows = document.querySelectorAll(".clickableRow");
    rows.forEach(row => {
      row.addEventListener("click", () => {
        // Add your logic here for what should happen when a row is clicked
        console.log("Row clicked:", row);
      });
    });
  });
  function goBack() {
    window.history.back();
  }
</script>
</head>
<body>
  <div class="chatAndRefresh"> <!-- flex and direction row -->
    <div class="head">
      <h4>Chat History</h4>
    </div>
    <div class="refreshButton"> 
    <a href="javascript:void(0)" class="refreshB">
      <i class="fa fa-refresh" aria-hidden="true"></i>
    </a>
    </div>
  </div>
  <div class="searchbarWrapper"> <!-- flex and direction row -->
    <div class="searchBar">
      <input class="searchInput" type="text" placeholder="Search...">
      <a href="javascript:void(0)" class="searchButton">
        <i class="fa fa-search" aria-hidden="true"></i>
      </a>
    </div>
  </div>
  <div class="chatHistoryContainer"> <!-- table here without vertical line can be highlighted and click to access that certain chat -->
    <div class="historyTable">
      <?php 
          $chatHistory = array();
          $sql = "SELECT userMessage,userTimeStamp,userChatID FROM userchatlog GROUP BY userChatID ORDER BY userTimeStamp";
          $result = mysqli_query($con,$sql);
          echo"
          <div class='scrollableContainer'> 
            <table class='scrollableTable'>
            <thead class='theadFixed'>
            <tr>
                <th>Message</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody>";
          while ($row = mysqli_fetch_assoc($result)) {
                echo"<tr class='clickableRow'>
                <td>" . mb_strimwidth($row['userMessage'], 0, 50, "...") . "</td>
                <td>" . date("m/d/y", strtotime($row['userTimeStamp'])). "</td>
                </tr>";        
          }
          echo "
                </tbody>
              </table>
            </div>";
      ?>
    </div>
  </div>
  <div class="signOutWrapper">
    <a href="javascript:void(0)" onclick="goBack()">Click to go back</a>
    <div class="signOut">
      <a href="http://localhost/chatbot/login.php">Sign out </a>
    </div>
  </div>
</body>
</html>