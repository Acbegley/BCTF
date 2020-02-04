<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<title>Profile</title>
<head>
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
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>

<div class="topnav">
  <a class="active" href="welcome.php">Home</a>
  <a href="profile.php">Profile</a>
  <?php
  require_once "config.php";
  $username = $_SESSION["username"];
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

<html>
<body>
<?php 
require_once "config.php";
//$username = $_SESSION["username"];
$id = $_GET["id"];
$usersql = "SELECT username FROM users WHERE id = '$id'";
$userResult = $link->query($usersql);
echo "User: " . $user. "<br>";
$sql = "SELECT score FROM users WHERE username = '$userResult'";
$result = $link->query($sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "score: " . $row["score"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($link);
?>
<p><a href="reset.php">Reset password</a>.</p>
</body>
</html>
