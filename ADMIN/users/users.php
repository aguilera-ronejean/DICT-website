<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
}
?>

<?php

include "../../Database/db.php";
include "../header/header.php";
include "usersOp.php";

if (isset($_GET['edit'])) {     // puts selected row into textbox for it to be editted/deleted
    $id = $_GET['edit'];
    $edit_state = true;
    
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    
    $id = $row['id'];
    $lastName = $row['lastName'];
    $firstName = $row['firstName'];
    $email = $row['email'];
    $phoneNumber = $row['phoneNumber'];
    $gender = $row['gender'];
    $username = $row['username'];
    $password = $row['password'];
    $project = $row['project'];
    $region = $row['region'];
    $province = $row['province'];
    $birthday = $row['birthday'];
    
}

$datatable = "users";
$results_per_page = 10;

$sql = "SELECT COUNT(id) AS total FROM ".$datatable; 
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page);


if(isset($_POST['btn-search'])){    //serach buttons function
    $search = $_POST['search'];

    
    if($search != ''){

            $sql2 = "SELECT * FROM users WHERE id LIKE '%$search%' OR lastName LIKE '%$search%' OR firstName LIKE '%$search%' OR email LIKE '%$search%' OR gender LIKE '%$search%'
                    OR username LIKE '%$search%' OR project LIKE '%$search%' OR region LIKE '%$search%' OR birthday LIKE '%$search%' OR province LIKE '%$search%'";
            $result2 = mysqli_query($GLOBALS['conn'], $sql2);

            if(mysqli_num_rows($result2) == 0){

                ?> 
                <script> 
                    alert("No Data Found!")
                </script>              
                <?php

                if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                $start_from = ($page-1) * $results_per_page;
                $sql2 = "SELECT * FROM ".$datatable." ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;

                $search = "";
            }
    
    }
    else{
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                $start_from = ($page-1) * $results_per_page;
                $sql2 = "SELECT * FROM ".$datatable." ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;
        $search = "";
    }
}
else{
    
    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                $start_from = ($page-1) * $results_per_page;
                $sql2 = "SELECT * FROM ".$datatable." ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;
    $search = "";
}
?>

