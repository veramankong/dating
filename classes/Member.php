<?php

/**
 * Class Member represents a member of the dating website.
 *
 * Class Member represents a member with a first name, last
 * name, age, gender, phone number, email, state, seeking
 * and bio.
 * @author Vera Mankongvanichkul
 * @copyright 2019
 */

class Member
{
    // string
    private $_fname;
    // string
    private $_lname;
    // integer
    private $_age;
    // string
    private $_gender;
    // integer
    private $_phone;
    // string
    private $_email;
    // string
    private $_state;
    // string
    private $_seeking;
    // string
    private $_bio;

    /**
     * Parameterized constructor for Member
     * @param $_fname string, The first name of the member
     * @param $_lname string, The last name of the member
     * @param $_age integer, The age of the member
     * @param $_gender string, The first name of the member
     * @param $_phone integer, The phone number of the member
     */
    public function __construct($_fname, $_lname, $_age, $_gender, $_phone)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_gender = $_gender;
        $this->_phone = $_phone;
    }

    /**
     * Get the first name of member
     * @return string
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Set the first name of member
     * @param string $fname first name of member
     * @return void
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * Get member's last name
     * @return string
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Set member's last name
     * @param string $lname last name of member
     * @return void
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * Get member's age
     * @return integer
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * Set member's age
     * @param integer $age member's age
     * @return void
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * Get member's gender
     * @return string
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * Set member's gender
     * @param string $gender member's gender
     * @return void
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * Get member's phone number
     * @return integer
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Set member's phone number
     * @param mixed $phone member's phone number
     * @return void
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * Get member's email
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Set member's email
     * @param string $email member's email
     * @return void
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Get member's state
     * @return string
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Set member's state
     * @param string $state member's state
     * @return void
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * Get member's preference
     * @return string
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /** Set member's preference
     * @param string $seeking preference of member
     * @return void
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * Get member's bio
     * @return string
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * Set member's bio
     * @param string $bio member's bio
     * @return void
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }

}