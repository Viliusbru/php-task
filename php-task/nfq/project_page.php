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
<?php include('templates/navbar.php'); ?>
<?php include 'script/db.php'; ?>
<?php if (isset($_GET['id'])) {

  $project = new Dbquerys();
  $project_data = $project->get_project_data_from_id($_GET['id']);
  $left_join = $project->get_groups_left_join_students($_GET['id']);

  $group_data = $project->get_group_data($_GET['id']);
  foreach ($group_data as $group) {
    $groups[] = $group;
  }
  $students = $project->select_all('students');
  foreach ($students as $student) {
    if ($student['group_fk'] == NULL) {
      $student_list[] = $student;
    }
  }
  foreach ($left_join as $row){
    if ($row['group_fk'] != NULL){
      $asigned_students[] = $row;
    }
  }
  echo "<pre>";
  print_r($left_join);
  echo "</pre>";
  echo "<pre>";
  print_r($asigned_students);
  echo "</pre>";
}

?>
<div class="d-flex justify-content-center">
  <div class="card" style="width: 18rem;">
    <div class="card-body card-header text-center">
      <form class="card students">
        <div class="card-header text-center">
          <h3>Groups</h3>
        </div>
        <div class="card-body d-flex flex-column gap-3">
          <?php for ($g = 1; $g <= $project_data['number_of_groups']; $g++) { ?>
            <fieldset class="d-flex flex-column gap-1">
              <legend class="mb-2 ml-1">Group #<?= $g ?></legend>
              <?php if (!$asigned_students): ?>
                <?php for ($s = 1; $s <= $left_join[$g]['student_number']; $s++) { ?>
                  <select id="<?= $s ?>" class="form-control" name="group_<?= $g ?>">
                    <option disabled selected>Select a student</option>
                    <?php foreach ($student_list as $student) { ?>
                      <option value="<?= $student['id'] ?>"><?= $student['full_name'] ?></option>
                      <?php } ?>
                    </select>
                    <?php } ?>
                <?php else: ?>
                  <?php for ($s = 1; $s <= $left_join[$g]['student_number']; $s++) { ?>
                    <select id="<?= $s ?>" class="form-control" name="group_<?= $g ?>">
                      <option disabled selected>Select a student</option>
                      <?php foreach ($student_list as $student) { ?>
                        <option value="<?= $student['id'] ?>"><?= $student['full_name'] ?></option>
                        <?php } ?>
                      </select>
                      <?php } ?>
                      <?php endif; ?>
            </fieldset>
          <?php } ?>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary w-100">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>