<?php
    include 'script/db.php';
    include 'script/test.php';
    // $conn = mysqli_connect('localhost', 'admin', 'admin', 'nfq_task');

    // if(!$conn){
    //     echo 'Connection error: ' . mysqli_connect_error();
    // }

    // $sql = 'SELECT * FROM students'
?>
<!DOCTYPE html>
<html lang="en">

    <!-- navbar -->
    <?php include('templates/navbar.php'); ?> 
    <?php include('templates/head.php'); ?> 
    <?php 
        $testObj = new Test();
        $testObj->getStudents();
    ?>


</html>