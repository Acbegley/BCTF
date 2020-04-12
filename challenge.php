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

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
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
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $category = $row["category"];
?>
  <div class="card">
    <div class="card-header" id="heading<?php echo "$category";?>">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo "$category";?>" aria-expanded="false" aria-controls="collapse<?php echo "$category";?>">
          <?php echo "$category";?>
        </button>
      </h2>
    </div>

    <div id="collapse<?php echo "$category";?>" class="collapse" aria-labelledby="heading<?php echo "$category";?>" data-parent="#challenges">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
	<?php } }?>
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
		<!-- Trigger/Open The Modal -->

<div class="form-group">
     <button id="myBtn" class="btn btn-warning">Create Challenge</button>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			Name<br><textarea name="name" rows=1 cols=50 placeholder="Challenge name"></textarea><br>
			Category<br><textarea name="category" rows=1 cols=50 placeholder="Cryptography (No spaces here)"></textarea><br>
			Description<br><textarea name="description" rows=4 cols=50 placeholder="Description"></textarea><br>
			Flag<br><textarea name="flag" rows=1 cols=50 placeholder="flag{VpGUEszSoOPLg8alGWnnzAnrbj60gcAC}"></textarea><br>
			Hint<br><textarea name="hint" rows=4 cols=50 placeholder="Hints"></textarea><br>
			Hint Cost<br><input type="text" name="cost" placeholder="50"><br>
			Points<br><input type="text" name="points" placeholder="123"><br>
			Attempts<br><input type="text" name="attempts" placeholder="3"><br>
			<input type="submit"  class="btn btn-warning" value="Submit" name="submit_button"></h1>
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
	$sql = "INSERT INTO challenge (name, category, description, flag, points, attempts, hint ) VALUES ('$name', '$category', '$description', '$flag', '$points', '$attempts', '$hint')";
	if ($link->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}
}
?>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
		<?php
	}
  }
mysqli_close($link);
?>
	
</body>
</html>
