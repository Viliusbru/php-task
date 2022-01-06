<?php

class Dbcon {

    public function connect()
    {
        $conn = new PDO("mysql:host=localhost;dbname=nfq_task", 'admin', 'admin');
        
        return $conn;
    }
}


class Dbquerys extends Dbcon { 

    public function select_all($table_name) {
        $sql = "SELECT * FROM $table_name";
        $result = $this->connect()->query($sql);

        return $result;
    }

    public function find_project_id($name) {
        $sql = "SELECT id FROM projects WHERE project_name = ?";
        $result = $this->connect()->prepare($sql);
        $result->execute([$name]);
        $id = $result->fetch(PDO::FETCH_ASSOC);
        return $id['id'];
    }

    public function create_project($name, $groups) {
        $project_sql = "INSERT INTO projects(project_name, number_of_groups) VALUES (?, ?)";
        $project_stmt = $this->connect()->prepare($project_sql);
        $project_stmt->execute([$name, $groups]);
        
    }
    public function create_group($name, $students){
        $project_pk = $this->find_project_id($name);
        $group_sql = "INSERT INTO groups(student_number, project_pk) VALUES (?, ?)";
        $group_stmt = $this->connect()->prepare($group_sql);
        $group_stmt->execute([$students, $project_pk]);
    }
    public function create_student($name) {
        $sql = "INSERT INTO students(full_name) VALUES (?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name]);
    }
}   




