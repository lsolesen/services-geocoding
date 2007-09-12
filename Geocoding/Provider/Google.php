<?php
/**
 * Communicates with Google
 *
 * Provided with an address this will return a geographic point
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
require_once 'XML/Unserializer.php';
require_once 'Math/GeographicPoint/LatitudeLongitude.php';

/**
 * Communicates with Google
 *
 * Geocodes an address to a geographic point
 *
 * @category  Services
 * @package   Services_Geocoding
 * @author    Lars Olesen <lars@legestue.net>
 * @copyright 2007 Authors
 * @license   GPL http://www.opensource.org/licenses/gpl-license.php
 * @version   @package-version@
 * @link      http://public.intraface.dk
 */
class Services_Geocoding_Provider_Google
{
    /**
     * Api key provided by google
     *
     * @return string
     */
    private $_api_key;

    /**
     * Constructor
     *
     * @param string $api_key the api key to the provider
     * @param object $address the address
     *
     * @return void
     */
    public function __construct($address, $api_key)
    {
        $this->_api_key = $api_key;
        $this->address = $address;
    }

    /**
     * Gets information about an address
     *
     * @return array with all the information
     */
    public function information()
    {
        $api_url = 'http://maps.google.com/maps/geo?&output=xml&key=' . $this->_api_key . '&q=';
        $unserializer = new XML_Unserializer();
        $result = $unserializer->unserialize($api_url . urlencode($this->address->toString()), true);
        if (PEAR::isError($result)) {
            return $result;
        }

        if ($this->responseIsOk($response = $unserializer->getUnserializedData())) {
            return $response;
        } else {
            throw new Exception('address could not be found');
        }

    }

    /**
     * Gets coordinates for an address
     *
     * @return object
     */
    function coordinates()
    {
        $array = $this->information();

        $coordinates = $array['Response']['Placemark']['Point']['coordinates'];
        $split = explode(',', $coordinates);

        $latitude = $split[1];
        $longitude = $split[0];

        return new Math_GeographicPoint_LatitudeLongitude($latitude, $longitude);

    }

    /**
     * Checks wheter the status code on the response is ok (200)
     *
     * @param array $response Array with the unserialized response
     *
     * @return boolean
     */
    static private function responseIsOk($request)
    {
        return (intval($request['Response']['Status']['code']) === intval(200));
    }
}
?>