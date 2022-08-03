
<?php
// Initialize the session
session_start();
$id = $_SESSION["id"];
$username = $_SESSION["username"];
$status = $_SESSION["status"];
$region = $_SESSION["region"];
$province = $_SESSION["province"];
$project = $_SESSION["project"];

include "../../Database/db.php";
$sql = "SELECT * FROM highlights WHERE display = 'Yes'";
$result = mysqli_query($conn, $sql) or die( mysqli_error($conn));




 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
}

	require "login_homepage/dashboard1/EventCon.php";
	require "login_homepage/dashboard1/ReadEventCon.php";
	require "login_homepage/dashboard1/EventCon2.php";
	require "login_homepage/dashboard1/ReadEventCon2.php";
	require "login_homepage/dashboard1/EventCon3.php";
	require "login_homepage/dashboard1/ReadEventCon3.php";
?>


<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Department of Information and Communication Technology</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/mobile1.css">
	<link rel="stylesheet" href="style.css">	
	<link rel="stylesheet" href="homepage1.css">
	<link rel="stylesheet" href="carousel1.css">
	<link rel="stylesheet" href="tactivities.css">
	<link rel="stylesheet" href="uactivities1.css">

	<link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
	
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<link rel="icon" href="images/titlelogo.png" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	


</head>
<body>
	<?php include '../header/header.php';?>
	<section class="header">

<style>
		.carousel{
  position: absolute;
  margin-top: 0;
  left: 50%;
  transform: translate(-50%, -50%);
}
		</style>

		
		<div class="text-box">
	<div class="carousel">
	<!--image slider start-->
    <div class="slider">
      <div class="slides">
        <!--radio buttons-->
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">

        <!--slide images-->
        <div class="slide first">
          <img src="images/lc3.png" alt="">
        </div>
        <div class="slide">
          <img src="images/mission.png" alt="">
        </div>
        <div class="slide">
          <img src="images/vision.png" alt="">
        </div>

        <!--automatic navigation-->
        <div class="navigation-auto">
          <div class="auto-btn1"></div>
          <div class="auto-btn2"></div>
          <div class="auto-btn3"></div>
        </div>

      </div>
      <!--manual navigation-->
      <div class="navigation-manual">
        <label for="radio1" class="manual-btn"></label>
        <label for="radio2" class="manual-btn"></label>
        <label for="radio3" class="manual-btn"></label>
      </div>

    </div>
    <!--image slider end-->
</div>
    <script type="text/javascript">
    var counter = 1;
    setInterval(function(){
      document.getElementById('radio' + counter).checked = true;
      counter++;
      if(counter > 3){
        counter = 1;
      }
    }, 5000);
    </script>

	</div>
		
</section>

<section class="uactivities">
	<h1>UPCOMING ACTIVITIES</h1>
	<p>things are happening or being done</p>

	<div class="row">
		<div class="activities-col">
		<form action = "login_homepage/dashboard1/ReadEvent.php" method = "get">
				<?php while($row = mysqli_fetch_array($result_event)){ ?>
					<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['Picture']); ?>" name = "setImage"/> 
					
				<h3><?php 
					$month = $row['Month'];
					$arrMonth = explode('-',$month);
					$eventMonth = $arrMonth[1];
					$eventMonthArr = array('01' => 'January', '02' => 'February','03' => 'March', '04' => 'April', 
					'05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September',
					'10' => 'October', '11' => 'November', '12' => 'December');
				?></h3>
				<input type = 'submit' name = 'submit' value = '<?php echo "$eventMonthArr[$eventMonth]" ?>'>
				<input type = 'hidden' name = 'id' value = '<?php echo "$row[ID]" ?>'>
				<input type = 'hidden' name = 'eventMonth' value = '<?php echo "$row[Month]"?>'>
				<?php }?>
				
			</form>
		</div>
		
		<div class="activities-col">
		<form action = "login_homepage/dashboard1/ReadEvent2.php" method = "get">
				<?php while($row = mysqli_fetch_array($result_event1)){ ?>
					<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['Picture']); ?>" name = "setImage"/> 
					
				<h3><?php 
					$month = $row['Month'];
					$arrMonth = explode('-',$month);
					$eventMonth = $arrMonth[1];
					$eventMonthArr = array('01' => 'January', '02' => 'February','03' => 'March', '04' => 'April', 
					'05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September',
					'10' => 'October', '11' => 'November', '12' => 'December');
				?></h3>
				<input type = 'submit' name = 'submit' value = '<?php echo "$eventMonthArr[$eventMonth]" ?>'>
				<input type = 'hidden' name = 'id' value = '<?php echo "$row[ID]" ?>'>
				<input type = 'hidden' name = 'eventMonth' value = '<?php echo "$row[Month]"?>'>
				<?php }?>
				
			</form>
		</div>
		
		<div class="activities-col">
		<form action = "login_homepage/dashboard1/ReadEvent3.php" method = "get">
				<?php while($row = mysqli_fetch_array($result_event3)){ ?>
					<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['Picture']); ?>" name = "setImage"/> 
					
				<h3><?php 
					$month = $row['Month'];
					$arrMonth = explode('-',$month);
					$eventMonth = $arrMonth[1];
					$eventMonthArr = array('01' => 'January', '02' => 'February','03' => 'March', '04' => 'April', 
					'05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September',
					'10' => 'October', '11' => 'November', '12' => 'December');
				?></h3>
				<input type = 'submit' name = 'submit' value = '<?php echo "$eventMonthArr[$eventMonth]" ?>'>
				<input type = 'hidden' name = 'id' value = '<?php echo "$row[ID]" ?>'>
				<input type = 'hidden' name = 'eventMonth' value = '<?php echo "$row[Month]"?>'>
				<?php }?>
				
			</form>
				
		</div>
		
	</div>
	

</section>


<!------highlights---->

<section class="tactivities ">
	<h1>DICT Highlights</h1>
	<p>what's in the NOW</p>

	<div class="row align-items-center mt-2 activitiesRow">
		
			<?php while($row  = mysqli_fetch_array($result)){ ?>
			<div class = "col">
				<div class="card mb-5" style = "margin: auto;">
					<div class="card-banner">
						<img class="banner-img" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['picture']); ?>" /> 
					</div>

					<div class="card-body">
						
						<h2 class="blog-title"><?php echo $row['title'] ?></h2>
						
							<p class="blog-description"><?php echo $row['description'] ?></p>
						
						
							<a href="<?php echo $row['link']; ?>" target = "_blank"><button type="button" class="btn btn-primary" style = "width: 70%; margin:auto; border-radius: 20px;">Check it Here</button></a>
						
					</div>
				</div>
			</div>

			<?php 
			}	?>
		
	</div>
	
</section>


			 <?php include 'footer.php';?>
       <style>
       <?php include 'css/footer.css';?> 
       </style>


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

<script src="js/jquery.collapser.js"></script>	
<script src="js/jquery.collapser.min.js"></script>
<script> //show more and hide more for highlights
	$('.blog-description').collapser({	//hides excess text
		mode: "words",
		truncate: 30  //text limiter
	});
</script>
	
	

</body>
</html>