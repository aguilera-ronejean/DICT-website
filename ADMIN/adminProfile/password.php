<?php
// Initialize the session
session_start();
require_once("../../Database/db.php");

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
}



// Initialize for password error display
$change_pass_err = "";

if(isset($_POST['update'])){
  $sql = "SELECT password from users WHERE id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $param_id);
  $param_id = $_SESSION['id'];
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $db_password);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);
  if(!empty($_POST["currentpassword"]) && !empty($_POST["newpassword"]) && !empty($_POST["confirmpassword"])){
    if($db_password == $_POST['currentpassword']){
      if( $_POST["newpassword"] == $_POST["confirmpassword"] ) {
        if(!($db_password == $_POST['newpassword'])){
          $sql = "UPDATE users set password=? WHERE id = ?";
          $stmt = mysqli_prepare($conn, $sql);
          mysqli_stmt_bind_param($stmt, "ss", $param_new_pass, $param_id);
          $param_new_pass = $_POST['newpassword'];
          $param_id = $_SESSION['id'];
          mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);
          mysqli_close($conn);
          header("location: mainprofile.php");
          exit;
        
        } else{
            $change_pass_err = "Same password. Please change.";
        }
          
      } else{
          $change_pass_err = "Passwords do not match.";
      }
    } else{
      $change_pass_err = "Wrong current password";
      }
  } else{
    $change_pass_err = "Please enter your password.";
  }


}

?>


<html>
<head>
  <meta name="viewport" content="with=device-width, initial-scale=1.0">
  <title>Update Password</title>

  <link rel="stylesheet" href="css/mobile1.css">
  <link rel="stylesheet" href="css/password1.css">
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
  
    <div class="profilebox1">
  <img src="images/ava.png" class="avatar">
<br>
  <h1 style="color: black;">Change Password here</h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <span style="color: red;"><?php echo $change_pass_err; ?></span>
    <p>Current Password</p>
    <input type="password" name="currentpassword" placeholder="Current Password">
    <p>New Password</p>
    <input type="password" name="newpassword" placeholder="New Password">
    <p>Confirm Password</p>
    <input type="password" name="confirmpassword" placeholder="Confirm Password">
    <input type="submit" name="update" value="Update">
    <a href="mainprofile.php"><input id="but" type="button" name="update" value="Cancel"></a>
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