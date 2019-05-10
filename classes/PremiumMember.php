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
    // strings
    private $_inDoorInterests;
    // strings
    private $_outDoorInterests;

    /**
     *
     */
    function __construct($fname, $lname, $age, $gender, $phone)
    {
        parent:: __construct($fname, $lname, $age, $gender, $phone);
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