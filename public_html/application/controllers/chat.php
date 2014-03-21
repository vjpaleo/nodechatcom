<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller {

	private $formFields = array('ufullname', 'uemail', 'upassword', 'cpassword', 'udob', 'uzipcode', 'ucountry');

	public function __construct()
	{
		parent::__construct();

		/* $this->user_model */
		$this->load->model('user_model');

		/* Load user cookie helper. */
		$this->load->helper('user_cookie');

	}

}