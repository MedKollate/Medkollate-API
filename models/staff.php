<?php
    class staffs{
        private $conn;
        private $table = 'staff';

        public $doc_id;
        public $name;
        public $address;
        public $specialization;
        public $salary;
        public $pat_id;
        public $email;
        public $phone;
        public $appoint_time;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function get() {
            $query = mysqli_query($this->conn, "SELECT 
            s.doc_id, s.name, s.address, s.specialization, s.salary, s.pat_id, s.email, s.phone, appoint_time
            FROM $this->table s  ORDER BY doc_id  ");

            return $query;
        }
    }