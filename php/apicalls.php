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
