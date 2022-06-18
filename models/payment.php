<?php
    class payments{
        private $conn;
        private $table = 'payment';

        public $pay_id;
        public $pat_id;
        public $amount;
        public $pay_time;
        public $pay_type;
        public $pay_date;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function get() {
            $query = mysqli_query($this->conn, "SELECT 
            p.pay_id, p.pat_id, p.amount, p.pay_time, p.pay_type, p.pay_date
            FROM $this->table p  ORDER BY pat_id  ");

            return $query;
        }
    }