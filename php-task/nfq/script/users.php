<?php

    class Student {
        public $fname;
        public $lname;

        public function __construct($fname, $lname){
            $this->fname = $fname;
            $this->lname = $lname;
        }
        // getters
        public function getFirstName(){
            return $this->fname;
        }
        public function getLastName(){
            return $this->lname;
        }
        public function getFullName(){
            return $this->fname . $this->lname;
        }
    }

    class Teacher {
        public $username;
        public $password;
    }
?>