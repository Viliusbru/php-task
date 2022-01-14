<?php include 'db.php';
    $delete = new Dbquerys;
if(isset($_GET['id'])) {
    $delete->deleteStudent($_GET['id']); 
    header('Location: ../index.php');
} else {
    header('Location: ../index.php');
}
