<?php
/**
 * This handles the response retrieved from the server and passes it on to the 
 * calling classes 
 *
 * @author Henry Addo <henry@addhen.org>
 * @version 1.0
 * @package php.api
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

require_once('http_client.php');
class ApiCalls extends HttpClient{
    
    /**
	 * Response to be returned to the calling class
	 * @var $response
	 */
	private $response;
	
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
