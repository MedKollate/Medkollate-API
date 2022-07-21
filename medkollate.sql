CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_name` varchar(100) NOT NULL,
  `complaint` text NOT NULL,
  PRIMARY KEY (`complaint_id`)
);

CREATE TABLE `hospital` (
  `hosp_id` int(11) NOT NULL AUTO_INCREMENT,
  `hosp_name` varchar(255) NOT NULL,
  `LGA` varchar(255) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `no_of_staff` varchar(30) NOT NULL,
  `location` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `GRM` varchar(30) NOT NULL,
  PRIMARY KEY (`hosp_id`)
);

CREATE TABLE `next_of_kin` (
  `kin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone_no` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `relationship` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`kin_id`)
);

CREATE TABLE `patient` (
  `pat_id` int(11) NOT NULL AUTO_INCREMENT,
  `pat_name` varchar(150) NOT NULL,
  `pat_addr` varchar(255) NOT NULL,
  `pat_sex` varchar(30) NOT NULL,
  `pat_email` varchar(100) NOT NULL,
  `pat_Dob` varchar(100) NOT NULL,
  `pat_marital_status` varchar(30) NOT NULL,
  `pat_genotype` varchar(30) NOT NULL,
  `pat_blood_group` varchar(30) NOT NULL,
  `pat_occupation` varchar(255) NOT NULL,
  `pat_allergy` varchar(255) NOT NULL,
  `pat_height` varchar(10) NOT NULL,
  `pat_weight` varchar(10) NOT NULL,
  PRIMARY KEY (`pat_id`)
);

CREATE TABLE `next_of_kin` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `pat_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `pay_time` varchar(50) NOT NULL,
  `pay_type` varchar(50) NOT NULL,
  `pay_date` varchar(50) NOT NULL,
  PRIMARY KEY (`pay_id`)
);

CREATE TABLE `request_form` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `sub_position` varchar(255) NOT NULL,
  `date` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`request_id`)
);

CREATE TABLE `schedule` (
  `appoint_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` int(11) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `appoint_time` varchar(30) NOT NULL,
  PRIMARY KEY (`appoint_id`)
);

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `emergency_contact` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  PRIMARY KEY (`staff_id`)
);
