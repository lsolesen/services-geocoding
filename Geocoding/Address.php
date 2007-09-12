<?php
/**
 * Holds an address
 *
 * PHP version 5
 *
 * @category  Services
 * @package   Services_Geocoding
 * @author    Lars Olesen <lars@legestue.net>
 * @copyright 2007 The authors
 * @license   GPL http://www.opensource.org/licenses/gpl-license.php
 * @version   @package-version@
 * @link      http://public.intraface.dk
 */

/**
 * Holds an address
 *
 * @category  Services
 * @package   Services_Geocoding
 * @author    Lars Olesen <lars@legestue.net>
 * @copyright 2007 Authors
 * @license   GPL http://www.opensource.org/licenses/gpl-license.php
 * @version   @package-version@
 * @link      http://public.intraface.dk
 */
class Services_Geocoding_Address
{
    public $street;
    public $house;
    public $zip;
    public $city;
    public $state;
    public $country;

    /**
     * Constructs the address element
     *
     * @param integer $house   House number
     * @param string  $street  Street address
     * @param integer $zip     Zip
     * @param string  $city    City
     * @param string  $state   State
     * @param string  $country Country
     *
     * @return string
     */
    public function __construct($house = '', $street = '', $zip = '', $city = '', $state = '', $country = '')
    {
        $this->street = $street;
        $this->house = $house;
        $this->zip = $zip;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
    }

    /**
     * Returns the addres in this form 1600 Amphitheatre Parkway, Mountain View, CA, USA
     *
     * @return string
     */
    public function toString()
    {
        return $this->house . ' ' . $this->street . ', ' . $this->city . ', ' . $this->state . ', ' . $this->country;
    }
}
?>