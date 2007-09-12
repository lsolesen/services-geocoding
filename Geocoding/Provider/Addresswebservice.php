<?php
/**
 * Communicates with the {@link http://aws.oio.dk/ Address Web Service} provided
 * by the Danish state.
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
// require_once 'nusoap/nusoap.php';
require_once 'Math/GeographicPoint/UTM.php';

/**
 * Communicates with Address Webservice - works for Danish addresses
 *
 * Will geocode a valid Danish address using {@link http://aws.oio.dk/ Address Web Service}
 *
 * @category  Services
 * @package   Services_Geocoding
 * @author    Lars Olesen <lars@legestue.net>
 * @copyright 2007 Authors
 * @license   GPL http://www.opensource.org/licenses/gpl-license.php
 * @version   @package-version@
 * @link      http://public.intraface.dk
 */
class Services_Geocoding_Provider_Addresswebservice
{
    /**
     * The soap client
     *
     * @var object
     */
     private $client;

    /**
     * The address
     *
     * @var object
     */
     private $address;

    /**
     * Constructs an object to communicate with the addresswebservice
     *
     * @param object $address Address object to geocode
     *
     * @return void
     */
    function __construct($address) {
        $url = 'http://rep.oio.dk/altforintet_dk/findaddressservice.wsdl';
        /*
        $options = array(
            'trace' => 1,
            'exceptions' => 1
        );

        $this->client = new SoapClient($url, $options);
        if($err = $this->client->getError()){
            trigger_error('error when creating soap server server', E_USER_ERROR);
            return false;
        }
        */

        $this->client = new SoapClient($url);



        $this->address = $address;
    }

    /**
     * Gets information about an address
     *
     * @return array
     */
    public function information()
    {
        $street = $this->address->street;
        $house = $this->address->house;

        $district = array(
            'DistrictName' => $this->address->city,
            'IncludeNeighbour' => true
        );
        $params = array(
            array(
                'NamedStreetTextInput' => $street,
                'StreetBuildingIdentifier' => $house,
                'DistrictSearch' => $district
            )
        );
        /*
        $result = $this->client->call('FindAddressAccess', $params);
        if($err = $this->client->getError()){
            trigger_error('error when calling server', E_USER_ERROR);
            return false;
        }
        */


        $result = $this->client->FindAddressAccess($params);

        return $result;
    }



    /**
     * Gets coordinates
     *
     * @return object
     */
    public function coordinates()
    {
        $result = $this->information();

        $easting = $result['SearchResult']['AddressPoint']['AddressLocation']['Point']['CoordinateTuple']['Easting'];
        $northing  = $result['SearchResult']['AddressPoint']['AddressLocation']['Point']['CoordinateTuple']['Northing'];

        $utm = new Math_GeographicPoint_UTM($easting, $northing, '32V');

        return $utm->toLatitudeLongitude();
    }
}
?>