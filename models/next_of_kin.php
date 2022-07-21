<?php
    class next_of_kins{
        private $conn;
        private $table = 'next_of_kin';

        public $kin_id;
        public $name;
        public $phone_no;
        public $email;
        public $relationship;
        public $address;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function get() {
            $query = mysqli_query($this->conn, "SELECT 
            n.kin_id, n.name, n.phone_no, n.email, n.relationship, n.address
            FROM $this->table n  ORDER BY kin_id ");

            return $query;
        }

        //Read a hospital
        public function get_single() {
            //collect the id from the url
            $this->id = $_GET['kin_id'];
            // Create query
            $query = mysqli_query(
                $this->conn,
                "SELECT * FROM " . $this->table . " WHERE kin_id=$this->id");

              $row = mysqli_fetch_array($query); // fetch data

            // Set properties
            $this->kin_id = $row['kin_id'];
            $this->phone_no = $row['phone_no'];
            $this->email = $row['email'];
            $this->relationship = $row['relationship'];
            $this->address = $row['address'];
      }


        //Create function
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->table ."
                    SET
                        name = ?, 
                        phone_no = ?,
                        email = ?,
                        relationship = ?,
                        address = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->relationship=htmlspecialchars(strip_tags($this->relationship));
            $this->address=htmlspecialchars(strip_tags($this->address));
            
        
            // bind parameters
            $stmt->bind_param('sssss', $this->name, $this->phone_no, $this->email, $this->relationship, $this->address);
        
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
                        email = ?,
                        relationship = ?,
                        address = ?
                    WHERE
                        kin_id = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));
            $this->gmail=htmlspecialchars(strip_tags($this->email));
            $this->relationship=htmlspecialchars(strip_tags($this->relationship));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->kin_id=htmlspecialchars(strip_tags($this->kin_id));
            
        
            // bind parameters
            $stmt->bind_param('sssssi', $this->name, $this->phone_no, $this->email, $this->relationship, $this->address, $this->kin_id);
            
            
            
        
            if($stmt->execute()){ //Exexute query
               return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //Delete Schedule
        public function delete () {
            $this->id = $_GET['kin_id'];
            $query = mysqli_query(
                $this->conn,
                "DELETE FROM " . $this->table . " WHERE kin_id=$this->id");

        }
    }