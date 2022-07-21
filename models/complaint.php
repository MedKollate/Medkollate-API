<?php
    class complaints{
        //variables declaration
        private $conn;
        private $table = 'complaint';

        public $complaint_id;
        public $complaint_name;
        public $complaint;

        //constructor
        public function __construct($db) {
            $this->conn = $db;
        }
        //Read function
        public function get() {
            //query
            $query = mysqli_query($this->conn, "SELECT 
        c.complaint_id, c.complaint_name, c.complaint
            FROM $this->table c  ORDER BY complaint_id  ");

            return $query;
        }

        //Read a complaint
        public function get_single() {
            //collect the id from the url
            $this->id = $_GET['complaint_id'];
            // Create query
            $query = mysqli_query(
                $this->conn,
                "SELECT * FROM " . $this->table . " WHERE complaint_id=$this->id");

              $row = mysqli_fetch_array($query); // fetch data

            // Set properties
            $this->complaint_id = $row['complaint_id'];
            $this->complaint_name = $row['complaint_name'];
            $this->complaint = $row['complaint'];
      }

        //Create a complaint
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->table ."
                    SET
                        
                    complaint_id = ?, 
                    complaint_name= ?, 
                    complaint = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            $this->complaint_id=htmlspecialchars(strip_tags($this->complaint_id));
            $this->complaint_name=htmlspecialchars(strip_tags($this->complaint_name));
            $this->complaint=htmlspecialchars(strip_tags($this->complaint));
            
        
            // bind parameters
            $stmt->bind_param('iss', $this->complaint_id, $this->complaint_name, $this->complaint);
            
            
        
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
                        complaint_name = ?, 
                        complaint = ?
                    WHERE
                        complaint_id = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize data
            $this->complaint_name=htmlspecialchars(strip_tags($this->complaint_name));
            $this->complaint=htmlspecialchars(strip_tags($this->complaint));
            $this->complaint_id=htmlspecialchars(strip_tags($this->complaint_id));
            
        
            // bind parameters
            $stmt->bind_param('ssi',$this->complaint_name, $this->complaint, $this->complaint_id);
            
            
        
            if($stmt->execute()){ //Exexute query
               return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //Delete Schedule
        public function delete () {
            $this->id = $_GET['complaint_id'];
            $query = mysqli_query(
                $this->conn,
                "DELETE FROM " . $this->table . " WHERE complaint_id=$this->id");

        }

    }