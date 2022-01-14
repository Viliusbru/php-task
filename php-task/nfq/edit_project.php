<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php include('templates/navbar.php');
include 'script/db.php'; ?>
<?php if (isset($_GET['id'])) {
    $db = new Dbquerys();
}

?>
<div class="container d-flex flex-wrap">
    <?php foreach ($db->getGroupsByProject($_GET['id']) as $g) : ?>
        <input type="hidden">
        <div class="card col-sm-3 p-3 m-1" style="width: 18rem;">
            <form action="script/add_to_group.php" method="POST">
                <input type="hidden" name="group_id" id="__VIEWSTATE" value="<?= $g['id'] ?>">
                <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Necessitatibus cumque nemo veniam blanditiis iste maxime quos qui, minima ab, quisquam nobis laboriosam a deserunt numquam vel expedita reprehenderit saepe aliquid?</p>
                </div>
                <div class="card">
                    <?php foreach ($db->getStudentsByGroup($g['id']) as $student) : ?>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?= $student['full_name']; ?>
                                <a class="btn-sm btn btn-outline-danger float-right" href="script/remove_from_group.php?id=<?php echo $db->getStudentIdByName($student['full_name'])['id'] ?>">Remove</a>
                            </li>
                        </ul>
                    <?php endforeach; ?>
                    <?php if ($g['student_number'] <= count($db->getStudentsByGroup($g['id']))) : ?>
                    <?php else : ?>
                        <select name="student_id">
                            <?php foreach ($db->getAllFromTable('students') as $s) : ?>
                                <?php if ($s['group_id'] == NULL) : ?>
                                    <option value="<?= $s['id'] ?>"><?= $s['full_name'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <button id="btn" class="btn btn-sm btn-succes float-right">Add to group</button>
            </form>
        <?php endif; ?>
        </div>
</div>
<?php endforeach; ?>
</div>
