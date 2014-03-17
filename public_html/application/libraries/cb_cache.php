<?php

/**
 * Couchbase wrapper class.
 */

class cb_cache
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
			exit($e->getMessage());
		}
		

	}

	function get($key) {

		try {

			if($this->handle instanceof Couchbase) {
				
				$data = json_decode($this->handle->get($key));
				return (array)($data);
			}	
		} catch (Exception $e) {
			exit($e->getMessage());
		}
	}



}
?>