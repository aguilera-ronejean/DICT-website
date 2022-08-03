<?php
	require "public homepage/dashboard/EventCon.php";
	require "public homepage/dashboard/ReadEventCon.php";
	require "public homepage/dashboard/EventCon2.php";
	require "public homepage/dashboard/ReadEventCon2.php";
	require "public homepage/dashboard/EventCon3.php";
	require "public homepage/dashboard/ReadEventCon3.php";

	$sql = "SELECT * FROM highlights WHERE display = 'Yes'";
	$result = mysqli_query($conn, $sql) or die( mysqli_error($conn));

?>


<html>
<head>
	<meta name="viewport" content="with=device-width, initial-scale=1.0">
	<title>Department of Information and Communication Technology</title>
	<link rel="stylesheet" href="public homepage/css/publicHeader.css">
	<link rel="stylesheet" href="public homepage/css/mobile1.css">
	<link rel="stylesheet" href="public homepage/css/carousel.css">
	<link rel="stylesheet" href="public homepage/css/footer1.css">
	<link rel="stylesheet" href="public homepage/css/highlights.css">
	<link rel="stylesheet" href="public homepage/css/uactivities2.css">
	<link rel="stylesheet" href="index.css">

	<link rel="icon" href="../public homepage/images/titlelogo.png" type="image/x-icon">
	
	
	
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel="icon" href="../header/titlelogo.png" type="image/x-icon">


</head>
<body>
	<section class="header">
		<nav>
			<a href="#"><img src="public homepage/images/DICT.png"></a>
			
			<div class="nav-links" id="navLinks">
			
			<i class="fa fa-bars" onclick="hideMenu()">
			
			</i>
	
				<ul>
					<li><a href="login/login.php">LOGIN</a></li>
					
				</ul>
			
			</div>
			<i class="fa fa-bars" style="margin-top: -40px;" onclick="showMenu()"></i>
			
		</nav>
		
	<div class="text-box">
	<div class="carousel" align="center">

	<!--image slider start-->
    <div class="slider">
      <div class="slides">
        <!--radio buttons-->
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">

        <!--slide images-->
        <div class="slide first">
          <img src="public homepage/images/lc3.png" alt="">
        </div>
        <div class="slide">
          <img src="public homepage/images/mission.png" alt="">
        </div>
        <div class="slide">
          <img src="public homepage/images/vision.png" alt="">
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
	



<!------UpcomingActivites---->

<section class="uactivities ">
	<h1>UPCOMING ACTIVITIES</h1>
	<p>things are happening or being done</p>

	<div class="row">
		<div class="activities-col">
		<form action = "public homepage/dashboard/ReadEvent.php" method = "get">
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
		<form action = "public homepage/dashboard/ReadEvent2.php" method = "get">
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
		<form action = "public homepage/dashboard/ReadEvent3.php" method = "get">
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

<section class="tactivities ">
	<h1>DICT Highlights</h1>
	<p>what's in the NOW</p>

	<div class="row align-items-center mt-2">
		
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
	

</section>




			 <footer>
		<div class="container">
			<img src="public homepage/govph-seal-mono-footer.png" alt ="govph-seal-mono" class = "img1"/>
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

<script src="ADMIN/home/js/jquery.collapser.js"></script>	
<script src="ADMIN/home/js/jquery.collapser.min.js"></script>
<script> //show more and hide more for highlights
	$('.blog-description').collapser({	//hides excess text
		mode: "words",
		truncate: 30  //text limiter
	});
</script>
	

</body>
</html>