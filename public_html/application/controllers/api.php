<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* API
*
* This is a controller class which performs few basic file handling function.
* It inherits the REST_Controller class to aquire the power to act as an REST API.
*
* NOTE : This API Class is written for the reference purpose. This just shows how the 
*		 REST API can be implemented  in CodeIgniter Framework.
* 
* @package 		FileHandlerApp 
* @category 	Controller
* @author 		Vijay Singh
* @link 		http://FileHandlerApp
*/

require APPPATH.'/libraries/REST_Controller.php';


class Api extends REST_Controller
{

	public function __contruct() {
		parent::__contruct();

	}

	/**
	 * Get content from the file. 
	 * Get Request Param : id - id of the file.
	 * 
	 */
	function file_get() {
        if(!$this->get('id')) {

         	$this->response(NULL, 400);
        }
        
        $this->load->model('file_model');

        $file = $this->file_model->getFile( $this->get('id') );
     

     	if($file['content']) {

            $this->response($file['content'], 200); // 200 being the HTTP response code
        
        } else {
        
            $this->response('File not found', 404);
        }
    }


	/**
	 * Update content in the file. 
	 * Get Request Param : id - id of the file.
	 * Post Request Param : content - data to be written.
	 * 
	 */
	function file_post()
    {
        
        $message = $this->file_model->updateFile( $this->get('id'), $this->post('data') );
   		
   		
    	$this->response($message, 201); // 200 being the HTTP response code
    }

    /**
     * Create new file with the same of id.
     * Get Request Param : id - id of the file.
     *
     */
    function file_put() {

    	$message =  $this->file_model->createFile( $this->get('id'));

    	$this->response($message, 201); // 200 being the HTTP response code	
    }

    /**
     * Delete file of the name id.
     * Get Request Param : id - id of the file.
     *
     */
    function file_delete() {

    	$this->file_model->deleteFile( $this->get('id'));

    	$message = 'Deleted the file`';

    	$this->response($message, 201); // 200 being the HTTP response code	
    }


}