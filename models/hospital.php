<?php
    class hospitals{
        private $conn;
        private $table = 'hospital';

        public $hosp_name;
        public $LGA;
        public $contact_no;
        public $no_of_staff;
        public $location;
        public $email;
        public $GRM;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function get() {
            $query = mysqli_query($this->conn, "SELECT 
            h.hosp_id, h.hosp_name, h.LGA, h.contact_no, h.no_of_staff, h.location, h.email, h.GRM
            FROM $this->table h  ORDER BY hosp_name  ");

            return $query;
        }

        //Read a hospital
        public function get_single() {
            //collect the id from the url
            $this->id = $_GET['hosp_id'];
            // Create query
            $query = mysqli_query(
                $this->conn,
                "SELECT * FROM " . $this->table . " WHERE hosp_id=$this->id");

              $row = mysqli_fetch_array($query); // fetch data

            // Set properties
            $this->hosp_id = $row['hosp_id'];
            $this->hosp_name = $row['hosp_name'];
            $this->LGA = $row['LGA'];
            $this->contact_no = $row['contact_no'];
            $this->no_of_staff = $row['no_of_staff'];
            $this->location = $row['location'];
            $this->email = $row['email'];
            $this->GRM = $row['GRM'];
      }

        //Create function
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->table ."
                    SET     
                        hosp_name = ?, 
                        LGA = ?, 
                        contact_no = ?,
                        no_of_staff = ?,
                        location = ?,
                        email = ?,
                        GRM = ?";
                            
                //prepare the query
                $stmt = $this->conn->prepare($sqlQuery);
            
                // sanitize variables
                $this->hosp_name=htmlspecialchars(strip_tags($this->hosp_name));
                $this->LGA=htmlspecialchars(strip_tags($this->LGA));
                $this->contact_no=htmlspecialchars(strip_tags($this->contact_no));
                $this->no_of_staff=htmlspecialchars(strip_tags($this->no_of_staff));
                $this->location=htmlspecialchars(strip_tags($this->location));
                $this->email=htmlspecialchars(strip_tags($this->email));
                $this->GRM=htmlspecialchars(strip_tags($this->GRM));
                
            
                // bind parameters
                $stmt->bind_param('sssisss', $this->hosp_name, $this->LGA, $this->contact_no, $this->no_of_staff, $this->location,
                 $this->email, $this->GRM);
            
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
                        LGA = ?, 
                        contact_no = ?,
                        no_of_staff = ?,
                        location = ?,
                        email = ?,
                        GRM = ?
                    WHERE
                        hosp_name = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            
            $this->LGA=htmlspecialchars(strip_tags($this->LGA));
            $this->contact_no=htmlspecialchars(strip_tags($this->contact_no));
            $this->no_of_staff=htmlspecialchars(strip_tags($this->no_of_staff));
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->GRM=htmlspecialchars(strip_tags($this->GRM));
            $this->hosp_name=htmlspecialchars(strip_tags($this->hosp_name));
            
        
            // bind parameters
            $stmt->bind_param('ssissss', $this->LGA, $this->contact_no, $this->no_of_staff, $this->location, $this->email,
            $this->GRM, $this->hosp_name);
            
            
            
        
            if($stmt->execute()){ //Exexute query
               return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //Delete Schedule
        public function delete () {
            $this->id = $_GET['hosp_id'];
            $query = mysqli_query(
                $this->conn,
                "DELETE FROM " . $this->table . " WHERE'hosp_id=$this->id");

        }
    }