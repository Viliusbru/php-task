<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create project</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php include('templates/navbar.php'); ?> 
<?php include 'script/db.php'; ?> 
<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['project-title'];
        $group_number = $_POST['group-number'];
        $students = $_POST['student-number'];

        $submit = new Dbquerys();
        $submit->create_project($name, $group_number, $students);
        for($i = 0; $i <= $group_number; $i++) {
            $submit->create_group($name, $students);
        }
        header('Location: index.php');
    }
?>
<form style="width:20%;padding:10px;margin:10px;" class="border rounded" method="POST">
<div class="form-group">
    <label for="formGroupExampleInput">Project name</label><br>
    <input name="project-title" type="text" class="form-control" id="formGroupExampleInput" placeholder="Project name">
</div>
<div class="form-group">
    <label for="formGroupExampleInput">Number of groups</label><br>
    <input name="group-number" class="form-control" type="number" id="replyNumber" min="0" step="1" data-bind="value:replyNumber" placeholder="Groups">
</div>
<div class="form-group">
    <label for="formGroupExampleInput">Number of students per group</label><br>
    <input name="student-number" class="form-control" type="number" id="replyNumber" min="0" step="1" data-bind="value:replyNumber" placeholder="Student count">
</div>
<button class="btn-sm btn-primary" type="submit">Submit</button>
</form>