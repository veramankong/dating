<?php
/*
 Vera Mankongvanichkul
 5.23.2019
 https://vmankongvanichkul.greenriverdev.com/it328/dating
 Database class

 CREATE TABLE member (
 member_id INT AUTO_INCREMENT PRIMARY KEY,
 fname VARCHAR(30) NOT NULL,
 lname VARCHAR(30) NOT NULL,
 age VARCHAR(30) NOT NULL,
 gender CHAR(6),
 phone VARCHAR(20) NOT NULL,
 email VARCHAR(320) NOT NULL,
 state VARCHAR(30),
 seeking CHAR(6),
 bio TEXT,
 premium TINYINT,
 image VARCHAR(30)
 );

 CREATE TABLE interest (
 interest_id INT AUTO_INCREMENT PRIMARY KEY,
 interest VARCHAR(30),
 type VARCHAR(20)
 );

 CREATE TABLE member_interest (
 member_id INT NOT NULL,
 interest_id INT NOT NULL,
 FOREIGN KEY(member_id) references member(member_id),
 FOREIGN KEY(interest_id) references interest(interest_id)
 );
 */

require '/home/vmankong/config.php';


class Database
{
    private $_db;


    function __construct()
    {
        $this->connect();
    }


    function connect()
    {
        try {
            //Instantiate a db object
            $this->_db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            return $this->_db;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }


    function insertMember($fname, $lname, $age, $phone, $email, $gender, $state, $seeking, $bio, $premium, $image)
    {
        //define query
        $query = 'INSERT INTO member
                  (fname, lname, age, gender, phone, email, state, seeking, bio, premium, image)
                  VALUES
                  (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image)';
        //prepare statement
        $statement = $this->_db->prepare($query);
        //bind parameters
        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_STR);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
        $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
        $statement->bindParam(':premium', $premium, PDO::PARAM_INT);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);
        //execute statement
        $statement->execute();
        echo 'success';
    }


    function insertMemberInterest($member_id, $interest_id)
    {
        //define query
        $query = 'INSERT INTO member_interest (member_id, interest_id)
                  VALUES (:member_id, :interest_id)';
        //prepare statement
        $statement = $this->_db->prepare($query);
        //bind parameters
        $statement->bindParam(':member_id', $member_id, PDO::PARAM_STR);
        $statement->bindParam(':interest_id', $interest_id, PDO::PARAM_STR);
        //execute statement
        $statement->execute();
        echo 'success';
    }


    function getInterestID($interest)
    {
        //define query
        $query = "SELECT interest_id FROM interest
                  WHERE interest = :interest";
        //prepare statement
        $statement = $this->_db->prepare($query);
        //bind parameters
        $statement->bindParam(':interest', $interest);
        //execute
        $statement->execute();
        //get result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    function getMemberID($fname, $lname)
    {
        //define query
        $query = "SELECT member_id FROM member
                  WHERE fname = :fname 
                  AND lname = :lname";
        //prepare statement
        $statement = $this->_db->prepare($query);
        //bind parameters
        $statement->bindParam(':fname', $fname);
        $statement->bindParam(':lname', $lname);
        //execute
        $statement->execute();
        //get result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    function getMembers()
    {
        //define query
        $query = "SELECT * FROM member
                  ORDER BY lname ASC";
        //prepare statement
        $statement = $this->_db->prepare($query);
        //execute
        $statement->execute();
        //get results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }


    function getMember($member_id)
    {
        //define query
        $query = "SELECT * FROM member
                  WHERE member_id = :member_id";
        //prepare statement
        $statement = $this->_db->prepare($query);
        //bind parameters
        $statement->bindParam(':member_id', $member_id);
        //execute
        $statement->execute();
        //get result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    function getInterests($member_id)
    {
        //define query
        $query = "SELECT interest, type
                  FROM interest
                  INNER JOIN member_interest
                  ON member_interest.interest_id = interest.interest_id
                  WHERE member_id = :member_id";
        //prepare statement
        $statement = $this->_db->prepare($query);
        //bind parameters
        $statement->bindParam(':member_id', $member_id);
        //execute
        $statement->execute();
        //get results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}