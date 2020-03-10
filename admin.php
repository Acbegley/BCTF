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
    <th>Username</th>
    <th>Score</th>
    <th>Admin</th>
    </tr>
    <?php
    require_once "config.php";
    if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
    }
    $sql = "SELECT username, score, id, admin FROM users";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $admin = $row["admin"];
    echo "<tr><td><a href='profile.php?id=$id'>" . $row["username"]. "</a></td><td>" . $row["score"] . "</td><td>" . $row["admin"] . "</td></tr>";
    }
    echo "</table>";
    } else { echo "0 results"; }
    $link->close();
    ?>
    </table>
    </body>
    </html>
