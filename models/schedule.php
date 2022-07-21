<?php
    class schedules{
        //variables declaration
        private $conn;
        private $table = 'schedule';

        public $appoint_id;
        public $pat_id;
        public $doc_id;
        public $appoint_time;

        //constructor
        public function __construct($db) {
            $this->conn = $db;
        }
        //Read function
        public function get() {
            //query
            $query = mysqli_query($this->conn, "SELECT 
            s.appoint_id, s.pat_id, s.doc_id, s.appoint_time
            FROM $this->table s  ORDER BY appoint_id  ");

            return $query;
        }

        //Read a schedule
        public function get_single() {
            //collect the id from the url
            $this->id = $_GET['appoint_id'];
            // Create query
            $query = mysqli_query(
                $this->conn,
                "SELECT * FROM " . $this->table . " WHERE appoint_id=$this->id");

              $row = mysqli_fetch_array($query); // fetch data

            // Set properties
            $this->appoint_id = $row['appoint_id'];
            $this->pat_id = $row['pat_id'];
            $this->doc_id = $row['doc_id'];
            $this->appoint_time = $row['appoint_time'];
      }

        //Create function
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->table ."
                    SET
                        
                        pat_id = ?, 
                        doc_id = ?, 
                        appoint_time = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            #$this->appoint_id=htmlspecialchars(strip_tags($this->appoint_id));
            $this->pat_id=htmlspecialchars(strip_tags($this->pat_id));
            $this->doc_id=htmlspecialchars(strip_tags($this->doc_id));
            $this->appoint_time=htmlspecialchars(strip_tags($this->appoint_time));
            
        
            // bind parameters
            $stmt->bind_param('iis', $this->pat_id, $this->doc_id, $this->appoint_time);
            
            
        
            if($stmt->execute()){ //Exexute query
               return true;
            }
            #printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //Update Schedule
        public function update(){
            $sqlQuery = "UPDATE
                        ". $this->table ."
                    SET
                        pat_id = ?, 
                        doc_id = ?, 
                        appoint_time = ?
                    WHERE
                        appoint_id = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            $this->pat_id=htmlspecialchars(strip_tags($this->pat_id));
            $this->doc_id=htmlspecialchars(strip_tags($this->doc_id));
            $this->appoint_time=htmlspecialchars(strip_tags($this->appoint_time));
            $this->appoint_id=htmlspecialchars(strip_tags($this->appoint_id));
            
        
            // bind parameters
            $stmt->bind_param('iisi', $this->pat_id, $this->doc_id, $this->appoint_time, $this->appoint_id);
            
            
        
            if($stmt->execute()){ //Exexute query
               return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //Delete Schedule
        public function delete () {
            $this->id = $_GET['schedule_id'];
            $query = mysqli_query(
                $this->conn,
                "DELETE FROM " . $this->table . " WHERE schedule_id=$this->id");

        }
    }