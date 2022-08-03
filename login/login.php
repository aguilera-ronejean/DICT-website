<?php
//source code: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
//source code (cookies):https://makitweb.com/login-page-with-remember-me-in-php/
// Initialize the session
session_start();

// Include config file
require_once "../Database/db.php";

// Encrypt cookie function
function encryptCookie( $value ) {
    $key = hex2bin(openssl_random_pseudo_bytes(4));
  
    $cipher = "aes-256-cbc";
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
  
    $ciphertext = openssl_encrypt($value, $cipher, $key, 0, $iv);
  
    return( base64_encode($ciphertext . '::' . $iv. '::' .$key) );
}
  
// Decrypt cookie function
function decryptCookie( $ciphertext ) {
    $cipher = "aes-256-cbc";
  
    list($encrypted_data, $iv, $key) = explode('::', base64_decode($ciphertext));
    return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
  
}

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../dashboard/homepage/home.php");
    exit;
}
// If not then check cookies
else if( isset($_COOKIE['rememberme'] )){
    // Decrypt cookie variable value
    $id = decryptCookie($_COOKIE['rememberme']);

    $sql = "SELECT id, username, status, province, region, project FROM users WHERE id = ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_id);
            
        $param_id = $id;            

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $id, $username, $status, $province, $region, $project);
                    
                if(mysqli_stmt_fetch($stmt)){
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;
                    $_SESSION["status"] = $status;
                    $_SESSION["province"] = $province;
                    $_SESSION["region"] = $region;
                    $_SESSION["project"] = $project;
                    
                    
                    header('Location: ../dashboard/homepage/home.php');

                    mysqli_stmt_close($stmt);// stmt should be closed not, the sql connection
                    mysqli_close($conn);
                    exit;
                }
            }
        }
    }
}

 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
  
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        
        // Prepare a select statement
        $sql = "SELECT id, username, password, status, province, region, project FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
        
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;            

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                //Check if both(username and password) exist
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $status, $province, $region, $project);
                    
                    if(mysqli_stmt_fetch($stmt)){
                        
                        //if(password_verify($password, $hashed_password)){
                        //modified, might change back later
                        //$hashed_password is still not hashed
                        if($password == $hashed_password){

                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["status"] = $status;
                            $_SESSION["province"] = $province;
                            $_SESSION["region"] = $region;
                            $_SESSION["project"] = $project;                            
                            
                            // If remember me is checked, set cookies
                            if( isset($_POST['rememberme']) ){
                                // Set cookie variables
                                // Number of days cookies should last before it expires
                                $days = 30;
                                $value = encryptCookie($id);
                                setcookie ("rememberme", $value, time()+ ($days * 24 * 60 * 60));
                            }

                            // Check if first time login
                            if($status == -1){
                                //first time login
                                header("location: first_time_login.php");
                            } else{
                                // Redirect user to welcome page
                                $project = $_SESSION["project"];
                                if($project == 'MISS'){
                                    header('Location: ../ADMIN/home/homepage.php');
                                }
                                else{
                                    header('Location: ../dashboard/homepage/home.php');
                                }
                                
                            }
                        
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DICT</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="loginFooter.css">
    <link rel="stylesheet" href="loginHeader.css">
    <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
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

        <div class="form-container">
            <h1>Login</h1>
            <!--form action="../navigation/index.html"-->
            <?php
            if(!empty($login_err)){
                echo '<div class="control">' . $login_err . '</div>'; }      
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="control">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                    <!-- <p>Username<input type="text" name="username" id="name" required></p> -->
                </div>
                <div class="control">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <span><input type="checkbox" name="rememberme"> Remember me.</span>
                <div class="control">
                    
                    <input type="submit" value="Login" >
                    
                </div>
            </form>
           
        </div>



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