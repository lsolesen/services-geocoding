<?php
/**
 * Geocoding is the process of converting addresses into geographic coodinates
 * (latitude, longitude), which you can use to place markers or position the map
 * based on street addresses in your database or addresses supplied by users.
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
 * Abstract class to hold different providers to make geocoding possible
 *
 * Have a look here http://emad.fano.us/blog/?p=277
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
 * @example   example.php
 */
abstract class Services_Geocoding
{

    /**
     * Creates a geocoding object with a correct provider
     *
     * @param string $provider The provider
     * @param object $address  The address
     * @param string $api_key  Optional if the provider needs authentication
     *
     * @return object
     */
    public function factory($provider, $address, $api_key = '')
    {
        require_once dirname(__FILE__) . '/Geocoding/Provider/'.ucfirst($provider).'.php';
        $class = 'Services_Geocoding_Provider_' . ucfirst($provider);
        return new $class($address, $api_key);
    }

    /**
     * Should get information about an address
     *
     * @return array with all the information
     */
    abstract public function information();

    /**
     * Should get coordinates for an address
     *
     * @return object
     */
    abstract public function coordinates();
}
?>