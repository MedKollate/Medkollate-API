<?php
    class patients{
        private $conn;
        private $table = 'patient';

        public $pat_id;
        public $pat_name;
        public $pat_addr;
        public $pat_sex;
        public $pat_email;
        public $pat_Dob;
        public $pat_marital_status;
        public $pat_genotype;
        public $pat_blood_group;
        public $pat_occupation;
        public $pat_allergy;
        public $pat_height;
        public $pat_weight;
        public $pat_phone;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function get() {
            $query = mysqli_query($this->conn, "SELECT 
            p.pat_id, p.pat_name, p.pat_addr, p.pat_sex, p.pat_email, p.pat_Dob, p.pat_marital_status, p.pat_genotype,
            p.pat_blood_group, p.pat_occupation, p.pat_allergy, p.pat_height, p.pat_weight, p.pat_phone 
            FROM $this->table p  ORDER BY pat_id");

            return $query;
        }

        //Create function
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->table ."
                    SET 
                        pat_name=?, 
                        pat_addr = ?,
                        pat_sex = ?,
                        pat_email = ?,
                        pat_Dob = ?,
                        pat_marital_status = ?,
                        pat_genotype = ?,
                        pat_blood_group = ?,
                        pat_occupation = ?,
                        pat_allergy = ?,
                        pat_height = ?,
                        pat_weight = ?,
                        pat_phone = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // clean data
            $this->pat_name=htmlspecialchars(strip_tags($this->pat_name));
            $this->pat_addr=htmlspecialchars(strip_tags($this->pat_addr));
            $this->pat_sex=htmlspecialchars(strip_tags($this->pat_sex));
            $this->pat_email=htmlspecialchars(strip_tags($this->pat_email));
            $this->pat_Dob=htmlspecialchars(strip_tags($this->pat_Dob));
            $this->pat_marital_status=htmlspecialchars(strip_tags($this->pat_marital_status));
            $this->pat_genotype=htmlspecialchars(strip_tags($this->pat_genotype));
            $this->pat_blood_group=htmlspecialchars(strip_tags($this->pat_blood_group));
            $this->pat_occupation=htmlspecialchars(strip_tags($this->pat_occupation));
            $this->pat_allergy=htmlspecialchars(strip_tags($this->pat_allergy));
            $this->pat_height=htmlspecialchars(strip_tags($this->pat_height));
            $this->pat_weight=htmlspecialchars(strip_tags($this->pat_weight));
            $this->pat_phone=htmlspecialchars(strip_tags($this->pat_phone));
            
        
            // bind parameters
            $stmt->bind_param('sssssssssssss', $this->pat_name, $this->pat_addr, $this->pat_sex, $this->pat_email, 
            $this->pat_Dob, $this->pat_marital_status, $this->pat_genotype, $this->pat_blood_group, $this->pat_occupation,
            $this->pat_allergy, $this->pat_height, $this->pat_weight, $this->pat_phone);
            
            
            
        
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
                    pat_name=?, 
                    pat_addr = ?,
                    pat_sex = ?,
                    pat_email = ?,
                    pat_Dob = ?,
                    pat_marital_status = ?,
                    pat_genotype = ?,
                    pat_blood_group = ?,
                    pat_occupation = ?,
                    pat_allergy = ?,
                    pat_height = ?,
                    pat_weight = ?,
                    pat_phone = ?

                    WHERE
                        pat_id = ?";
                        
            //prepare the query
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize variables
            $this->pat_name=htmlspecialchars(strip_tags($this->pat_name));
            $this->pat_addr=htmlspecialchars(strip_tags($this->pat_addr));
            $this->pat_sex=htmlspecialchars(strip_tags($this->pat_sex));
            $this->pat_email=htmlspecialchars(strip_tags($this->pat_email));
            $this->pat_Dob=htmlspecialchars(strip_tags($this->pat_Dob));
            $this->pat_marital_status=htmlspecialchars(strip_tags($this->pat_marital_status));
            $this->pat_genotype=htmlspecialchars(strip_tags($this->pat_genotype));
            $this->pat_blood_group=htmlspecialchars(strip_tags($this->pat_blood_group));
            $this->pat_occupation=htmlspecialchars(strip_tags($this->pat_occupation));
            $this->pat_allergy=htmlspecialchars(strip_tags($this->pat_allergy));
            $this->pat_height=htmlspecialchars(strip_tags($this->pat_height));
            $this->pat_weight=htmlspecialchars(strip_tags($this->pat_weight));
            $this->pat_phone=htmlspecialchars(strip_tags($this->pat_phone));
            $this->pat_id=htmlspecialchars(strip_tags($this->pat_id));
            
            // bind parameters
            $stmt->bind_param('sssssssssssssi', $this->pat_name, $this->pat_addr, $this->pat_sex, $this->pat_email, 
            $this->pat_Dob, $this->pat_marital_status,$this->pat_genotype, $this->pat_blood_group, $this->pat_occupation,
            $this->pat_allergy, $this->pat_height, $this->pat_weight, $this->pat_phone, $this->pat_id);
        
            if($stmt->execute()){ //Exexute query
               return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //Delete Schedule
        public function delete () {
            $sqlquery  =  "DELETE FROM $this->table WHERE pat_id=?";

            //prepare the query
            $stmt = $this->conn->prepare($sqlquery);

            //Sanitize data
            $this->pat_id=htmlspecialchars(strip_tags($this->pat_id));

            // bind parameters
            $stmt->bind_param('i', $this->pat_id);

            if($stmt->execute()){ //Exexute query
                return true;
             }
             printf("Error: %s.\n", $stmt->error);
             return false;

        }
    }