<html>
    <head>
    <link rel="stylesheet" href="users1.css" type="text/css">
    <title>Users</title>
    </head>
    <body>
        <main>

            <section>
                <div class="container">
                    <form method="post" action="usersOp.php" enctype="multipart/form-data"> 
                
                
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-8 col-xl-6">

                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <label for="id" class="form-label">User ID</label>
                                        <input type="text" id = "id" name = "id" class="form-control" placeholder = "Auto Generated ID" value="<?php echo $id; ?>" readonly >
                                    </div>
                                    <div class="col">
                                        <label for="gender" class="form-label">Select Gender</label>
                                            <select class="form-select"name ="gender" id="gender" required>
                                                <option selected><?php echo $gender; ?></option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                    </div>
                                </div>
                                
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <label for="lastName" class="form-label">Enter Last Name</label>
                                        <input type="text" id = "lastName" name = "lastName" class="form-control" value="<?php echo $lastName; ?>" required>
                                    </div>
                                    <div class="col">
                                        <label for="firstName" class="form-label">Enter First Name</label>
                                        <input type="text" id = "firstName" name = "firstName" class="form-control" value="<?php echo $firstName; ?>" required>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-2">
                                    
                                    <div class="col">
                                        <label for="email" class="form-label">Enter Email</label>
                                        <input type="email" id = "email" name = "email" class="form-control" value="<?php echo $email; ?>" required>
                                    </div>
                                    <div class="col">
                                        <label for="phoneNumber" class="form-label">Enter Phone Number</label>
                                        <input type="number"  id = "phoneNumber" name = "phoneNumber" class="form-control" value="<?php echo $phoneNumber; ?>" required>
                                    </div>
                                    
                                </div>
                                <div class="row align-items-center mt-2">         
                                    <div class="col">
                                        <label for="username" class="form-label">Enter Username</label>
                                        <input type="text" id = "username" name = "username" class="form-control" value="<?php echo $username; ?>" required>
                                    </div>
                                    <div class="col">
                                        <label for="password" class="form-label">Enter Password</label>
                                        <input type="password" id="password" name = "password" class="form-control" aria-describedby="passwordHelpBlock" value="<?php echo $password; ?>" required >
                                    </div>
                                </div>
                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                    <label for="project" class="form-label">Select Project</label>
                                            <?php
                                                echo '<select id = "project" name = "project" class = "form-control" required>
                                                <option selected>'.$project.'</option>
                                                ';
                                                
                                                $sql = "SELECT project FROM project";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result)) 
                                                {
                                                    echo '<option>'.$row['project'].'</option>';
                                                }    
                                                echo '</select>';
                                            ?>
                                    </div>
                                    <div class="col">
                                    <label for="region" class="form-label">Select Region</label>
                                            <?php /*
                                                echo '<select id = "region" name = "region" class = "form-control action" required>
                                                <option selected>'.$region.'</option>
                                                ';
                                                
                                                $sql = "SELECT DISTINCT region FROM region";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result)) 
                                                {
                                                    echo '<option value = "'.$row['region'].'">'.$row['region'].'</option>';
                                                    
                                                    
                                                }    
                                                echo '</select>';  */

                                                $query = "SELECT DISTINCT region FROM region GROUP BY region ORDER BY region ASC";
                                                $result = mysqli_query($conn, $query);
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    $region .= '<option value="'.$row["region"].'">'.$row["region"].'</option>';
                                                }
                                            ?> 
                                            <select name="region" id="region" class="form-control action">
                                                <option><?php echo $region ?></option>
                                                
                                            </select>
                                    </div>
                                    <div class="col">
                                    <label for="province" class="form-label">Select Province</label>
                                            <?php /*
                                                echo '<select id = "province" name = "province" class = "form-control" required>
                                                <option selected>'.$province.'</option>
                                                ';
                                                

                                                    $sql = "SELECT province FROM region";
                                                    $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result)) 
                                                        {
                                                            echo '<option>'.$row['province'].'</option>';
                                                        }
                                                
                                                    echo '</select>';   */
                                            ?>
                                            <select name="province" id="province" class="form-control action">
                                                <option><?php echo $province ?></option>
                                            </select>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="birthday" class="form-label">Select Birthday</label>
                                        <input type="date" class="form-control" name = "birthday" id ="birthday" placeholder="Enter Birhtday" value="<?php echo $birthday; ?>" required>
                                    </div>
                                    <div class="col">
                                        <label for="picture" class="form-label">Upload Picture</label>
                                        <input class="form-control" type="file" id="picture" name = "picture" value="<?php echo base64_encode($picture) ; ?>" required>
                                    </div>

                                </div>
                                <div class="row align-items-center mt-2">
                                    <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                            <button dat-toggle='tooltip' class="btn btn-primary" name = "create" id = "btn-create">Add</button>
                                            <button dat-toggle='tooltip' class="btn btn-warning"name = "update" id = "btn-update">Update</button>
                                            <button dat-toggle='tooltip' class="btn btn-danger"name = "delete" id = "btn-delete" onclick="return confirm('Are you sure to delete?')">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </main>

        <div class="panel-body mt-5" style="overflow-x:auto;">
            
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Picture</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Gender</th>
                                        <th>username</th>
                                        <th>password</th>
                                        <th>Project</th>
                                        <th>Region</th>
                                        <th>Province</th>
                                        <th>Birthday</th>
                                        
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php   
                                    
                                        $result  = mysqli_query($conn , $sql2) or die( mysqli_error($conn));;    //$sql2 used from search SQL so it can search    
                                        while($row  = mysqli_fetch_array($result)){ ?>
                                            
                                            <tr id="<?php echo $row['id']; ?>"> 
                                                <td style="text-align:center" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['id']; ?>   </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    
                                                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['picture']); ?>" style = "width:75px;height:75px;" /> 
                                                </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['firstName']; echo " "; echo $row['lastName']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['email']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['phoneNumber']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['gender']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['username']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['password']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['project']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['region']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['province']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['birthday']; ?>     </td>
                                                
                                                <td style="text-align:center"><a href="users.php?edit=<?php echo $row["id"]; ?>" class="edit_btn"><i class="fas fa-edit fa-lg"></i></a>
                                                    
                                                </td>
                                                
                                            </tr>
                                        <?php 
                                        }
                                        ?>    
                                </tbody>
                                <form action = "users.php" method = "post" class = "form-control searchBox" >
                                    <input type = "text" autocomplete="on" placeholder="Search Values Here" class = "form-control mt-3" name = "search" id = "search" style = "width:80%; margin: auto; overflow-x:auto;" value = "<?php echo $search; ?>">
                                    <br>
                                    <center><button width="200" name = "btn-search" dat-toggle='tooltip' data-placement = 'bottom' title = 'Search' class = "btns btn-success" id = "btn-search" hidden>  <i class="fas fa-search light"> Search</i></button>   </center>
                                </form>

                                <center>
                                    <?php
                                        for ($i=1; $i<=$total_pages; $i++) {                                  
                                            echo '<a class="btn btn-warning" href="users.php?page='.$i.'">'.$i.'</a>'; 
                                        }; 
                                    ?>                      
                                </center> <br>
                            </table>
        </div>



    </body>

    

    <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(picture);
    });
    </script>

<script>
    $(document).ready(function(){
    $('.action').change(function(){
    if($(this).val() != '')
    {
    var action = $(this).attr("id");
    var query = $(this).val();
    var result = '';
    if(action == "region")
    {
        result = 'province';
    }
    
    $.ajax({
        url:"fetchdata.php",
        method:"POST",
        data:{action:action, query:query},
        success:function(data){
        $('#'+result).html(data);
        }
    })
    }
    });
    });
</script>

                <?php include '../header/footer.html';?>
            <style>
                <?php include '../header/footer.css';?> 
            </style>

</html>