<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
  $username = $_SESSION["username"];
  $sql = "SELECT admin FROM users WHERE username = '$username'";
  $query = mysqli_query($link, $sql);
  while($rs = mysqli_fetch_assoc($query)){
    $admin = $rs['admin'];
 if ($admin == 0)
        { 
        header("location: welcome.php");
        }
  }
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
p {
  margin: 35px;
}
</style>
</head>
<body>

<div class="topnav">
  <a class="active" href="welcome.php">Home</a>
  <a href='challenge.php'>Challenges</a>
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<p class="1">Name<br><textarea name="name" rows=1 cols=50 placeholder="Challenge name"></textarea><br>
			Category<br><textarea name="category" rows=1 cols=50 placeholder="Cryptography"></textarea><br>
			Description<br><textarea name="description" rows=4 cols=50 placeholder="Description"></textarea><br>
			Flag<br><textarea name="flag" rows=1 cols=50 placeholder="flag{VpGUEszSoOPLg8alGWnnzAnrbj60gcAC}"></textarea><br>
			Hint<br><textarea name="hint" rows=4 cols=50 placeholder="Hints (Leave blank if you do not want to give a hint)"></textarea><br>
			Hint Cost<br><input type="text" name="hintCost" value="0"><br>
			Points<br><input type="text" name="points" placeholder="123"><br>
			Attempts<br><input type="text" name="attempts" placeholder="3"><br>
			<input type="submit"  class="btn btn-warning" value="Submit" name="submit_button"></p>
			</form>
<?php
if(isset($_POST['submit_button'])) {
	require_once "config.php";
    if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
    }
	$name = $_POST['name'];
	$category = $_POST['category'];
	$description = $_POST['description'];
	$flag = $_POST['flag'];
	$points = $_POST['points'];
	$attempts = $_POST['attempts'];
	$hint = $_POST['hint'];
	$hintCost = $_POST['hintCost'];
	$sql = "INSERT INTO challenge (name, category, description, flag, points, attempts, hint, hintCost ) VALUES ('$name', '$category', '$description', '$flag', '$points', '$attempts', '$hint', '$hintCost')";
	if ($link->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}
}
mysqli_close($link);
?>
</html>