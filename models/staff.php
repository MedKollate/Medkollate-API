<?php
    class staffs{
        private $conn;
        private $table = 'staff';

        public $staff_id;
        public $name;
        public $address;
        public $department;
        public $salary;
        public $email;
        public $phone;
        public $emergency_contact;
        public $state;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function get() {
            $query = mysqli_query($this->conn, "SELECT 
            s.staff_id, s.name, s.address, s.department, s.salary, s.email, s.phone, s.emergency_contact, s.state
            FROM $this->table s ORDER BY staff_id");

            return $query;
        }

        //Read a staff
        public function get_single() {
            //collect the id from the url
            $this->id = $_GET['staff_id'];
            // Create query
            $query = mysqli_query(
                $this->conn,
                "SELECT * FROM " . $this->table . " WHERE staff_id=$this->id");

              $row = mysqli_fetch_array($query); // fetch data

            // Set properties
            $this->staff_id = $row['staff_id'];
            $this->name = $row['name'];
            $this->address = $row['address'];
            $this->salary = $row['salary'];
            $this->email = $row['email'];
            $this->phone = $row['phone'];
            $this->emergency_contact = $row['emergency_contact'];
            $this->state = $row['state'];
      }

        //Create function
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->table ."
                    SET 
                        name = ?, 
                        address = ?,
                        department = ?,
                        salary = ?,
                        email = ?,
                        phone = ?,
                        emergency_contact = ?, 
                        state = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->department=htmlspecialchars(strip_tags($this->department));
            $this->salary=htmlspecialchars(strip_tags($this->salary));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->emergency_contact=htmlspecialchars(strip_tags($this->emergency_contact));
            $this->state=htmlspecialchars(strip_tags($this->state));
        
            // bind parameters
            $stmt->bind_param('ssssssss', $this->name, $this->address, $this->department, $this->salary, $this->email,
             $this->phone, $this->emergency_contact, $this->state);
        
            if($stmt->execute()){ //Exexute query
               return true;
            }
            #printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //Update staff
        public function update(){
            $sqlQuery = "UPDATE
                        ". $this->table ."
                    SET 
                        name = ?, 
                        address = ?,
                        department = ?,
                        salary = ?,
                        email = ?,
                        phone = ?,
                        emergency_contact = ?, 
                        state = ?
                    WHERE
                        staff_id = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->department=htmlspecialchars(strip_tags($this->department));
            $this->salary=htmlspecialchars(strip_tags($this->salary));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->emergency_contact=htmlspecialchars(strip_tags($this->emergency_contact));
            $this->state=htmlspecialchars(strip_tags($this->state));
            $this->staff_id=htmlspecialchars(strip_tags($this->staff_id));
            
        
            // bind parameters
            $stmt->bind_param('ssssssssi', $this->name, $this->address, $this->department, $this->salary, $this->email,
             $this->phone, $this->emergency_contact, $this->state, $this->staff_id);
            
            
            
        
            if($stmt->execute()){ //Exexute query
               return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //Delete Schedule
        public function delete () {
            public function delete () {
                $this->id = $_GET['staff_id'];
                $query = mysqli_query(
                    $this->conn,
                    "DELETE FROM " . $this->table . " WHERE staff_id=$this->id");
    
            }
    }