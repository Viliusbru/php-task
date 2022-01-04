<?php

    $conn = mysqli_connect('localhost', 'admin', 'admin', 'nfq_task');

    if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }

?>
<!DOCTYPE html>
<html lang="en">

    <!-- navbar -->
    <?php include('templates/navbar.php'); ?> 
    <?php include('templates/head.php'); ?> 


</html>