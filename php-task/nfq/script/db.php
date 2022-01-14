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

    public function getProjectId($name) {
        $sql = "SELECT id FROM projects WHERE project_name = ?";
        $result = $this->connect()->prepare($sql);
        $result->execute([$name]);
        $id = $result->fetch(PDO::FETCH_ASSOC);
        
        return $id['id'];
    }

    public function getProjectDataFromId($id) {
        $sql = "SELECT * FROM projects WHERE id = ?";
        $result = $this->connect()->prepare($sql);
        $result->execute([$id]);
        $data = $result->fetch(PDO::FETCH_ASSOC);

        return $data;
    }
    
    public function getGroupsLeftJoinStudents($id) {
        $sql = 'SELECT * FROM groups LEFT JOIN students ON groups.id = students.group_id WHERE groups.project_id = ?';
        $result = $this->connect()->prepare($sql);
        $result->execute([$id]);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }

    public function getGroupForStudent() {
        $sql = "SELECT * FROM students LEFT JOIN groups ON groups.id = students.group_id LEFT JOIN projects ON groups.project_id = projects.id";
        $data = $this->connect()->query($sql);

        return $data;
    }

    // new
//Get list of groups belonging to a project
    public function getGroupsByProject($project_id) {
        $sql = 'SELECT * FROM projects INNER JOIN groups ON groups.project_id = projects.id WHERE projects.id = :project_id';
        $result = $this->connect()->prepare($sql);
        $result->execute([':project_id' => $project_id]);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
//Get list of students belonging to a group
    public function getStudentsByGroup($group_id) {
        $sql = 'SELECT * FROM students LEFT JOIN groups ON groups.id = students.group_id WHERE groups.id = :group_id';
        $result = $this->connect()->prepare($sql);
        $result->execute([':group_id' => $group_id]);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    public function getStudentIdByName($name) {
        $sql = 'SELECT * FROM students WHERE students.full_name = :fname';
        $result = $this->connect()->prepare($sql);
        $result->execute([':fname' => $name]);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        
        return $data;
    }
// CREATEs

    public function createProject($name, $groups) {
        $project_sql = "INSERT INTO projects(project_name, number_of_groups) VALUES (?, ?)";
        $project_stmt = $this->connect()->prepare($project_sql);
        $project_stmt->execute([$name, $groups]);
        
    }
    public function createGroup($name, $students){
        $project_id = $this->getProjectId($name);
        $group_sql = "INSERT INTO groups(student_number, project_id) VALUES (?, ?)";
        $group_stmt = $this->connect()->prepare($group_sql);
        $group_stmt->execute([$students, $project_id]);
    }
    public function createStudent($name) {
        $sql = "INSERT INTO students(full_name) VALUES (?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name]);
    }
    
    // DELETEs
    
    public function deleteProject($id) {
        $sql = "DELETE FROM projects WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);   
    } 
    public function deleteStudent($id) {
        $sql = "DELETE FROM students WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);   
    } 

    // UPDATES
    
    public function updateRemoveStudentFromGroup($id) {
        $sql = "UPDATE students SET group_id = NULL WHERE id = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([':id' => $id]);
    }      

    public function updateAddStudentToGroup($id, $group_id) {
        $sql = "UPDATE students SET group_id = :group_id WHERE students.id = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([':id' => $id, ':group_id' => $group_id]);
    }      
}