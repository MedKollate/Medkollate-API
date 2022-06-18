<?php
    class database {
        private $db_host = "localhost";
        private $db_user = "root";
        private $db_password = "";
        private $db_name = "medkollate";
        private $db_port = 3307;
        private $conn;

        public function connect() {
            $this->conn = null;

           $this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_password, 
           $this->db_name, $this->db_port) or die("Error:" . mysqli_connect_error());

           return $this->conn;
        }

    }

/*$database = new database;
if ($database->connect()) {
    echo "database connected";
} */