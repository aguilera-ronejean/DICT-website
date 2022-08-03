<?php
require_once("../../Database/db.php");


$id = $_SESSION["id"];
$username = $_SESSION["username"];
$status = $_SESSION["status"];
$region = $_SESSION["region"];
$province = $_SESSION["province"];
$project = $_SESSION["project"];





$sql = "SELECT id, lastName, firstName, middleInitial, province, region, project, username, 
		email, gender, address, phoneNumber, picture
		FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $param_id);
$param_id = $_SESSION['id'];         
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if(mysqli_stmt_num_rows($stmt) == 1){                  
	mysqli_stmt_bind_result($stmt, $id, $lastName, $firstName, $middleInitial, $province, 
							$region, $project, $username, $email, $gender, $address, $phoneNumber, $picture);
	mysqli_stmt_fetch($stmt);
	$fullname = $firstName . " $middleInitial " . $lastName;

}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>


<html>
<head>
	<meta name="viewport" content="with=device-width, initial-scale=1.0">
	<title>Profile Page</title>
	<link rel="stylesheet" href="css/pageMain1.css">
	<link rel="icon" href="images/titlelogo.png" type="image/x-icon">
	
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet"><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>  
	
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


</head>
<body>
	<section class="header">
		
		
	<div class="text-box">
	
              
<!-- Student Profile -->
<div class="profilebox">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent text-center">
            <img class="profile_img" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($picture); ?>" alt="student dp">
            <h3><?php echo $fullname; ?></h3>
          </div>
          <div class="card-body" style="margin-top: -10px; font-weight: bold;">
            <p class="mb-0"><strong class="pr-1">User ID:</strong><?php echo $id; ?></p>
            <p class="mb-0"><strong class="pr-1">Project:</strong><?php echo $project; ?></p>
            <p class="mb-0"><strong class="pr-1">Region:</strong><?php echo $region; ?></p>
            <p class="mb-0"><strong class="pr-1">Province:</strong><?php echo $province; ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
          </div>
          <div class="card-body pt-0">
            <table class="table table-bordered">
              <tr>
                <th width="30%">User Name</th>
                <td width="2%">:</td>
                <td><?php echo $username; ?></td>
              </tr>
              <tr>
                <th width="30%">Email</th>
                <td width="2%">:</td>
                <td><?php echo $email; ?></td>
              </tr>
              <tr>
                <th width="30%">Gender</th>
                <td width="2%">:</td>
                <td><?php echo $gender; ?></td>
              </tr>
              
              <tr>
                <th width="30%">Contact No.</th>
                <td width="2%">:</td>
                <td><?php echo $phoneNumber; ?></td>
              </tr>
              <tr>
                <p><a href="update.php">Update Profile</a></p>
              </tr>
              <tr>
                <p><a href="password.php">Update Password</a></p>
              </tr>
              

            </table>
          </div>
        </div>
          <div style="height: 26px"></div>
        
      </div>
    </div>
  </div>
</div>

<form>
<div class="dropkups">
	
