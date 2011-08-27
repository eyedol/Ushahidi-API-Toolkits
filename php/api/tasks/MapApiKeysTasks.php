<?php
/**
 * This class Implements all front end API methods for Map API keys. 
 * See { @link http://wiki.ushahidi.com/doku.php?id=ushahidi_api#get_methods Incidents methods }
 *
 * @author Henry Addo <henry@addhen.org>
 * @version 1.0
 * @package php.api.tasks
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

require_once('apicalls.php');
require_once('api/mapapikeys.php');

class MapApiKeysTasks extends ApiCalls {

    
    /**
     * The default constructor
     *
     * @param string $url the ushahidi url
     * @param bool $debug turn debug on or off
     * @param int $timeout the time in miliseconds to timeout a connection
     */
    public function __construct($url,$debug,$timeout)
    {
        parent::__construct($url, $debug,$timeout);
    }

    /**
     * Gets Google's map api key
     *
     * @return object
     */
    public function get_google_api_key()
    {
        return $this->_get_api_key('google');

    }

    /**
     * Gets Yahoo's map api key
     *
     * @return object
     */
    public function get_yahoo_api_key()
    {
        return $this->_get_api_key('yahoo');

    }

    /**
     * Gets Microsoft's map api key
     *
     * @return object
     */
    public function get_microsoft_api_key()
    {
        return $this->_get_api_key('microsoft');
    }

    
    /**
     * Gets the current map's service api key being used by
     * the Ushahidi deployment
     *
     * @param string by
     */ 
    private function _get_api_key($by)
    {
        
        $get_data = array (
            '?task' => 'apikeys',
            'by' => $by,
        );

        // do a get request
        $json_data = json_decode($this->fetch_url($get_data));
        
        //parse the json data received from the server
        return $this->parse_json_data($json_data);
    }

    /**
     * Parse JSON data received from the server
     *
     * @access private
     * 
     * @param string json data 
     *
     * @return array
     */
    private function parse_json_data($json_data)
    {
        $map_api_keys = new MapApiKeys();

        if( !empty($json_data) ) 
        {
            $map_api_keys->set_domain($json_data->payload->domain);
            $map_api_keys->set_code($json_data->error->code);
            $map_api_keys->set_message($json_data->error->message);
            $map_api_keys->set_items($json_data->payload->services);
        }
        
        return $map_api_keys;
    }

}
?>
