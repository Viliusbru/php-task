<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage projects</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php include('templates/navbar.php'); ?> 
<?php include 'script/db.php'; ?> 
<?php
    $projects = new Dbquerys();
    $projectss = $projects->select_all("projects");


?>
<form method="POST">
    <div class="container">
        <div class="row">
            <?php foreach($projectss as $project): 
                if(isset($_POST['delete'])) {
                    $projects->delete_project($project['id']);
                }
                    ?>
                <div class="card col-sm-3 p-3 m-1" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $project['project_name'] ?></h5>
                        <p class="card-text">Number of groups: <?php echo $project['number_of_groups'] ?></p>
                        <a href="project_page.php?id=<?php echo $project['id']?>" class="btn btn-primary">Edit project</a><p></p>
                        <button type="submit" name="delete" class="btn btn-danger btn-primary">Delete button</button>
                    </div>
                </div>  
                <?php endforeach; ?>
            </div>
        </div>
    </form>