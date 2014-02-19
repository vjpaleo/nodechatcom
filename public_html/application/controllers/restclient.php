<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
* API
*
* This controller act as a client for 'API' REST api class.
* This code can be moved into a library class and can be accessed from there.
* 
* NOTE : This is written jus for the reference purpose. This just shows how the 
*		 REST API can be implemented  in CodeIgniter Framework.
* NOTE : This code can be optimized further given more time.
* 
* @package 		FileHandlerApp 
* @category 	Controller
* @author 		Vijay Singh
* @link 		http://FileHandlerApp
*/


class restclient extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();

		
	}

	/**
	 * Test the post call in Rest API
	 */
	public function testpost() {

		$data = array("id" => "4234234", "data" => "This is the sample text just for interview reference."); /* For example */
	   	$data_string = json_encode($data);

	   $ch = curl_init('http://FileHandlerApp/index.php/api/file');
	   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	   curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	       'Content-Type: application/json',
	       'Content-Length: ' . strlen($data_string))
	   );

	   $result = curl_exec($ch);
	   $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	   $contenttype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
	   print "Status: $httpcode" . "\n";
	   print "Content-Type: $contenttype" . "\n";
	   print "\n" . $result . "\n";
	}


	/**
	 * Test the get call from the REST API.
	 */
	public function testget() {

		$data = array("id" => "4234234"); /* For example */
	   	$data_string = json_encode($data);

	   $ch = curl_init('http://FileHandlerApp/index.php/api/file');
	   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	   curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	       'Content-Type: application/json',
	       'Content-Length: ' . strlen($data_string))
	   );

	   $result = curl_exec($ch);
	   $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	   $contenttype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
	   print "Status: $httpcode" . "\n";
	   print "Content-Type: $contenttype" . "\n";
	   print "\n" . $result . "\n";
	}


	/**
	 * Test the delete call from the REST API.
	 */
	public function testdelete() {

		$data = array("id" => "4234234"); /* For example */
	   	$data_string = json_encode($data);

	   $ch = curl_init('http://FileHandlerApp/index.php/api/file');
	   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	   curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	       'Content-Type: application/json',
	       'Content-Length: ' . strlen($data_string))
	   );

	   $result = curl_exec($ch);
	   $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	   $contenttype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
	   print "Status: $httpcode" . "\n";
	   print "Content-Type: $contenttype" . "\n";
	   print "\n" . $result . "\n";
	}

	/**
	 * Test the put call from the REST Api.
	 */
	public function testput() {

		$data = array("id" => "4234234"); /* For example */
	   	$data_string = json_encode($data);

	   $ch = curl_init('http://FileHandlerApp/index.php/api/file');
	   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	   curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	       'Content-Type: application/json',
	       'Content-Length: ' . strlen($data_string))
	   );

	   $result = curl_exec($ch);
	   $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	   $contenttype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
	   print "Status: $httpcode" . "\n";
	   print "Content-Type: $contenttype" . "\n";
	   print "\n" . $result . "\n";
	}
}
?>