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
		if($this->input->post('login-form-submit')) {

			$inData['username'] = $this->input->post('username');
			$inData['password'] = $this->input->post('password');

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
			}

		$content = $this->load->view('user/login_form');

		$this->render($content);
	}

	protected function render($content) {
		$view_data = array (
			'content' => $content
			);
		$this->load->view('layout', $view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */