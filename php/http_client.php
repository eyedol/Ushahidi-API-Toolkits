<?php
/**
 * HTTP client Implementation based on php-curl
 *
 * @author Henry Addo <henry@addhen.org>
 * @version 1.0
 * @package php
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

class HttpClient {
    
    /**
     * Curl handler
     *
     * @access private
     * @var resource
     */
    private $ch;
    /**
     * Ability to turn debugging info for useful info when 
     * debugging
     *
     * @access private
     * @var string
     */
    private $debug;
    
    /**
     * Holds error messages if error occurs
     *
     * @access private
     * @var string
     */
    private $error_msg;

    /**
     * The Ushahidi URL
     *
     * @access private
     * @var string
     */
    private $url;

    /**
     * Timeout to do a request that is taking forever.
     *
     * @access private
     * @var int
     */
    private $timeout;
    
    public function __construct($url, $debug,$timeout)
    {
        $this->debug = $debug;
        $this->url = $url;
        $this->timeout = $timeout;
        $this->init_curl();
    }    
    
    /**
     * Initialize a curl session
     *
     * @access private
     */
    private function init_curl()
    {
        //initial curl handle
        $this->ch = curl_init();        
        // set curl's various options        
        
        //set error in case http return code bigger than 300
        curl_setopt($this->ch, CURLOPT_FAILONERROR, TRUE);		
        
        // allow redirects just incase a user wants that
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, TRUE);		
        
        // use gzip if possible for performance
		curl_setopt($this->ch,CURLOPT_ENCODING , 'gzip, deflate');
        
        // do not veryfy ssl for 
		// as well for being able to access pages with non valid cert
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
    }    
    
    /**
     * Set username and password basic http authentication
     *
     * @access private
     * @param string username
     * @param string password
     */
    protected function set_credentials($username,$password)
    {
        curl_setopt($this->ch,CURLOPT_USERPWD,"$username:$password");
    }    
    
    /**
     * Set client's user agent
     *
     * @access private
     * @param string useragent
     */
    private function set_useragent($useragent)
    {
        curl_setopt($this->ch, CURLOPT_USERAGENT, $useragent);
    }    
    
    /**
     * Set to receive output headers in all output functions
     *
	 * @access private
     * @param boolean true to include all response headers with output,
     *  false otherwise
	 */
	private function include_response_headers($value)
	{
		curl_setopt($this->ch, CURLOPT_HEADER, $value);
	}
    
    /**
     * Set proxy to use for each curl request
     *
     * @access public
	 * @param string proxy
	 */
	private function set_proxy($proxy)
	{
		curl_setopt($this->ch, CURLOPT_PROXY, $proxy);
    }    
    
    /**
     * Get http response code
     *
	 * @access private
	 * @return int
	 */
	private function get_http_response_code()
	{
		return curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
    }    
    
    /**
     * Set error message that might show up
     *
     * @access protected
     * @param string error_msg - The error message
     */
    private function set_error_msg($error_msg)
    {
        $this->error_msg = $error_msg;
    }	
    
    /**
     * Return last error message and error number
     *
     * @access 	private 
     * @return string - Error msg
	 */
	public function get_error_msg()
	{
		$err = "Error number: " .curl_errno($this->ch) ."\n";
        $err .= "Error message: " .curl_error($this->ch)."\n";
        $this->error_msg .= $err;

        return $this->error_msg;
	}
	
	/**
	 * Close curl session and free resource
	 * Usually no need to call this function directly
     * in case you do you have to call init() to recreate curl
     *
	 * @access private
	 */
	private function close()
	{
		//close curl session and free up resources
		curl_close($this->ch);
    }

    /**
     * Setup's ip interface to curl and timeouts for curl. Shows all debugging and error info
     * if there are any
     *
     * @access private
     *  
     * @param string qry_string
     * @param string ip address to bind (default null)
     * @param int timeout in sec for complete curl operation (default 10)
     *
     */
    private function prepare_curl($qry_string, $ip=null)
    {

        //set various curl options first

        $url = empty($qry_string) ? $this->url : $this->url.$qry_string;
        
		curl_setopt($this->ch, CURLOPT_URL,$url);

		// return into a variable rather than displaying it
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER,TRUE);

		//bind to specific ip address if it is sent trough arguments
		if($ip)
		{
			if($this->debug)
			{
                $this->set_error_msg("Binding to ip $ip\n");
                print $this->get_error_msg();
			}
			curl_setopt($this->ch,CURLOPT_INTERFACE,$ip);
		}

		//set curl function timeout to $timeout
		curl_setopt($this->ch, CURLOPT_TIMEOUT, $this->timeout);


    }

    /**
     * Set GET data for curl
     *
     * @access private
     *
     * @param mixed get data assoc array
     *
     * @return string 
     */
    private function set_get_data($get_data=array())
    {
        //generate get string
		$get_array = array();
        $get_string_array = array();

		if(!is_array($get_data))
		{
			return false;
        }		
        
        foreach($get_data as $key=>$value)
		{
			$get_array[$key] = $value;
			$get_string_array[] = urlencode($key)."=".urlencode($value);
        }

        return implode("&",$get_string_array);

    }

    /**
     * Set Curl to do both post and multi-part data.
     *
     * @access private
     *
     * @param mixed post data assoc array
     */
    private function set_post_data($post_data,$file_field_array=array())
    {
        //set method to post
        curl_setopt($this->ch, CURLOPT_POST, true);		
        // disable Expect header
        
        // hack to make it working
		$headers = array("Expect: ");
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);	
    
        // initialize result post array
        $result_post = array();		
        
        //generate post string
		$post_array = array();
        $post_string_array = array();

		if(!is_array($post_data))
		{
			return false;
        }		
        
        foreach($post_data as $key=>$value)
		{
			$post_array[$key] = $value;
			$post_string_array[] = urlencode($key)."=".urlencode($value);
        }		
        $post_string = implode("&",$post_string_array);
        
        if($this->debug)
		{
            $this->set_error_msg("Post String: $post_string\n");

            //print error msg
            print $this->get_error_msg();
        }		
        
        // set post string
		// set multipart form data - file array field-value pairs
		if(!empty($file_field_array))
		{
			foreach($file_field_array as $var_name => $var_value)
			{
                if(strpos(PHP_OS, "WIN") !== false) $var_value = str_replace("/",
                    "\\", $var_value); // win hack
				$file_field_array[$var_name] = "@".$var_value;
            }

            $result_post = array_merge($post_array, $file_field_array);
        }		
        
        // set post data
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post_string);
        
    }

	/**
	 * fetch data from target URL	 
     * return data returned from url or false if error occured
     *
     * @access proctected
     *
	 * @param string getdata - The query data to pass to the url	 
	 * @param string ip address to bind (default null)
	 * @param int timeout in sec for complete curl operation (default 5)
	 * @return string data
	 */
	protected function fetch_url($get_data=array(),$ip=null)
    {
        $qry_string = $this->set_get_data($get_data);
        $this->prepare_curl($qry_string,$ip,$this->timeout);
        
		//set method to get
		curl_setopt($this->ch, CURLOPT_HTTPGET,true);

		//and finally send curl request
		$result = curl_exec($this->ch);

		if(curl_errno($this->ch))
		{
			if($this->debug)
			{
				print $this->get_error_msg();
			}

			return false;
		}
		else
		{
			return $result;
		}
	}
    
    /**
	 * Send multipart post data to the target URL or just a post
	 * return data returned from url or false if error occured
     * 
     * @access private
     * 
     * @param string url
     * @param array assoc post data array ie. 	 
     * @param array assoc $file_field_array
	 * @param string ip address to bind (default null)
	 * @param int timeout in sec for complete curl operation (default 30 sec)
     * 
     * @return string data
	 */
    protected function send_multipart_or_post_data($url, $postdata, 
        $file_field_array=array(), $ip=null)
	{
        
        $this->prepare_curl($url,$ip,$timeout); 
                
        $this->generate_post_data($postdata,$file_field_array);                
        
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $result_post);

        //and finally send curl request
		$result = curl_exec($this->ch);		if(curl_errno($this->ch))
		{
			if($this->debug)
			{
                print $this->get_error_msg();
            }
            return false;
		}
		else
		{
			return $result;
		}
    }
}
?>
