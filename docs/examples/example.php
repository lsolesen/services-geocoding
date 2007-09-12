<?php
/**
 * Example usage
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

error_reporting(E_ALL);

set_include_path('../../' . PATH_SEPARATOR . PATH_SEPARATOR . get_include_path());

require 'Services/Geocoding.php';
require 'Services/Geocoding/Address.php';

$address = new Services_Geocoding_Address;
$address->street = '20th Street';
$address->house = 520;
$address->city = 'Santa Monica';
$address->zip = '90402';
$address->state = 'CA';
$address->country = 'USA';

$geo = Services_Geocoding::factory('google', $address, 'ABQIAAAAUFgD-PSpsw5MDGYzf-NyqBT5Xij7PtUjdkWMhSxoVKuMOjPcWxR5Rf13LT-bMD4Iiu_tpJ5XdRMJ3g');
$coord = $geo->coordinates();

echo $coord->toString();

$address = new Services_Geocoding_Address;
$address->street = 'Kirketorvet';
$address->house = 2;
$address->city = 'Tranbjerg J';
$address->zip = '';

$geo = Services_Geocoding::factory('addresswebservice', $address);
$coord = $geo->coordinates();

echo $coord->toString();
?>