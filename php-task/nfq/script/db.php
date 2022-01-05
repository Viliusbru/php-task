<?php

class Dbcon {

    public function connect()
    {
        $conn = new mysqli('localhost', 'admin', 'admin', 'nfq_task');
        
        if ($conn -> connect_errno) {
            echo "Failed to connect to MySQL: " . $conn -> connect_error;
        }
        return $conn;
    }
}


class Dbquerys extends Dbcon { 

    public function select_all($table_name){
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

}

