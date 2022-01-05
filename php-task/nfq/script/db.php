<?php

class Dbcon {

    public function connect()
    {
        $conn = new mysqli('localhost', 'admin', 'admin', 'nfq_task');
        
        return $conn;
    }
}


class Dbquerys extends Dbcon { 

    public function select_all($table_name) {
        $sql = "SELECT * FROM $table_name";
        $result = $this->connect()->query($sql);
        $rows = $result->num_rows;
        if($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
            }
    }


    public function create_project($name, $groups, $students) {
        $group_sql = "INSERT INTO groups(student_number) VALUES (?)";
        $group_stmt = $this->connect()->prepare($group_sql);
        $group_stmt->execute([$students]);
        $group_sql = "INSERT INTO projects(project_name, number_of_groups) VALUES (?, ?)";
        $group_stmt = $this->connect()->prepare($group_sql);
        $group_stmt->execute([$name, $groups]);
    }
}




