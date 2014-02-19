<?php


/**
* File Model
*
* This is a controller class which performs few basic file handling function.
* It inherits the REST_Controller class to aquire the power to act as an REST API.
* 
* NOTE : This class only shows the logic of file handling methods called from API Controller.
*		 This should be rewritten properly to make it fully functional, so condiser it just for reference.
* 
*
* @package 		FileHandlerApp 
* @category 	Model
* @author 		Vijay Singh
* @link 		http://FileHandlerApp
*/
class File_model extends CI_Model {
	
	
	/**
	 * Constractor
	 */
	public function __construct () {

		//Class the Model construtor
		parent::__construct();

		$this->load->helper('file');

	}

	/**
	 * Read the content from the file.
	 * @param int $id - id of the file.
	 * @return string $content
	 */
	public function getFile($id) {

		/**
		 * Read the content of the file.
		 */

		$string = read_file('./path/to/'.$id.'.txt');

	}

	/**
	 * Update the content in the file.
	 * @param int $id - id of the file.
	 * @param string $message
	 */
	public function updateFile($id, $content) {

		/**
		 * Update the content in the file.
		 */
		
		if ( ! write_file('./path/to/'.$id.'.txt', $content)) {

		     return 'Unable to write the file';
		} else {

		     return 'File written!';
		}

	}

	/**
	 * Delete the file,
	 * @param int $id - id of the file.
	 * @return string $message
	 */
	public function deleteFile($id) {

		/**
		 * Delete the file of the name id.
		 */
		
		delete_file('./path/to/directory/'.id.'.txt');

	}


	/**
	 * Create the file.
	 * @param int $id - id of the file.
	 * @return string $message
	 */
	public function createFile($id) {

		/**
		 * Delete the file of the name id.
		 * @TODO : rewrite this function
		 */
		
		write_file('./path/to/'.id.'.txt', '', 'r+');

	}


}