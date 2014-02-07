<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();

		/* $this->user_model */
		$this->load->model('user_model');

	}

	/**
	 * User Controller
	 */
	public function index()
	{
		$this->load->view('user/manage');
	}

	/**
	 *
	 */
	public function login()
	{
		
		$inData = array();

		if($this->input->post('btn-login-submit') !== false) {

			$inData['email'] = $this->input->post('uemail');
			$inData['password'] = $this->input->post('upassword');
			$inData['rememberme'] = $this->input->post('rememberme');

			// @todo : Move it inside after login.
			if($inData['rememberme']) {
				$this->setRememderMeCookie($inData);
			} else {
				$this->delRememderMeCookie();
			}
			$responseData = array('e_code' => '0', 'e_message' => '');
			if($this->user_model->login($inData, $responseData)) {
				/* $responseData['e_code'] value would be 1 */
				/* Create session for the user */

				/* Log user activity */
				$activity = array('u_id' => ''); /* @todo */

				/* redirect to the home after login. */
				redirect(base_url(). "/home");
			} else {
				/* Unable to login */
				switch($responseData['e_code']) {
					case '2' : 
							/* bad username or password */
							break;
					case '3' : 
							/* account not active */
							break;
					case '99' :
							/* strange system error */
							break;
				}
			}

			$formData = $inData;

		} else {
			$cookieData = $this->getRememderMeCookie();
			$formData['email'] = $cookieData['em'];
			$formData['password'] = $cookieData['pw'];
			$formData['rememberme'] = $cookieData['rm'];
		}

		$content = $this->load->view('user/login_form', $formData, true);

		$this->render($content, __function__);
	}

	protected function render($content, $action = '') {
		$view_data = array (
			'content' => $content,
			'pageTitle' => ucfirst(__class__. ' ' .$action)
			);
		$this->load->view('layout', $view_data);
	}


	private function setRememderMeCookie($cookieData = array()) {
		if(!empty($cookieData)) {

			$this->load->helper('cookie');
			// @todo : need to encrypt the data using some salt.
			$encodeCookieData = json_encode(
									array(
										'em' => $cookieData['email'],
										'pw' => $cookieData['password'],
										'rm' => $cookieData['rememberme']
										)
								);
	        $this->input->set_cookie("ud", $encodeCookieData,time()+3600);
	        	
		}
		
	}

	private function getRememderMeCookie() {
		
		$this->load->helper('cookie');

		// @todo : need to decrypt
        $cookieData = json_decode($this->input->cookie("ud"));
        
		return $cookieData;
	}

	private function delRememderMeCookie() {
		$this->load->helper('cookie');
		$this->input->set_cookie("ud", NULL,time()-3600);
	    
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */