<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Live Controller for maps, graphs etc.
 */


class Live extends CI_Controller {

	private $formFields = array();

	public function __construct()
	{
		parent::__construct();

	}

	/**
	 * Live Controller
	 */ 
	public function index()
	{
		
		$cookie_u = getUserCookie();
		
		$uSessData = $this->cb_cache->get($cookie_u['uai']);

		$viewData = array();
		$viewData['email'] = $uSessData['u_email'];
		$viewData['uai'] = $uSessData['u_app_uid'];
		
		$content = $this->load->view('live/index', $viewData, true);

		$this->render($content, __function__);
	}

	/**
	 * Map Controller
	 */ 
	public function map()
	{
		
		$cookie_u = getUserCookie();
		
		$uSessData = $this->cb_cache->get($cookie_u['uai']);

		$viewData = array();
		$viewData['email'] = $uSessData['u_email'];
		$viewData['uai'] = $uSessData['u_app_uid'];
		
		$content = $this->load->view('live/plain_map', $viewData, true);

		$this->render($content, __function__);
	}

	/**
	 * Render page in layout
	 */
	protected function render($content, $action = '') {
		$view_data = array (
			'content' => $content,
			'pageTitle' => ucfirst(__class__. ' ' .$action)
			);
		$this->load->view('layout_db', $view_data);
	}
}
?>