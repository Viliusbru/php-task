<?php include 'db.php';
    $delete = new Dbquerys;
if(isset($_GET['id'])) {
    $delete->delete_project($_GET['id']); 
    header('Location: ../index.php');
} else {
    header('Location: ../index.php');
}
if(isset($_GET['id'])) {
    $delete->delete_student($_GET['id']); 
    header('Location: ../index.php');
} else {
    header('Location: ../index.php');
}