<?php
include_once('conn.php');
include_once('database/dbChatlog.php');
include_once('database/dbChatID.php');

$con=connect();
if(!$con){
  die("Connection failed: " . mysqli_connect_error());
}else{
  echo "Connected successfully";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Check if the username and password are valid
    // Replace the code below with your authentication logic
  
    if ($username == "admin" && $password == "password") {
      // Redirect to a successful login page
      $uniqueID = uniqid('chat');
      add_ID($uniqueID);
      header("Location: main.php?chatID=$uniqueID");
      exit;
    } else {
      $error = "Invalid username or password";
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <style>
    .container {
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 10px;
    }

        
    input[type="text"],
        
    input[type="password"] {
        padding: 10px;
        margin-bottom: 10px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <form method="post" action="">
      <h2>Login</h2>
      <label for="username">Username</label>
      <input type="text" name="username" required>
      <label for="password">Password</label>
      <input type="password" name="password" required>
      <input type="submit" value="Login">
      <span class="error"><?php echo isset($error) ? $error : ""; ?></span>
    </form>
  </div>
</body>
</html>
