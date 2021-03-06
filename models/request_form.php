<?php
    class request_forms{
        private $conn;
        private $table = 'request_form';

        public $request_id;
        public $name;
        public $sub_position;
        public $date;
        public $email;
        public $phone_no;
        public $description;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function get() {
            $query = mysqli_query($this->conn, "SELECT 
            r.request_id, r.name, r.sub_position, r.date, r.email, r.phone_no, r.description
            FROM $this->table r  ORDER BY request_id  ");

            return $query;
        }

        //Read a form
        public function get_single() {
            //collect the id from the url
            $this->id = $_GET['request_id'];
            // Create query
            $query = mysqli_query(
                $this->conn,
                "SELECT * FROM " . $this->table . " WHERE request_id=$this->id");

              $row = mysqli_fetch_array($query); // fetch data

            // Set properties
            $this->request_id = $row['request_id'];
            $this->sub_position = $row['sub_position'];
            $this->email = $row['email'];
            $this->phone_no = $row['phone_no'];
            $this->description = $row['description'];
      }
        
        //Create function
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->table ."
                    SET
                        name = ?, 
                        sub_position = ?,
                        date = ?,
                        gmail = ?,
                        phone_no = ?,
                        description = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->sub_position=htmlspecialchars(strip_tags($this->sub_position));
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->gmail=htmlspecialchars(strip_tags($this->gmail));
            $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));
            $this->description=htmlspecialchars(strip_tags($this->description));
        
            // bind parameters
            $stmt->bind_param('iissss', $this->name, $this->sub_position, $this->date, $this->gmail, $this->phone_no, $this->description);
        
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
                        sub_position = ?,
                        date = ?,
                        gmail = ?,
                        phone_no = ?,
                        description = ?
                    WHERE
                        request_id = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->sub_position=htmlspecialchars(strip_tags($this->sub_position));
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->gmail=htmlspecialchars(strip_tags($this->gmail));
            $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->request_id=htmlspecialchars(strip_tags($this->request_id));
            
        
            // bind parameters
            $stmt->bind_param('ssssssi', $this->name, $this->sub_position, $this->date, $this->gmail, $this->phone_no, $this->description,
            $this->request_id);
            
            
            
        
            if($stmt->execute()){ //Exexute query
               return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //Delete Schedule
        public function delete () {
            public function delete () {
                $this->id = $_GET['request_id'];
                $query = mysqli_query(
                    $this->conn,
                    "DELETE FROM " . $this->table . " WHERE request_id=$this->id");
    
            }
    }