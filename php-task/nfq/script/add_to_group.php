<?php include 'db.php';
$delete = new Dbquerys;
$delete->updateAddStudentToGroup($_POST['student_id'], $_POST['group_id']);
header('Location: ../index.php');
