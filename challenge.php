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
.vertical-center {
  margin: 0;
  position: absolute;
  top: 50%;
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}
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
body {font-family: Arial, Helvetica, sans-serif;}

.modal-window {
  position: fixed;
  background-color: rgba(200, 200, 200, 0.75);
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 999;
  opacity: 0;
  pointer-events: none;
  -webkit-transition: all 0.3s;
  -moz-transition: all 0.3s;
  transition: all 0.3s;
}

.modal-window:target {
  opacity: 1;
  pointer-events: auto;
}

.modal-window>div {
  width: 400px;
  position: relative;
  margin: 10% auto;
  padding: 2rem;
  background: #fff;
  color: #444;
}

.modal-window header {
  font-weight: bold;
}

.modal-close {
  color: #aaa;
  line-height: 50px;
  font-size: 80%;
  position: absolute;
  right: 0;
  text-align: center;
  top: 0;
  width: 70px;
  text-decoration: none;
}

.modal-close:hover {
  color: #000;
}

.modal-window h1 {
  font-size: 150%;
  margin: 0 0 15px;
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

<html>
<body>
<center>
<div class="accordion" id="challenges">
<?php
$sqlChallenge = "SELECT DISTINCT category FROM challenge ORDER BY category;";
$result = $link->query($sqlChallenge);
$i = 0;
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $category = $row["category"];
?>
  <div class="card">
    <div class="card-header" id="heading<?php echo "$i";?>">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo "$i";?>" aria-expanded="false" aria-controls="collapse<?php echo "$i";?>">
          <?php echo "$category";?>
        </button>
      </h2>
    </div>

    <div id="collapse<?php echo "$i";?>" class="collapse" aria-labelledby="heading<?php echo "$i";?>" data-parent="#challenges">
      <div class="card-body">
		<?php
			$chalEnum = "SELECT * FROM challenge WHERE category = '$category' ORDER BY id;";
			$enumResult = $link->query($chalEnum);
			while($enumRow = $enumResult->fetch_assoc()) {
				$name = $enumRow["name"];
				$id = $enumRow["id"];
				$points = $enumRow["points"];
				$attempts = $enumRow["attempts"];
				$hint = $enumRow["hint"];
				$description = $enumRow["description"];
				$flag = $enumRow["flag"];
				$hintCost = $enumRow["hintCost"];
				?>
<a href="#open-<?php echo "$name"; ?>"><?php echo "$name"; ?></a>
<div id="open-<?php echo "$name"; ?>" class="modal-window">
  <div>
    <a href="#<?php echo "$name"; ?>-close" title="Close" class="modal-close">close &times;</a>
    <h1><?php echo "$name"; ?></h1>
    <div>
		<?php echo "$description"; ?>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<br>Flag:<textarea name="flagInput" rows=1 cols=40></textarea><br>
		<p align=right><input type="submit"  class="btn btn-warning" value="Submit" name="submit_button"></p>
		</form>
	</div>
  </div>
</div><br>
		<?php
			}
		?>
      </div>
    </div>
  </div>
	<?php
			$i += 1;
	} }?>
</center>
<?php	
$username = $_SESSION["username"];
 $sql = "SELECT admin FROM users WHERE username = '$username'";
 $query = mysqli_query($link, $sql);
 while($rs = mysqli_fetch_assoc($query)){
    $admin = $rs['admin'];
 if ($admin == 1)
        { 
		?>

	 <a href="create.php" class="btn btn-warning">Create Challenge</a>

		<?php
	}
  }
mysqli_close($link);
?>
	
</body>
</html>
