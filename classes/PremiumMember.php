<?php

/**
 * PremiumMember class extends Member.
 *
 * PremiumMember has additional methods: getInDoorInterests(),
 * setInDoorInterests(), getOutDoorInterests(), and setOutDoorInterests().
 * @author Vera Mankongvanichkul
 * @copyright 2019
 */

class PremiumMember extends Member
{
    //strings
    private $_inDoorInterests;
    //strings
    private $_outDoorInterests;

    /**
     * Parameterized constructor for PremiumMember from superclass Member
     * @param $fname string, The first name of the member
     * @param $lname string, The last name of the member
     * @param $age integer, The age of the member
     * @param $gender string, The first name of the member
     * @param $phone integer, The phone number of the member
     * @param $_inDoorInterests string, Member's indoor interests
     * @param $_outDoorInterests string, Member's outdoor interests
     */
    function __construct($fname, $lname, $age, $gender, $phone,$_inDoorInterests, $_outDoorInterests)
    {
        //Pass name, age, gender, phone to Member constructor
        parent:: __construct($fname, $lname, $age, $gender, $phone);

        //Set indoor interests
        $this->_inDoorInterests = $_inDoorInterests;

        //Set outdoor interests
        $this->_outDoorInterests = $_outDoorInterests;
    }

    /**
     * Get premium member's indoor interests
     * @return string
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * Set premium member's indoor interests
     * @param string $inDoorInterests premium member's indoor interests
     * @return void
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * Get premium member's outdoor interests
     * @return string
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * Set premium member's outdoor interests
     * @param string $outDoorInterests premium member's outdoor interests
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }

}