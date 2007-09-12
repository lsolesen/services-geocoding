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
require_once 'PHPUnit/TextUI/TestRunner.php';

require_once 'GoogleTest.php';
require_once 'AddressWebServiceTest.php';

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

if (!defined('PHPUNIT_MAIN_METHOD')) {
    define('PHPUNIT_MAIN_METHOD', 'GeocodingTests::main');
}

class GeocodingTests {
    public static function main() {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite('Geocoding');

        $suite->addTestSuite('GoogleTest');
        $suite->addTestSuite('AddressWebServiceTest');

        return $suite;
    }
}

if (PHPUNIT_MAIN_METHOD == 'GeocodingTests::main') {
    GeocodingTests::main();
}
?>