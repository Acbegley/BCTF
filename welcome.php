<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #f5740a;
  color: white;
}
</style>
</head>
<body>

<div class="topnav">
  <a class="active" href="welcome.php">Home</a>
  <a href='challenge.php'>Challenges</a>
  <a href='leaderboard.php'>Leaderboard</a>
  <?php
  require_once "config.php";
  $username = $_SESSION["username"];
  $id = $_SESSION["id"];
  echo "<a href='profile.php?id=$id'>Profile</a>";
  $sql = "SELECT admin FROM users WHERE username = '$username'";
  $query = mysqli_query($link, $sql);
  while($rs = mysqli_fetch_assoc($query)){
    $admin = $rs['admin'];
 if ($admin == 1)
        { 


  ?>
  <a href="admin.php">Admin</a>
  <?php
        }
  }
  ?>
  <a href="logout.php">Logout</a>
</div>

</body>
</html>

<!DOCTYPE html>
<html>
<title>Welcome</title>
<center>
<img src="https://www.indianatech.edu/wp-content/uploads/warrior.white_.outline.png" alt="Warrior Logo">
<h1>Welcome to BCTF</h1>
</center>
</html>
