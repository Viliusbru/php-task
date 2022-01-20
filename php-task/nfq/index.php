<?php
    include 'script/db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nfq index</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

    <!-- navbar -->
    <?php include('templates/navbar.php'); ?> 
    <div style="width:20%;padding:10px;margin:10px;" class="container justify-content-center">
        
        <?php 
        $students = new Dbquerys();
        $group = $students->getGroupForStudent();
        foreach($group as $student): ?>
        <div class="card d-flex flex-column gap-3">
            <div class="card-body d-flex flex-column gap-1">
                <?php echo $student['full_name']; $group;?>
                <?php if (!empty($student['project_name'])): ?>
                <a class="bold">Project: <b><?=$student['project_name']?></b></a>
                <?php else: ?>
                    <a>Project: </a>
                    <br>
                <?php endif; ?>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="script/delete_project.php?id=<?php echo $student['id']?>" class="btn-sm btn btn-outline-danger">Delete student</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</html>
