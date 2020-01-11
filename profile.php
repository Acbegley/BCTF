<!DOCTYPE html>
<html>
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
  <a href="logout.php">Logout</a>
</div>


</body>
</html>
<html>
<body>
<?php 
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
$query = "SELECT score FROM users where id = ?";
$param_id = $_SESSION["id"];
 
 
echo '<table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">Score</font> </td>  
      </tr>';
 
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["score"];
 
        echo '<tr> 
                  <td>'.$field1name.'</td>
              </tr>';
    }
    $result->free();
} 
?>
</body>
</html>