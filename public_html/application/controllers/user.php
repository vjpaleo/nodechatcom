<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	private $formFields = array('ufullname', 'uemail', 'upassword', 'cpassword', 'udob', 'uzipcode', 'ucountry');

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
	
	public function user_get() {
		echo 'abc'; exit;
	}

	public function register() {

		$inData = array();

		if($this->input->post('btn-register-submit') !== false) {

			$inData['u_fullname'] = $this->input->post('ufullname');
			$inData['u_email'] = $this->input->post('uemail');
			
			$u_username = explode('@', $inData['u_email']);
			$inData['u_username'] = $u_username[0];
			$inData['u_password'] = $this->input->post('upassword');
			$inData['c_password'] = $this->input->post('cpassword');
			$inData['u_dob'] = $this->input->post('udob');
			$inData['u_zipcode'] = $this->input->post('uzipcode');
			$inData['u_country'] = $this->input->post('ucountry');

			if($inData['u_password'] === $inData['c_password']) {
				$salt = 'MY_BEST_SALT';
				$inData['u_password'] = md5($inData['c_password'].$salt);

				$this->user_model->register($inData);
				$_POST['btn-login-submit'] = 1;
				$this->login();
			}
		} else {
			$inData = array_fill_keys($this->formFields, NULL);
		}
		//var_dump($inData);
		$formData = $inData;
		$content = $this->load->view('user/register_form', $formData, true);

		$this->render($content, __function__);

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
				$userdata = array(
                   'userid'  => $responseData['user']['u_id'],
                   'userappid'  => $responseData['user']['u_app_uid'],
                   'username'  => $responseData['user']['u_username'],
                   'email'     => $responseData['user']['u_email'],
                   'zipcode'     => $responseData['user']['u_zipcode'],
                   'logged_in' => TRUE
               	);
				$this->session->set_userdata($userdata);

				/* Log user activity */
				$activity = array('u_id' => ''); /* @todo */

				$this->load->helper('url');
				/* redirect to the home after login. */
				redirect(base_url(). "home");
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

		// Load library
		$this->load->library('memcached_library');

		//$this->memcached_library->add('foo', 'bar codeigniter');

		// Lets try to get the key
		$results = $this->memcached_library->get('4507');

		var_dump($results);

		echo $this->memcached_library->getversion();
		echo "<br/>";

		// We can use any of the following "reset, malloc, maps, cachedump, slabs, items, sizes"
		$p = $this->memcached_library->getstats("sizes");

		
		// If the key does not exist it could mean the key was never set or expired
		if (!$results) 
		{
			// Lets store the results
			$this->memcached_library->add('foo', 'bar codeigniter');

			// Output a basic msg
			echo "Alright! Stored some results from the Query... Refresh Your Browser";
		}
		else 
		{
			// Output
			var_dump($results);

			// Now let us delete the key for demonstration sake!
			//$this->memcached_library->delete('test');
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
        
		return (Array) $cookieData;
	}

	private function delRememderMeCookie() {
		$this->load->helper('cookie');
		$this->input->set_cookie("ud", NULL,time()-3600);
	    
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */