<?php

/**
 * Couchbase wrapper class.
 */

final class couchbase 
{

	private $handle;

	function __construct() {

		$this->handle = new Couchbase("127.0.0.1:8091", "", "", "default");
	}

	function set($key, $data) {

		try {

			if($this->handle instanceof Couchbase) {
				$this->handle->set($key, $data);
			}	
		} catch (Exception $e) {

		}
		

	}

	function get($key) {

		try {

			if($this->handle instanceof Couchbase) {
				return $this->handle->get($key);
			}	
		} catch (Exception $e) {

		}
	}



}
?>