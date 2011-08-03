<?php
require_once('http_client.php');
class ApiCalls extends HttpClient{
    
    /**
	 * Response to be returned to the calling controller
	 * @var string
	 */
	private $response;
	
	/**
	 * API library object to handle the requested task
	 * @var Api_Object
	 */
	private $api;
			
	/**
	 * API request parameters
	 * @var array
	 */
	private $api_parameters;
    
    public function __construct($url,$debug,$timeout)
    {
        parent::__construct($url,$debug,$timeout);

	}

	/**
	 * Runs the API service
	 */
	public function run_api_call()
	{
		// Check the request is allowed
		if ($this->_is_api_request_allowed())
		{
			// Route the API task
			$this->_route_api_task();
		}
		else
		{
			// Set the response to "ACCESS DENIED"
			$this->set_response($this->get_error_msg(006));

			// Terminate execution
            return;     

		}
	}
	
	    
	/**
	 * Sets the response data
	 *
	 * @param mixed $response_data
	 */
	public function set_response($response_data)
    {
		$this->response = (is_array($response_data))
			? json_encode($response_data)
			: $response_data;
	}
    
	/**
	 * Gets the response data
	 *
	 * @return string The response to the API request
	 */
	public function get_response()
	{
		return $this->response;
	}    
        
}
?>
