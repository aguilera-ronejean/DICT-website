<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
}

include "../../Database/db.php";
include "../header/header.php";
include "highlightsOp.php";



if (isset($_GET['edit'])) {     // puts selected row into textbox for it to be editted/deleted
    $id = $_GET['edit'];
    $edit_state = true;
    
    $sql = "SELECT * FROM highlights WHERE id = '$id'";
    $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    
    $id = $row['id'];
    $title = $row['title'];
    $description = $row['description'];
    $date = $row['date'];
    $picture = $row['picture'];
    $link = $row['link'];
    $display = $row['display'];
    
}

if(isset($_POST['btn-search'])){    //serach buttons function
    $search = $_POST['search'];

    
    if($search != ''){

            $sql2 = "SELECT * FROM highlights WHERE id LIKE '%$search%' OR title LIKE '%$search%' OR description LIKE '%$search%' OR date LIKE '%$search%' OR link LIKE '%$search%' OR display LIKE '%$search%'";
            $result2 = mysqli_query($GLOBALS['conn'], $sql2);

            if(mysqli_num_rows($result2) == 0){

                ?> 
                <script> 
                    alert("No Data Found!")
                </script>              
                <?php

                $sql2 = "SELECT * FROM highlights";
                $search = "";
            }
    
    }
    else{
        $sql2 = "SELECT * FROM highlights";
        $search = "";
    }
}
else{
    
    $sql2 = 'SELECT * FROM highlights';
    $search = "";
}
?>

<html>
    <head>
    <link rel="stylesheet" href="highlights1.css" type="text/css">
    <title>Highlights</title>
    </head>
    <body>
        <main>

            <section>
                <div class="container">
                    <form method="post" action="highlightsOp.php" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <label for="id" class="form-label">Highlight ID</label>
                                        <input type="text" id = "id" name = "id" class="form-control" placeholder = "Auto Generated ID" value="<?php echo $id; ?>" readonly >
                                    </div>
                                    <div class="col">
                                        <label for="title" class="form-label">Highlight Title</label>
                                        <input type="text" id = "title" name = "title" class="form-control" value="<?php echo $title; ?>" required >
                                    </div>
       
                                </div> 
                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="description" class="form-label">Highlights Description</label>
                                        <textarea class="form-control" id="description" name = "description" rows="5" required><?php echo $description; ?></textarea>
                                    </div>
                                </div>
                                

                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="date" class="form-label">Start Date</label>
                                        <input type="date" id = "date" name = "date" class="form-control" value="<?php echo $date; ?>" required >
                                    </div>
                                    <div class="col">
                                        <label for="display" class="form-label">To Display</label>
                                            <select class="form-select"name ="display" id="display" required>
                                                <option selected><?php echo $display; ?></option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                    </div> 
                                </div> 
                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="picture" class="form-label">Upload Highlight Picture</label>
                                        <input class="form-control" type="file" id="picture" name = "picture" value="<?php echo base64_encode($picture) ; ?>">
                                    </div>
                                </div>

                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="link" class="form-label">DICT Post Link</label>
                                        <input type="text" id = "link" name = "link" class="form-control" value="<?php echo $link; ?>">
                                    </div>
                                    
                                    
                                </div> 

                                <div class="row align-items-center mt-2 mb-2">
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
            <form action = "highlights.php" method = "post" class = "form-control searchBox" >
                <input type = "text" autocomplete="on" placeholder="Search Values Here" class = "form-control mt-3" name = "search" id = "search" style = "width:80%; margin: auto;" value = "<?php echo $search; ?>">
                <br>
                <center><button width="200" name = "btn-search" dat-toggle='tooltip' data-placement = 'bottom' title = 'Search' class = "btns btn-success" id = "btn-search" hidden>   <i class="fas fa-search light"> Search</i></button>   </center>
            </form>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Displayed</th> 
                                        <th>Highlight Cover Picture</th> 
                                        <th>Title</th>     
                                        <th>Description</th>     
                                        <th>Date</th> 
                                        <th>Link</th>                         
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php   
                                    
                                        $result  = mysqli_query($conn , $sql2) or die( mysqli_error($conn));;    //$sql2 used from search SQL so it can search    
                                        while($row  = mysqli_fetch_array($result)){ ?>
                                            
                                            <tr id="<?php echo $row['id']; ?>"> 
                                                <td style="text-align:center" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['id']; ?>   </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['display']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    
                                                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['picture']); ?>" style = "width:150px;height:90px;" /> 
                                                </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['title']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['description']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['date']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['link']; ?>     </td>
                                                
                                                <td style="text-align:center"><a href="highlights.php?edit=<?php echo $row["id"]; ?>" class="edit_btn"><i class="fas fa-edit fa-lg"></i></a>
                                                    
                                                </td>
                                                
                                            </tr>
                                        <?php 
                                        }
                                        ?>    
                                </tbody>
                            </table>
        </div>



    </body>

    

    <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>

                <?php include '../header/footer.html';?>
            <style>
                <?php include '../header/footer.css';?> 
            </style>

</html>