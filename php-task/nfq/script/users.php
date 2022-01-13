<?php

    class Student {
        public $fname;

        public function __construct($fname){
            $this->fname = $fname;
        }
        // getters

        public function getFullName(){
            return $this->fname;
        }
    }

?>