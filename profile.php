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

h1 {
  text-align: center;
}
</style>
</head>
<body>

<div class="topnav">
  <a class="active" href="welcome.php">Home</a>
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

<html>
<body>
<?php 
require_once "config.php";
$id = $_GET["id"];
$sql = "SELECT username, score FROM users WHERE id = '$id'";
$result = $link->query($sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<h1>User: " . $row["username"]. "</h1><br>";
        echo "<h1>Score: " . $row["score"]. "</h1><br>";
    }
} else {
    echo "User not found";
}

if ($id == $_SESSION["id"]) {
echo "<h1><a href='reset.php'>Reset password</a>.</h1>";
}
$username = $_SESSION["username"];
 $sql = "SELECT admin FROM users WHERE username = '$username'";
 $query = mysqli_query($link, $sql);
 while($rs = mysqli_fetch_assoc($query)){
    $admin = $rs['admin'];
 if ($admin == 1)
        { 
			?>
			<form action="profile.php" method="post">
			<h1>Update Score: <input type="text" name="score" value=0><br>
			Set Admin: <br>
			<input type="radio" name="admin" value="yes"> Yes<br>
			<input type="radio" name="admin" value="no" checked> No<br>
			<input type="submit" name="submit"></h1>
			</form>
		<?php
		$score = $_POST['score'];
		if (is_int($score) == 1 && isset( $_POST['submit'] )) {
			$sqlScore = "UPDATE users SET score='$score' WHERE id='$id'";
			if(mysqli_query($link, $sqlScore)){
				echo "Records were updated successfully.";
			} else {
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
			}
		}
        }
  }
mysqli_close($link);
?>
</body>
</html>
