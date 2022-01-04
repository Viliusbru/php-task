<?php

// include 'db.php';

class Test extends Mysql {
    public function getStudents(){
        $sql = "SELECT * FROM students";
        $stmt = $this->connect()->query($sql);
        while($row = $stmt->fetch()) {
            echo $row['fname'] . '<br>';
        }
    }
}