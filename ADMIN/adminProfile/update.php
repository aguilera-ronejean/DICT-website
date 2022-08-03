<?php
// Initialize the session
require_once("../../Database/db.php");
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
}

// Fetch
$sql = "SELECT username, email, address, phoneNumber
		FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $param_id);
$param_id = $_SESSION['id'];         
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if(mysqli_stmt_num_rows($stmt) == 1){                  
	mysqli_stmt_bind_result($stmt, $username, $email, $address, $phoneNumber);
	mysqli_stmt_fetch($stmt);
}
mysqli_stmt_close($stmt);

// Update
if(isset($_POST['update'])){
	$sql = "UPDATE users
			SET username=?, email=?, address=?, phoneNumber=?
			WHERE id = ?";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "ssssd", $param_username, $param_email, $param_address, $param_phoneNumber, $param_id);
	$param_username =  $_POST['username'];
	$param_email =  $_POST['email'];
	$param_address =  $_POST['address'];
	$param_phoneNumber =  $_POST['phoneNumber'];
	$param_id = $_SESSION['id'];

	if(mysqli_stmt_execute($stmt)){
		header("location: mainprofile.php");
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
		exit;
	}
	
mysqli_close($conn);
}
?>


<html>
<head>
	<meta name="viewport" content="with=device-width, initial-scale=1.0">
	<title>Update Profile</title>
	<link rel="stylesheet" href="css/mobile1.css">
	<link rel="stylesheet" href="css/profile1.css">
	<link rel="stylesheet" href="css/header.css">


	<link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
	
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet"><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>  
	
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


</head>
<body style="font-family: sans-serif;">

	<?php include '../header/header.php';?>
	
	<section class="header">
		
	<div class="text-box">
	
<!--header end-->
	
<div class="profilebox">
  <img src="images/ava.png" class="avatar">
<br>
  <h1 style="color: black;">Update Profile Here</h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <p>Username</p>
    <input type="text" name="username" placeholder="Enter New Username" value=<?php echo "$username"; ?>>
    <p>Email</p>
    <input type="text" name="email" placeholder="Enter New Email" value=<?php echo "$email"; ?>>
    <p>Contact Number</p>
    <input type="text" name="phoneNumber" placeholder="Enter Contact Number" value=<?php echo "$phoneNumber"; ?>>
    <input type="submit" name="update" value="Update">
    <a href="mainprofile.php"><input id="but" type="button" name="" value="Cancel"></a>
  </form>
</div>



	</div>
	</section>
	


	<footer>
            <?php include 'css/footer.html';?>
        <style>
            <?php include 'css/footer.css';?> 
        </style>
  	</footer>



<!-----Javascript------>
<script>
	var navLinks = document.getElementById("navLinks");
	function showMenu(){
		navLinks.style.right= "0";
	}
	function hideMenu(){
	navLinks.style.right= "-200px";
	
	}
</script>	
	
</body>
</html>