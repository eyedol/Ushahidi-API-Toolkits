<?php
/**
 * This class Implements all front end API methods for Locations. 
 * See { @link http://wiki.ushahidi.com/doku.php?id=ushahidi_api#get_methods Incidents methods }
 *
 * @author Henry Addo <henry@addhen.org>
 * @version 1.0
 * @package php
 */

require_once('apicalls.php');
require_once('api/locations.php');

class LocationsTasks extends ApiCalls {

    
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
     * Gets all locations in the Ushahidi deployment
     *
     * @return object
     */
    public function get_all_locations()
    {
        return $this->_get_locations();

    }
    
    /**
     * Gets locations by country id
     *
     * @param int $country_id the country id
     *
     * @return object
     */
    public function get_locations_by_country_id($country_id)
    {
        $params = array(
            'by' => 'country',
            'id' => $country_id
        );
        return $this->_get_locations($params);

    }

    /**
     * Gets locations by location id
     *
     * @param int $loc_id the location id
     *
     * @return object
     */
    public function get_locations_by_id($loc_id)
    {
        $params = array(
            'by' => 'locid',
            'id' => $loc_id
        );
        return $this->_get_locations($params);

    }


    /**
     * Gets the locations in
     * the Ushahidi deployment
     *
     * @access private
     * @param array other variables
     * @param int id - the category ID
     */ 
    private function _get_locations($variables = array())
    {
        $get_data = array (
            '?task' => 'locations',
        );

        if ((sizeof($variables) > 0))
        {
            $get_data = array_merge($get_data, $variables);
        }
        
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
        
        $locations = new Locations();
        
        if( !empty($json_data) ) 
        {
            if ( ($json_data->error->code == 0) )
            {
                $locations->set_domain($json_data->payload->domain);
                $locations->set_code($json_data->error->code);
                $locations->set_message($json_data->error->message);
                $locations->set_items($json_data->payload->locations);
            
            } else {
                $locations->set_code($json_data->error->code);
                $locations->set_message($json_data->error->message);
            }

        }
        
        return $locations;
    }
}
?>
