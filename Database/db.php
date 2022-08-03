<?php 
    $conn = mysqli_connect('localhost', 'root', '', 'dict');
    
    if(!$conn)
    {
    die("Connection failed: " . mysqli_connect_error());
    }

?>