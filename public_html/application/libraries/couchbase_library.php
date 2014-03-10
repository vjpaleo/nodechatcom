<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ALL | E_STRICT | E_DEPRECATED);
/**
 * Couchbase Client for CodeIgniter
 *
 * @author Vijay Singh <vjpaleo@gmail.com>
 * @version 0.0.0
 * @package Couchbase
 */

class couchbase_lib extends Memcached
{
	
	private static $_objClass;
	private function __construct() {

	}

	public function getInstance() {

		if($_objClass instanceof __CLASS__) {
			return self::$_objCLass;
		} else {
			self::$_objCLass = new __CLASS__;
		}

	}


}

?>