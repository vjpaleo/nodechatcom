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
	 
	public function index()
	{
		$this->load->view('user/manage');
	}
	*/

	public function user_get() {
		echo 'abc'; exit;
	}

	public function register() {

		$inData = array();

		if($this->input->post('btn-register-submit') !== false) {

			$inData['ufullname'] = $this->input->post('ufullname');
			$inData['uemail'] = $this->input->post('uemail');
			$inData['upassword'] = $this->input->post('upassword');
			$inData['cpassword'] = $this->input->post('cpassword');
			$inData['udob'] = $this->input->post('udob');
			$inData['uzipcode'] = $this->input->post('uzipcode');
			$inData['ucountry'] = $this->input->post('ucountry');

			if($inData['upassword'] === $inData['cpassword']) {
				$salt = 'MY_BEST_SALT';
				$inData['cpassword'] = md5($inData['cpassword'].$salt);

				$this->user_model->register($inData);
				$_POST['btn-login-submit'] = 1;
				$this->login();
			}
		} else {
			$inData = array_fill_keys($this->formFields, NULL);
		}
		var_dump($inData);
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
        
		return $cookieData;
	}

	private function delRememderMeCookie() {
		$this->load->helper('cookie');
		$this->input->set_cookie("ud", NULL,time()-3600);
	    
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */