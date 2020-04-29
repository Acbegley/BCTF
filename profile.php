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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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

h1 {
  text-align: center;
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

<html>
<body>
<center>
<?php 
require_once "config.php";
$id = $_GET["id"];
$sql = "SELECT username, score FROM users WHERE id = '$id'";
$result = $link->query($sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "User: " . $row["username"]. "<br>";
        echo "Score: " . $row["score"]. "<br>";
    }
} else {
    echo "User not found";
}

if ($id == $_SESSION["id"]) {
echo "<a href='reset.php'>Reset password</a>.";
}
$username = $_SESSION["username"];
 $sql = "SELECT admin FROM users WHERE username = '$username'";
 $query = mysqli_query($link, $sql);
 while($rs = mysqli_fetch_assoc($query)){
    $admin = $rs['admin'];
 if ($admin == 1)
        { 
			?>
			<form method="post">
			Update Score: <input type="text" name="score"><br>
			<input type="checkbox" name="setAdmin" value="yes">
			<label for="setAdmin"> Set Admin</label><br>
			<input type="checkbox" name="rmAdmin" value="no">
			<label for="rmAdmin"> Remove Admin</label><br>
			<input type="submit" class="btn btn-warning" name="submit"value="Submit">
			</form>
			</center>
		<?php
		if (isset( $_POST['score'] )) {
			$score = $_POST['score'];
			$sqlScore = "UPDATE users SET score='$score' WHERE id='$id'";
			mysqli_query($link, $sqlScore);
			header("Refresh:0");
		}
		if ($_POST['setAdmin'] == 'yes' && $_POST['rmAdmin'] == 'no') {
			echo "<h1>Only select one</h1>";
		} 
		elseif (isset( $_POST['setAdmin']) && $_POST['setAdmin'] == 'yes' ) {
			$sqlAdmin = "UPDATE users SET admin=1 WHERE id='$id'";
			mysqli_query($link, $sqlAdmin);
		}
		elseif (isset( $_POST['rmAdmin']) && $_POST['rmAdmin'] == 'no' ) {
			$sqlAdmin = "UPDATE users SET admin=0 WHERE id='$id'";
			mysqli_query($link, $sqlAdmin);
		}
	}
  }
mysqli_close($link);
?>
</body>
</html>
