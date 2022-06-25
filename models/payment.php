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
            FROM $this->table p  ORDER BY pay_id  ");

            return $query;
        }

        //Create function
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->table ."
                    SET
                        
                        pay_id = ?, 
                        pat_id = ?, 
                        amount = ?,
                        pay_time = ?,
                        pay_type = ?,
                        pay_date = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            $this->pay_id=htmlspecialchars(strip_tags($this->pay_id));
            $this->pat_id=htmlspecialchars(strip_tags($this->pat_id));
            $this->amount=htmlspecialchars(strip_tags($this->amount));
            $this->pay_time=htmlspecialchars(strip_tags($this->pay_time));
            $this->pay_type=htmlspecialchars(strip_tags($this->pay_type));
            $this->pay_date=htmlspecialchars(strip_tags($this->pay_date));
            
        
            // bind parameters
            $stmt->bind_param('iissss', $this->pay_id, $this->pat_id, $this->amount, $this->pay_time, $this->pay_type, $this->pay_date);
        
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
                        amount = ?,
                        pay_time = ?,
                        pay_type = ?,
                        pay_date = ?
                    WHERE
                        pay_id = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            
            $this->pat_id=htmlspecialchars(strip_tags($this->pat_id));
            $this->amount=htmlspecialchars(strip_tags($this->amount));
            $this->pay_time=htmlspecialchars(strip_tags($this->pay_time));
            $this->pay_type=htmlspecialchars(strip_tags($this->pay_type));
            $this->pay_date=htmlspecialchars(strip_tags($this->pay_date));
            $this->pay_id=htmlspecialchars(strip_tags($this->pay_id));
            
        
            // bind parameters
            $stmt->bind_param('issssi', $this->pat_id, $this->amount, $this->pay_time, $this->pay_type, $this->pay_date, $this->pay_id);
            
            
            
        
            if($stmt->execute()){ //Exexute query
               return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //Delete Schedule
        public function delete () {
            $sqlquery  =  "DELETE FROM $this->table WHERE pay_id=?";

            //prepare the query
            $stmt = $this->conn->prepare($sqlquery);

            //Sanitize data
            $this->pay_id=htmlspecialchars(strip_tags($this->pay_id));

            // bind parameters
            $stmt->bind_param('i', $this->pay_id);

            if($stmt->execute()){ //Exexute query
                return true;
             }
             printf("Error: %s.\n", $stmt->error);
             return false;

        }
    }