<div class="h50">DICT LC3 KM REPOSITORY</div><br>
	
	<div class="row">
  <div class="column" id="dami1">
    <div class="drop1">
    	<a href="https://drive.google.com/drive/folders/19ybUwp7mga0ZcyCyqg-tpdRrfxXO2S2m">
	<input class="d1" type="button" value="Admin and Finance">
			</a>
			
		</div>
		
	
	<div class="drop2">
		<a href="https://drive.google.com/drive/folders/1q8pyA7SUkrifD0kaAMzgxyyc7C9HZIcB">
		<input class="d1" type="button" value="CyberSecurity">
	</a>
	</div>
	<div class="drop3">
		<a href="https://drive.google.com/drive/folders/1x6D0wCTVqRnzc3qILCUOy2tIwLR96eJd">
		<input class="d1" type="button" value="Event Pics/Vids">
	</a>
	</div>
	<div class="drop4">
		<a href="https://drive.google.com/drive/folders/1_scmI0jq8S2kV3Y9WWJpJy2FAaJUiBdw">
		<input  class="d1" type="button" value="DJPH">
	</a>
	</div>
	<div class="drop5">
		<a href="https://drive.google.com/drive/folders/1LsOD_i8nBCND-eT3qHWhllytRBFoc31F">
		<input  class="d1" type="button" value="DRRM">
	</a>
	</div>
  </div>


  <div class="column">
    <div class="drop6">
    	<a href="https://drive.google.com/drive/folders/1QStpytmnwqqopVicg2-tryYx_tR5Bmep">
		<input  class="d1" type="button" value="eBPLS">
	</a>
	</div>
	<div class="drop7">
		<a href="https://drive.google.com/drive/folders/17Qy2JbxR6O0n4EdY-8pE_XTvAGs2sDNn">
		<input class="d1" type="button" value="Free Wi-Fi for All"></a>
	</div>
	<div class="drop8">
		<a href="https://drive.google.com/drive/folders/12PFhd3Y-vKs0-z9P3jvV8LTuNoQI_Ear">
		<input class="d1" type="button" value="GAD">
	</a>
	</div>
	<div class="drop9">
		<a href="https://drive.google.com/drive/folders/18Y4o5WXi-5izCcU8-GQIBoaZ042AChwm">
		<input class="d1" type="button" value="GOSD">
	</a>
	</div>
	<div class="drop10">
		<a href="https://drive.google.com/drive/folders/1jSiDKd_F2pXNBSX6DOFwFrDDQU48g2JB">
		<input class="d1" type="button" value="GOVNET">
	</a>
	</div>
  </div>


  <div class="column">
    <div class="drop11">
    	<a href="https://drive.google.com/drive/folders/1pJpHrVRkChMb7LG87p35v9qHxxcVzXQ2">
		<input class="d1" type="button" value="GVCS">
	</a>
	</div>
	<div class="drop12">
		<a href="https://drive.google.com/drive/folders/1cFdrqEFbMa8YtsxtvvU5pyjdvS2fvH9z">
		<input class="d1" type="button" value="IIDB">
	</a>
	</div>
	<div class="drop13">
		<a href="https://drive.google.com/drive/folders/1m0HsFCwD8aMbGz6ypupTkRhsbuiJu9J8">
		<input class="d1" type="button" value="ILCDB">
	</a>
	</div>
	<div class="drop14">
		<a href="https://drive.google.com/drive/folders/1pjVIXBriQIYJD86ZDm9wv0Lm4-7r3mSW">
		<input class="d1" type="button" value="INFORMATION DIVISION"></a>
	</div>
	<div class="drop15">
		<a href="https://drive.google.com/drive/folders/1jSYuFU7zaPZX96kV6A0TDJ3GRPJRg9lU">
		<input class="d1" type="button" value="MISS">
	</a>
	</div>
  </div>


  <div class="column" id="dami2">
    <div class="drop16">
    <a href="https://drive.google.com/drive/folders/1HOPo1WloSyVf08raDp8-t0OwlR3haXH3">
		<input class="d1" type="button" value="PNPKI">
	</a>
	</div>
	<div class="drop17">
		<a href="https://drive.google.com/drive/folders/1aAltijB2BhKBchfN3WDD4t7clvBemut3">
		<input class="d1" type="button" value="Senior Citizens and PWDs"></a>
	</div>
	<div class="drop18">
		<a href="https://drive.google.com/drive/folders/1Z6-RCC2SA_EFgyJwPLEle70rRhQY3sHd">
		<input class="d1" type="button" value="Tech4ED">
	</a>
	</div>
	<div class="drop19">
		<a href="https://drive.google.com/drive/folders/1LKvyBDbv6jZZcOAEArduG2XwNZlS8dai">
		<input class="d1" type="button" value="VIMS-IR">
	</a>
	</div>
	<div class="drop20">
		<a href="https://drive.google.com/drive/folders/1480PEOsOWj-VIhzUaDDthFjRktWUJrFS">
		<input class="d1" type="button" value="Webinar Templates"></a>
	</div>
	

  </div>



