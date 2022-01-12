<?php

class Dbcon {

    public function connect()
    {
        $conn = new PDO("mysql:host=localhost;dbname=nfq_task", 'admin', 'admin');
        
        return $conn;
    }
}


class Dbquerys extends Dbcon { 
// GETs
    public function select_all($table_name) {
        $sql = "SELECT * FROM $table_name";
        $result = $this->connect()->query($sql);

        return $result;
    }

    public function get_project_id($name) {
        $sql = "SELECT id FROM projects WHERE project_name = ?";
        $result = $this->connect()->prepare($sql);
        $result->execute([$name]);
        $id = $result->fetch(PDO::FETCH_ASSOC);
        
        return $id['id'];
    }

    public function get_project_data_from_id($id) {
        $sql = "SELECT * FROM projects WHERE id = ?";
        $result = $this->connect()->prepare($sql);
        $result->execute([$id]);
        $data = $result->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function get_group_data($id) {
        $sql = "SELECT * FROM groups WHERE project_pk = ?";
        $result = $this->connect()->prepare($sql);
        $result->execute([$id]);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
    
    public function get_groups_left_join_students($id) {
        $sql = 'SELECT * FROM groups LEFT JOIN students ON groups.id = students.group_fk WHERE groups.project_pk = ?';
        $result = $this->connect()->prepare($sql);
        $result->execute([$id]);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;


    }
// CREATEs

    public function create_project($name, $groups) {
        $project_sql = "INSERT INTO projects(project_name, number_of_groups) VALUES (?, ?)";
        $project_stmt = $this->connect()->prepare($project_sql);
        $project_stmt->execute([$name, $groups]);
        
    }
    public function create_group($name, $students, $counter){
        $project_pk = $this->get_project_id($name);
        $group_sql = "INSERT INTO groups(student_number, project_pk, group_id) VALUES (?, ?, ?)";
        $group_stmt = $this->connect()->prepare($group_sql);
        $group_stmt->execute([$students, $project_pk, $counter]);
    }
    public function create_student($name) {
        $sql = "INSERT INTO students(full_name) VALUES (?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name]);
    }
}   

