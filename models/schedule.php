<?php
    class schedules{
        private $conn;
        private $table = 'schedule';

        public $appoint_id;
        public $pat_id;
        public $doc_id;
        public $appoint_time;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function get() {
            $query = mysqli_query($this->conn, "SELECT 
            s.appoint_id, s.pat_id, s.doc_id, s.appoint_time
            FROM $this->table s  ORDER BY appoint_id  ");

            return $query;
        }
    }