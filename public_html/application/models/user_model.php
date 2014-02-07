<?php
class User_model extends CI_Model {
	
	private $fields = array('u_id', 'u_app_uid', 'u_username', 'u_password', 
							'u_fullname', 'u_email', 'u_dob', 
							'u_is_active', 'u_create_datetime');

	private static $table = "users";


	/**
	 * Initiate db connection
	 */
	public function __construct () {

		//Class the Model construtor
		parent::__construct();

	}
	/**
	 * Add new user to the application.
	 * @param Array of new user details.
	 * @return userid / false
	 */
	public function addUser(Array $inData) {
		
		if(empty($inData)) {
			/* Log bad input data error. */
			return false;
		}
		if(!is_array($inData['fields'] ) ) {
			/* Log no user data present in indata array. */ 
			return false;
		}

		$userData = $inData['fields'];

		if(isset($userData['u_id']) || isset($userData['u_app_uid'])) {
			/**
			 * User data already have user id and app user id and new user
			 * new user can't be created with this data.
			 * Log invalid data error : user id present in new user data. 
			 */
			return false;
		}


		/* @todo : move it to utility and add salt to it. */
		/* Generate unique application userId */
		$userData['u_app_uid'] = strtotime(date('Y-m-d h:i:s')).str_replace('.', '', $_SERVER['REMOTE_ADDR']);

		/* Select only those fields that are present in the users table. */
		$validUserData = array_intersect($userData, array_flip($this->fields));

		/* Insert user data. */
		if($this->db->insert(self::$table, $validUserData)) {
			/* userId generated for the new user. */
			$userId = $this->db->insert_id();

			/* @todo : log user registration */
			/* @todo : send welcome email */

			/* return user id to contoller */
			return $userId;

		} else {

			/* Log unable to insert data in data table. Query: '$this->db->getQuery();'*/
			return false;	
		}
		
	}

	/**
	 * Update user details in the database.
	 * @param Array of user details.
	 * @return boolean;
	 */
	public function updateUser(Array $inData) {

		if(empty($inData)) {
			/* Log bad input data error. */
			return false;
		}

		if(!is_array($inData['fields'] ) ) {
			/* Log no user data present in indata array. */ 
			return false;
		}

		$userData = $inData['fields'];

		if(!isset($userData['u_id']) && !isset($userData['u_app_uid'])) {
			/**
			 * User data already have user id and app user id and new user
			 * new user can't be created with this data.
			 * Log invalid data error : user id present in new user data. 
			 */
			return false;
		}
		
		/* Select only those fields that are present in the users table. */
		$validUserData = array_intersect($userData, array_flip($this->fields));


		$this->db->where('u_app_uid', $userData['u_app_uid']);
		$this-> db->limit(1);
		
		unset($validUserData['u_id'],$validUserData['u_app_uid']);

		/* Update user detail*/
		if($this->db->update(self::$table, $validUserData)) {

			/* @todo : log user registration */
			/* @todo : send user detail notification email */

			/* return user id to contoller */
			return ture;
		}
		return false;
	}

	/**
	 * Fetch user details according to conditions in $inData..
	 * @param Array of where condistions.
	 * @return Array users with details
	 */
	public function getUsers(Array $inData) {
		
		if(!empty($inData['conditions'])) {
			
			/* Select only those fields that are present in the users table. */
			$conditions = array_intersect($inData['conditions'], array_flip($this->fields));
			$this->db->where($conditions);
		}

		if(!isset($inData['limit'])) {
			/* set default get user limit */
			/* @todo :  move the number into limit utility. */
			$inData['limit'] = 50;
		}

		$query = $this->db->get(self::$table, $inData['limit']);

		$users = array();
		foreach($query->result() as $row) {

			$users[] = $row;

		}
		
		/* return user details */
		return $users;


	}

	/**
	 *
	 */
	public function login(Array $inData) {
		return false;
	}

	/**
	 * Delete user from the table.
	 * @param Array u_id or u_app_uid.
	 * @return Boolean
	 */
	public function deleteUser(Array $inData) {

		if(empty($inData)) {
			/* Log bad input data error. */
			return false;
		}

		if(!isset($inData['u_app_uid'])) {
			/**
			 * no user id passed.
			 */
			return false;
		}
		

		$this->db->where('u_app_uid',  $inData['u_app_uid']);
		$this->db->limit(1);

		/* delete the user */
		if($this->db->delete(self::$table)) {

			/* user deleted */
			return true;

		} else {

			/* user can't be deleted. */
			return false;
		}


	}


}