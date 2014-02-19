<?php
/**
 * REST CONTROLLER CLASS
 * 
 * This class can be extended to create rest apis using codeigniter regular controllers.
 * REST Controller class extends the codeigniter CI_Controller in inherit the generic functionalites of 
 * codeigniter's core controller.
 *
 * @package			FileHandlerApp
 * @subpackage 		Libraries
 * @author 			Vijay Singh
 * @link 			http://FileHandlerApp
 * @version 		v1.0.0.1
 *
 */

if(!class_exists('REST_Controller')) {

	abstract class REST_Controller extends CI_Controller
	{
		/**
		 * Http Request Verbs 
		 * Http verbs can be GET, POST, PUT, DELETE
		 */
		protected $httpVerb = NULL;


		/**
		 * Elements of the http url.
		 * Example API/USER/1
		 * API, USER, 1 are elements.
		 */
		protected $httpUrlElements = NULL;


		/**
		 * Http Query - any thing after '?' 
		 * 
		 */
		protected $httpParameters = NULL;

		/**
		 * Http Response Code
		 * Example 200, 201, 404, 500
		 */
		protected $httpResponseCode = NULL;

		/**
		 * Http Response Codes
		 * Example 200, 201, 404, 500
		 */
		protected $httpResponseCodes = array(200,201,404,500);
		
		/**
		 * Http Reponse Formats
		 */
		protected $httpResponseFormats = array(
											'json' => 'application/json',
											'html' => 'text/html'
											);

		/**
		 * Handle to set the required response for the request.
		 */
		protected $httpResponseFormat = NULL;

		/**
		 * Handle to set the required response content for the request.
		 */
		protected $httpResponseContent = NULL;


		/**
		 * Controller Name
		 * Name of the controller called in the request.
		 * Example API controller.
		 */
		protected $controllerName = NULL;

		/**
		 * Resource Name
		 * Name of the resource being called in the request.
		 * Example 'File' resource.
		 */
		protected $resourceName = NULL;


		/**
		 * Constructor of the REST_Controller Class.
		 * Populates $httpVerb, $httpUrlElements and $httpParameters.
		 * 
		 * Must be called in the controller classes extending this class.
		 *
		 */

		protected __constructor() {

			/**
			 * Calling the constructer of parent class - CI_Controllers
			 */
			parent::__construct();

			/**
			 * Load REST configuration
			 */
			$this->load->config('rest');

			/**
			 * Load third party format library
			 */
			$this->load->library('format');

			/**
			 * Get the type of http header recieved in the request.
			 * example : get, post ....
			 */
			$this->httpVerb = $this->input->server('REQUEST_METHOD');

			/**
			 * Get the elements or resources from the http url.
			 * Array of url resources.
			 */
			$this->httpUrlElements = explode('/', $this->input->server('PHP_PATH'));

			/**
			 * Parse the variables as part of query string.
			 * This method will populate $this->httpParameters - Array 
			 */
			$this->parseUrlParameters();

			/**
			 * Set the default reposense format. 
			 */
			$this->httpResponseFormat = 'json';

			/**
			 * Set the default reposense code. 
			 */
			$this->httpResponseFormat = 200;

			/**
			 * Finalize the resouce and verb in the reuqest to decide which method of the 
			 * controller to be called.
			 */
			$this->createControllerAndResouce();

			/**
			 * Check if the method exists in the controller class.
			 */
			if ( ! method_exists($this, $resourceName)) {

				$this->response(NULL, 404);
			}

			$this->resourceName();
		}

		/**
		 * Create the controller name and resouce name from the $this->httpUrlElements
		 * Sets controller name in $this->controllerName property.
		 * Sets resrouce name in the $this->resourceName property.
		 *
		 * @param NULL
		 *
		 * @return NULL
		 */
		protected function createControllerAndResouce() {

			/* Name of the controller in typical request in codeigniter app.*/
			$this->controllerName = ucfirst($this->httpUrlElements[1]) ;
			
			/**
			 * Name of the method in codeigniter app.
			 * There must be a method in the sub-class with this name.
			 */
			$this->resourceName = strtolower($$this->httpUrlElements[2]) 
									.'_'.strtolower($this->httpVerb);
			
		}

		/**
		 * Set the http response format if response has to be other than the default.
		 * Format type can be the part of the request.
		 *
		 * @param String $_responseFormat should be string and part of $httpResponseFormats Array
		 *
		 * @return Boolean False : When the requested format is not found in  $httpResponseFormats Array.
		 * @return Boolean True : Format is set.
		 */
		protected function setResponseFormat(String $_responseFormat) {
			
			if(in_array($_responseFormat, array_keys($this->httpResponseFormats) ) {
				$this->httpResponseFormat = $_responseFormat;
			} else {

				/* Invalid response format requested. */
				return false;
			}

		}


		/**
		 * Set the http response code if response has to be other than the default code.
		 * Format type can be the part of the request.
		 *
		 * @param String $_responseCode should be integer and part of $httpResponseCodes Array
		 *
		 * @return Boolean False : When the requested code is not found in  $httpResponseCodes Array.
		 * @return Boolean True : Code is set.
		 */
		protected function setResponseCode(String $_responseCode) {
			
			if(in_array($_responseCode, array_keys($this->httpResponseCodes) ) {
				$this->httpResponseCode = $_responseCode;
			} else {

				/* Invalid response code. */
				return false;
			}

		}


		/**
		 * Parse the variables/ params came with the request url and populate
		 * the $this->httpParameters property.
		 * This method also set the response format according to the contect type of the request.
		 *
		 * @param NULL
		 *
		 * @return NULL
		 */
		protected function parseUrlParameters() {

			$parameters = array();
 
	        /* Parse GET variables */
	        if (isset($_SERVER['QUERY_STRING'])) {
	            parse_str($_SERVER['QUERY_STRING'], $parameters);
	        }
	 
	        /* Parse PUT/POST variables */
	        $content = file_get_contents("php://input");
	        $contentType = false;
	        if(isset($_SERVER['CONTENT_TYPE'])) {
	            $contentType = $_SERVER['CONTENT_TYPE'];
	        }

	        switch($contentType) {
	            case "application/json":

	                $contentParams = json_decode($content);
	                if($contentParams) {
	                    foreach($contentParams as $pn => $pv) {
	                        $parameters[$pn] = $pv;
	                    }
	                }
	                /* Set reponse format. */
	                $this->setResponseFormat("json");
	                break;

	            case "application/x-www-form-urlencoded":

	                parse_str($content, $postvars);
	                foreach($postvars as $field => $value) {
	                    $parameters[$field] = $value;
	 
	                }
	                
	                /* Set reponse format. */
	                $this->setResponseFormat("html");
	                break;

	            default:
	                /* Do nothing as of now. */
	                break;
	        }
	        $this->httpParameters = $parameters;
		}


		/**
		 * Response sends response back to the client.
		 *
		 * Takes pure data and optionally a status code, then creates the response.
		 *
		 * @param array $data
		 *
		 * @param null|int $http_code
		 */
		public function response($content = null, $httpCode = null, $httpFormat = null) {
		
			/* Override content when custom content is passed as parameter. */
			if($content) {

				$this->httpResponseContent = $content;

			}
			
			/* Assign http resonse code. */
			if($httpCode) {

				$this->setResponseCode($httpCode);

			}

			/* Assign http resonse format. */
			if($httpFormat) {

				$this->setResponseFormat($httpFormat);
			}

			
			/* If content is NULL and code is not provided. */
			if ($this->httpResponseContent === NULL && $this->httpResponseCode === null) {

				$this->setResponseCode(404);

				$output = NULL;
			}

			/* If data is NULL but http code provided, keep the output empty */
			else if ($($this->httpResponseContent === NULL && is_numeric($this->httpResponseCode)) {
				$output = NULL;
			}

			/* Otherwise (if no data but 200 provided) */
			else {
				ob_start();
			}

			is_numeric($this->httpResponseCode) OR $this->httpResponseCode = 200;

			/* If the format method exists, call and return the output in that format. */
			if (method_exists($this->format, 'to_'.$this->httpResponseFormat)) {

				/* Set the correct format header */
				header('Content-Type: '.$this->httpResponseFormats[$this->httpResponseFormat]);

				$output = $this->format->factory(($this->httpResponseContent)->{'to_'.$this->httpResponseFormat}();
			}

			/* Format not supported, output directly */
			else
			{
				$output = $$this->httpResponseContent;
			}
		
			set_status_header($this->httpResponseCode);

		 	header('Content-Length: ' . strlen($output));
		

			exit($output);
		}




		/**
		 * Destructor function
		 */	
		public function __destruct()
		{
			/* Doing nothing right now.

		}


	}
}

?>