<?php

include "../../Database/db.php";

?>


<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel="icon" href="../header/titlelogo.png" type="image/x-icon">
    
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="display: none;" id ="nav" >
        <div class="container-fluid">
            <a class="navbar-brand" href="../dashboard/dashboard.php"><b>DICT Admin Panel</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="../dashboard/dashboard.php" href="#"><b>Home</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../region/region.php"><b>Region/Province</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../users/users.php"><b>Users</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../project/project.php"><b>Project</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../accomplishment/accomplishment.php"><b>Training Accomplishments</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../accomplishmentGeneral/accomplishmentGeneral.php"><b>General Accomplishments</b></a>
                    </li>
                    
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    
  </body>

</html>