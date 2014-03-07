<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

	}

	/**
	 * Home Controller
	 */ 
	public function index()
	{
		$viewData = array();
		
		
		$content = $this->load->view('home/manage', $viewData, true);

		$this->render($content, __function__);
	}

	protected function render($content, $action = '') {
		$view_data = array (
			'content' => $content,
			'pageTitle' => ucfirst(__class__. ' ' .$action)
			);
		$this->load->view('layout', $view_data);
	}

}
?>