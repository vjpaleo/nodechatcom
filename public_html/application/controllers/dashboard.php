<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	private $formFields = array();

	public function __construct()
	{
		parent::__construct();

		/* $this->dashboard_model */
		//$this->load->model('dashboard_model');

		/* Load user cookie helper. */
		$this->load->helper('user_cookie');

		$cookie_u = getUserCookie();
		
		if(empty($cookie_u['uai']) ) {

			/* redirect to the home after login. */
			redirect(base_url(). "user/login");
		}

	}

	/**
	 * User Controller
	 */ 
	public function index()
	{
		
		$cookie_u = getUserCookie();
		
		$uSessData = $this->couchbase->get($cookie_u['uai']);

		$viewData = array();

		$viewData['email'] = $uSessData['u_email'];

		$content = $this->load->view('dashboard/manage', $viewData, true);

		$this->render($content, __function__);
	}
	
	/**
	 * User Controller
	 */ 
	public function settings()
	{
		
		$cookie_u = getUserCookie();
		
		$uSessData = $this->couchbase->get($cookie_u['uai']);

		$viewData = array();

		$viewData['email'] = $uSessData['u_email'];

		$content = $this->load->view('dashboard/settings', $viewData, true);

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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */