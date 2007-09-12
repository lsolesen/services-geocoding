<?php
/**
 * Test class
 *
 * Requires Sebastian Bergmann's PHPUnit
 *
 * PHP version 5
 *
 * @category  Services
 * @package   Services_Geocoding
 * @author    Lars Olesen <lars@legestue.net>
 * @copyright 2007 Authors
 * @license   GPL http://www.opensource.org/licenses/gpl-license.php
 * @version   @package-version@
 * @link      http://public.intraface.dk
 */
require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__) . '/../Geocoding.php';
require_once dirname(__FILE__) . '/../Geocoding/Address.php';

/**
 * Test class
 *
 * @category  Services
 * @package   Services_Geocoding
 * @author    Lars Olesen <lars@legestue.net>
 * @copyright 2007 Authors
 * @license   GPL http://www.opensource.org/licenses/gpl-license.php
 * @version   @package-version@
 * @link      http://public.intraface.dk
 */
class GoogleTest extends PHPUnit_Framework_TestCase
{
    public function testConstruction()
    {
        $address = new Services_Geocoding_Address;
        $address->street = '20th Street';
        $address->house = 520;
        $address->city = 'Santa Monica';
        $address->zip = '90402';
        $address->state = 'CA';
        $address->country = 'USA';

        $geo = Services_Geocoding::factory('google', $address, 'ABQIAAAAUFgD-PSpsw5MDGYzf-NyqBT5Xij7PtUjdkWMhSxoVKuMOjPcWxR5Rf13LT-bMD4Iiu_tpJ5XdRMJ3g');

        $this->assertTrue(is_object($geo));
    }

    public function testCoordinatesReturnsValidGeographicPoint()
    {
        $address = new Services_Geocoding_Address;
        $address->street = '20th Street';
        $address->house = 520;
        $address->city = 'Santa Monica';
        $address->zip = '90402';
        $address->state = 'CA';
        $address->country = 'USA';

        $geo = Services_Geocoding::factory('google', $address, 'ABQIAAAAUFgD-PSpsw5MDGYzf-NyqBT5Xij7PtUjdkWMhSxoVKuMOjPcWxR5Rf13LT-bMD4Iiu_tpJ5XdRMJ3g');
        $coord = $geo->coordinates();

        $this->assertTrue(is_object($coord));

        $this->assertEquals($coord->getLongitude(), -118.492787);
        $this->assertEquals($coord->getLatitude(), 34.039150);
    }
    public function testUnknowsAddressThrowsException()
    {
        $address = new Services_Geocoding_Address;
        $address->street = 'Not found';
        $address->house = 520;
        $address->city = 'Not found';
        $address->zip = '000';
        $address->state = 'NB';
        $address->country = 'Not found';

        $geo = Services_Geocoding::factory('google', $address, 'ABQIAAAAUFgD-PSpsw5MDGYzf-NyqBT5Xij7PtUjdkWMhSxoVKuMOjPcWxR5Rf13LT-bMD4Iiu_tpJ5XdRMJ3g');

        try {
            $coord = $geo->coordinates();
        }
        catch (Exception $e) {
            return;
        }
        $this->fail('This was expected to throw an exception');

    }

}
?>