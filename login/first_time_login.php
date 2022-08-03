<?php

require_once("../Database/db.php");
session_start();


$change_pass_err='';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['status'] == -1){
    if(isset($_POST['changepassword'])){
        if(!empty(trim($_POST["newpassword"])) && !empty(trim($_POST["confirmpassword"]))){
            if( $_POST["newpassword"] == $_POST["confirmpassword"] ) {
                $password = $_POST['newpassword'];
                $sql = "SELECT password from users WHERE id = ?";
                
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $param_id);
                $param_id = $_SESSION['id'];
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $prev_password);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);
    
                if(!($prev_password == $password)){
                    $sql = "UPDATE users set password=?, status=? WHERE id = ?";
                
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "sis", $param_new_pass, $param_status, $param_id);
                    
                    $param_new_pass = $_POST["newpassword"];
                    $param_status = 1;
                    $param_id = $_SESSION['id'];
    
                    mysqli_stmt_execute($stmt);
                    $_SESSION['status'] =  1;
    
                    $project = $_SESSION["project"];
                    if($project == 'MISS'){
                        header('Location: ../ADMIN/home/homepage.php');
                    }
                    else{
                        header('Location: ../dashboard/homepage/home.php');
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    exit;
                
                } else{
                    $change_pass_err = "Same password. Please change.";
                }
                 
            } else{
                $change_pass_err = "Password do not match.";
              }
        } else{
            $change_pass_err = "Please enter your password.";
        }
    
    }
    
} else{
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="first_time_login1.css">
    <link rel="stylesheet" href="loginHeader.css">
    <link rel="stylesheet" href="firstFooter1.css">
</head>

<body>
<div class="header">
      <div class="container">
            <div class="logo-toggle-container">
                <a href="#">
                    <img src="../images/DICT-Banner-Logo-for-dark-background300px.png" alt=""/>
                </a>       
            </div>
        
        <h2><i>“DICT of the people and for the people.”</i></h2>
    </div>
</div>

<section>
<form method="post" action="" align="center">
<h3>CHANGE PASSWORD</h3>
<br>
<span>
<?php if(!empty($change_pass_err)){
    echo $change_pass_err; }      
?>
</span>
<br>
New Password:
<input type="password" name="newpassword">
<br>
Confirm Password:
<input type="password" name="confirmpassword">
<br><br>
<input type="submit" name="changepassword" value="Change Password">
</form>
<br>
<br>
</section>


<footer>
        <div class="container">
            <img src="../images/govph-seal-mono-footer.png" alt ="govph-seal-mono" class = "img1"/>

            <div class="ftr">
                <h3>REPUBLIC OF THE PHILIPPINES</h3>
                <ul class="content">
                    <p1> All content is in the public domain unless otherwise stated. </p1>
                </ul>
            </div>
            <div class="ftr">
                <h3>ABOUT GOVPH</h3>
                <ul class="content">
                    <p1> Learn more about the Philippine government, its structure, how government works and the people behind it. </p1>

                    <li><a href="http://www.gov.ph/">GOV.PH</a></li>
                    <li><a href="http://www.gov.ph/data">Open Data Portal</a></li>
                    <li><a href="http://www.officialgazette.gov.ph">Official Gazette</a></li>
                </ul>
            </div>
            <div class="ftr">
                <h3>GOVERNMENT LINKS</h3>
                <ul class="content">
                    <li><a href="http://president.gov.ph/">Office of the President</a></li>
                    <li><a href="http://ovp.gov.ph/">Office of the Vice President</a></li>
                    <li><a href="http://www.senate.gov.ph/">Senate of the Philippines</a></li>
                    <li><a href="http://www.congress.gov.ph/">House of Representatives</a></li>
                    <li><a href="http://sc.judiciary.gov.ph/">Supreme Court</a></li>
                    <li><a href="http://ca.judiciary.gov.ph/">Court of Appeals</a></li>
                    <li><a href="http://sb.judiciary.gov.ph/">Sandiganbayan</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>