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
    <head>
    <title>Admin Panel</title>
    <style>
    table {
    border-collapse: collapse;
    width: 100%;
    color: #fa4616;
    font-family: monospace;
    font-size: 20px;
    text-align: left;
    }
    th {
    background-color: #fa4616;
    color: black;
    }
    tr:nth-child(even) {background-color: #f2f2f2}
    td>a:visited {color: #fa4616}
    td>a:hover {color: #fc8a6a}
    td>a:active {color: #fa4616}
    </style>
    </head>
    <body>
    <table>
    <tr>
	<th>Place</th>
    <th>Username</th>
    <th>Score</th>
    </tr>
    <?php
    require_once "config.php";
    if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
    }
    $sql = "SELECT username, score FROM users ORDER BY score DESC";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
		$i = 1;
		while($row = $result->fetch_assoc()) {
			if ($row["username"] !== "admin") {
			echo "<tr><td>". $i ."</td><td><a href='profile.php?id=$id'>" . $row["username"]. "</a></td><td>" . $row["score"] . "</td></tr>";
			$i += 1;
			}
		}
    echo "</table>";
    } else { echo "0 results"; }
    $link->close();
    ?>
    </table>
    </body>
    </html>