</div>


	
</div>
</form>

           
    		</div>
		</div>
    </div>
	
<!-- button sa baba -->
<div class="dropdown">
</div>


</section>

	</div>
	</section>
	<?php
		$project = strtolower($project);
	?>
	<?php if($project === "govnet"){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop7,.drop8,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			.column{
				margin-left: 44px;
			}
			
		</style>
	
	<?php }?>


	
	<?php if($project === 'cybersecurity'){?>
		<style>
			.drop1, .drop10,.drop3,.drop4,.drop5,.drop6,.drop7,.drop8,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			
		</style>
	
	<?php }?>
	<?php if($project === 'event pics/vids'){?>
		<style>
			.drop1, .drop2,.drop10,.drop4,.drop5,.drop6,.drop7,.drop8,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			
		</style>
	
	<?php }?>
	<?php if($project === 'djph'){?>
		<style>
			.drop1, .drop2,.drop3,.drop10,.drop5,.drop6,.drop7,.drop8,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			
			
		</style>
	
	<?php }?>
	<?php if($project === 'drrm'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop10,.drop6,.drop7,.drop8,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			
		</style>
	
	<?php }?>
	<?php if($project === 'ebpls'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop10,.drop7,.drop8,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			.column{
				margin-left: 3%;
			}
			
		</style>
	
	<?php }?>
	<?php if($project === 'free wi-fi for all'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop10,.drop8,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			.column{
				margin-left: 44px;
			}
			
		</style>
	
	<?php }?>
	<?php if($project === 'gad'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop7,.drop10,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			
		</style>
	
	<?php }?>
	<?php if($project === 'gosd'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop7,.drop8,.drop10,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			.column{
				margin-left: 44px;
			}
			
		</style>
	
	<?php }?>
	<?php if($project === 'gvcs'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop7,.drop8,.drop9,.drop10,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			
		</style>
	
	<?php }?>
	<?php if($project === 'iidb'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop7,.drop8,.drop9,.drop11,.drop10,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			.column{
				margin-left: -53px;
			}
		</style>
	
	<?php }?>
	<?php if($project === 'ilcdb'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop7,.drop8,.drop9,.drop11,.drop12,.drop10,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			.column{
				margin-left: -53px;
			}
			
		</style>
	
	<?php }?>
	<?php if($project === 'information division'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop7,.drop8,.drop9,.drop11,.drop12,.drop13,.drop10,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			
		</style>
	
	<?php }?>
	
	<?php if($project === 'pnpki'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop7,.drop8,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop10,.drop17,.drop18,.drop19,.drop20{
				display: none;
			}
			.column{
				margin-right: -155px;
			}
		</style>
	
	<?php }?>
	<?php if($project === 'senior citizens and pwds'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop7,.drop8,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop10,.drop18,.drop19,.drop20{
				display: none;
			}
			
		</style>
	
	<?php }?>
	<?php if($project === 'tech4ed'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop7,.drop8,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop10,.drop19,.drop20{
				display: none;
			}
			.column{
				margin-left: -115px;
			}
			
		</style>
	
	<?php }?>
	<?php if($project === 'vims-ir'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop7,.drop8,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop10,.drop20{
				display: none;
			}
			
		</style>
	
	<?php }?>
	<?php if($project === 'webinar templates'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop7,.drop8,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop10{
				display: none;
			}
			
		</style>
	
	<?php }?>
	<?php if($project === 'national broadband plan'){?>
		<style>
			.drop1, .drop2,.drop3,.drop4,.drop5,.drop6,.drop7,.drop8,.drop9,.drop11,.drop12,.drop13,.drop14,
			.drop15,.drop16,.drop17,.drop18,.drop19,.drop10,.drop20{
				display: none;
			}
			
		</style>
	
	<?php }?>


</body>





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
	

</html>