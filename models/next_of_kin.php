<?php
    class next_of_kins{
        private $conn;
        private $table = 'pat_next_of_kin';

        public $kin_id;
        public $name;
        public $phone_no;
        public $gmail;
        public $relationship;
        public $address;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function get() {
            $query = mysqli_query($this->conn, "SELECT 
            n.kin_id, n.name, n.phone_no, n.gmail, n.relationship, n.address
            FROM $this->table n  ORDER BY kin_id ");

            return $query;
        }

        //Create function
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->table ."
                    SET
                        name = ?, 
                        phone_no = ?,
                        gmail = ?,
                        relationship = ?,
                        address = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));
            $this->gmail=htmlspecialchars(strip_tags($this->gmail));
            $this->relationship=htmlspecialchars(strip_tags($this->relationship));
            $this->address=htmlspecialchars(strip_tags($this->address));
            
        
            // bind parameters
            $stmt->bind_param('sssss', $this->name, $this->phone_no, $this->gmail, $this->relationship, $this->address);
        
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
                        name = ?, 
                        phone_no = ?,
                        gmail = ?,
                        relationship = ?,
                        address = ?
                    WHERE
                        kin_id = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));
            $this->gmail=htmlspecialchars(strip_tags($this->gmail));
            $this->relationship=htmlspecialchars(strip_tags($this->relationship));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->kin_id=htmlspecialchars(strip_tags($this->kin_id));
            
        
            // bind parameters
            $stmt->bind_param('sssssi', $this->name, $this->phone_no, $this->gmail, $this->relationship, $this->address, $this->kin_id);
            
            
            
        
            if($stmt->execute()){ //Exexute query
               return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //Delete Schedule
        public function delete () {
            $sqlquery  =  "DELETE FROM $this->table WHERE kin_id=?";

            //prepare the query
            $stmt = $this->conn->prepare($sqlquery);

            //Sanitize data
            $this->kin_id=htmlspecialchars(strip_tags($this->kin_id));

            // bind parameters
            $stmt->bind_param('i', $this->kin_id);

            if($stmt->execute()){ //Exexute query
                return true;
             }
             printf("Error: %s.\n", $stmt->error);
             return false;

        }
    }