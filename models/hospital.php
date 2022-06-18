<?php
    class hospital{
        private $conn;
        private $table = 'hospital';

        public $hosp_name;
        public $location;
        public $doc_id;
        public $pat_id;
        public $appoint_id;
        public $pay_id;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function get() {
            $query = mysqli_query($this->conn, "SELECT 
            h.hosp_name, h.location, h.doc_id, h.pat_id, h.appoint_id, h.pay_id
            FROM $this->table h  ORDER BY hosp_name  ");

            return $query;
        }
    }