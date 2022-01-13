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
    public function getAllFromTable($table_name) {
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
        $sql = "SELECT * FROM groups WHERE project_id = ?";
        $result = $this->connect()->prepare($sql);
        $result->execute([$id]);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
    
    public function get_groups_left_join_students($id) {
        $sql = 'SELECT * FROM groups LEFT JOIN students ON groups.id = students.group_id WHERE groups.project_id = ?';
        $result = $this->connect()->prepare($sql);
        $result->execute([$id]);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }

    public function get_group_for_student() {
        $sql = "SELECT * FROM students LEFT JOIN groups ON groups.id = students.group_id LEFT JOIN projects ON groups.project_id = projects.id";
        $data = $this->connect()->query($sql);

        return $data;
    }

    // new
//Get list of groups belonging to a project
    public function getGroupsByProject($project_id) {
        $sql = 'SELECT * FROM groups INNER JOIN projects ON groups.project_id = projects.id WHERE projects.id = :project_id';
        $result = $this->connect()->prepare($sql);
        $result->execute([':project_id' => $project_id]);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    //Get list of users belonging to a group
    public function getUsersByGroup($group_id) {
        $sql = 'SELECT * FROM students LEFT JOIN groups ON students.group_id = groups.id WHERE groups.id = :group_id';
        $result = $this->connect()->prepare($sql);
        $result->execute([':group_id' => $group_id]);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
// CREATEs

    public function create_project($name, $groups) {
        $project_sql = "INSERT INTO projects(project_name, number_of_groups) VALUES (?, ?)";
        $project_stmt = $this->connect()->prepare($project_sql);
        $project_stmt->execute([$name, $groups]);
        
    }
    public function create_group($name, $students){
        $project_id = $this->get_project_id($name);
        $group_sql = "INSERT INTO groups(student_number, project_id) VALUES (?, ?)";
        $group_stmt = $this->connect()->prepare($group_sql);
        $group_stmt->execute([$students, $project_id]);
    }
    public function create_student($name) {
        $sql = "INSERT INTO students(full_name) VALUES (?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name]);
    }
    
    // DELETEs
    
    public function delete_project($id) {
        $sql = "DELETE FROM projects WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);   
    } 
    public function delete_student($id) {
        $sql = "DELETE FROM students WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);   
    } 
}
