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
class AddressWebserviceTest extends PHPUnit_Framework_TestCase
{
    public function testConstruction()
    {
        $address = new Services_Geocoding_Address;
        $address->street = 'Kirketorvet';
        $address->house = 2;
        $address->city = 'Tranbjerg J';
        $address->zip = '';

        $geo = Services_Geocoding::factory('addresswebservice', $address);

        $this->assertTrue(is_object($geo));
    }

    public function testCoordinatesReturnsObjectAndValidValues()
    {
        $address = new Services_Geocoding_Address;
        $address->street = 'Kirketorvet';
        $address->house = 2;
        $address->city = 'Tranbjerg J';
        $address->zip = '';

        $geo = Services_Geocoding::factory('addresswebservice', $address);

        $this->assertTrue(is_object($geo));

        $coord = $geo->coordinates();

        $this->assertTrue(is_object($coord));

        $this->assertEquals(round($coord->getLongitude(), 7), round(10.1348997091, 7));
        $this->assertEquals(round($coord->getLatitude(), 7), round(56.0912022929, 7));
    }

    public function testUnknowsAddressThrowsException()
    {
        $this->markTestIncomplete('For some reason this throws an exception without being programmed - how can I improve the test?');

        $address = new Services_Geocoding_Address;
        $address->street = 'Not found';
        $address->house = 0;
        $address->city = 'Not found';
        $address->zip = '';

        $geo = Services_Geocoding::factory('addresswebservice', $address);

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