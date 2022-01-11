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
<?php if (isset($_GET['id'])){


    $project = new Dbquerys();
    $counter = 1;
    $project_data = $project->get_project_data_from_id($_GET['id']);
    $group_data = $project->get_students_per_group();
    foreach($group_data as $student) {
      if(!empty($student)) {
          $data[$student['group_id']][] = $student['name'];
      }
  }

    var_dump($data);

    $students = $project->select_all('students');
    foreach($students as $student) {
      if ($student['group_fk'] == NULL) {
        $student_list[] = $student;
      }
    }
  }
//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
//     }

// } else {
//     header('Location: index.php');
// }

?>
<form method="POST">
<div class="d-flex justify-content-center">
  <div class="card" style="width: 18rem;">
    <div class="card-body card-header text-center">
      <h5 class="card-title ">Project: <?php echo '<b>' .  $project_data['project_name'] . '</b>' ?></h5>
      <h6 class="card-subtitle mb-2">Number of Groups: <?='<b>' . $project_data['number_of_groups'] . '</b>'; ?></h6>
      <h6 class="card-subtitle mb-2">Students per group: <?='<b>' . $group_data[0]['student_number'] . '</b>'; ?></h6>
      <h3>Groups</h3>
      <div class="card superCenter pt-2">
        <?php for($g = 1; $g <= $project_data['number_of_groups']; $g++): ?>
          <div class="card-body d-flex flex-column gap-3">
            <p><div class="mb-2 ml-1 font-weight-bold"> Group
              <?= '#' . $g; ?></p>
            </div>
            <?php foreach($group_data as $select):?>
              <div class="card">
                <select name="group_<?=$g?>_students[]" id="<?=$select['id']?>" class="custom-select">
                  <?php foreach($student_list as $name):?>
                      <?php if ($select['student_id']): ?> 
                        <option value=<?=$name['id'] ?> selected><?=$name['full_name'] ?></option>
                      <?php else: ?>
                        <option value="" selected>Select a student</option>
                        <option value=<?=$name['id'] ?>><?=$name['full_name']?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>
                <?php endforeach; ?>
                <?php endfor; ?>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary w-100">Submit</button>
        </div>
      </div>
        </form>

