<?php
    class patients{
        private $conn;
        private $table = 'patient';

        public $pat_id;
        public $pat_name;
        public $pat_addr;
        public $pat_sex;
        public $pat_email;
        public $pat_Dob;
        public $pat_marital_status;
        public $rec_id;
        public $appoint_time;
        public $pay_id;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function get() {
            $query = mysqli_query($this->conn, "SELECT 
            p.pat_id, p.pat_name, p.pat_addr, p.pat_sex, p.pat_email, p.pat_Dob, p.pat_marital_status, p.rec_id, p.appoint_time, p.pay_id
            FROM $this->table p  ORDER BY pat_id  ");

            return $query;
        }
    }