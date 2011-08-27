<?php
/**
 * This class Implements all front end API methods for Incidents. 
 * See { @link http://wiki.ushahidi.com/doku.php?id=ushahidi_api#get_methods Incidents methods }
 *
 * @author Henry Addo <henry@addhen.org>
 * @version 1.0
 * @package php.api.tasks
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

require_once('apicalls.php');
require_once('api/incidents.php');

class IncidentsTasks extends ApiCalls {

    
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
     * Gets all incidents in the Ushahidi deployment
     * @param string $orderfield optional. The fields to order by 
     * (incidentid|locationid|incidentdate) - incidentid is the default
     * @param int $sort optional. Sort by(0|1) - 0 is Ascending, 1 is Decending; 0 is the default 
     * @param int $limit optional. The number of incidents to return.  
     * @return object
     */
    public function get_all_incidents($orderfield,$sort,$limit)
    {
        return $this->_get_incidents($param);

    }
    
    /**
     * Gets incidents by a category name
     * @param string $cat_name required. The category name
     * @param string $orderfield optional. The fields to order by 
     * (incidentid|locationid|incidentdate) - incidentid is the default
     * @param int $sort optional. Sort by(0|1) - 0 is Ascending, 1 is Decending; 0 is the default 
     * @param int $limit optional. The number of incidents to return.  
     *
     * @return object
     */
    public function get_incidents_by_category_name($cat_name,$orderfield,$sort,$limit)
    {
        $param = array(
            'by' => 'catname',
            'name' => $cat_name
        );
        return $this->_get_incidents($param);

    }


    /**
     * Gets incidents by category id
     * @param int $cat_id the category id
     * @param string $orderfield optional. The fields to order by 
     * (incidentid|locationid|incidentdate) - incidentid is the default
     * @param int $sort optional. Sort by(0|1) - 0 is Ascending, 1 is Decending; 0 is the default 
     * @param int $limit optional. The number of incidents to return.  
     * @return object
     */ 
    private function _get_incidents_by_category_id($cat_id,$orderfield,$sort,$limit)
    {
        $param = array (
            'by' => 'catid',
            'id' => $cat_id,
        );

        return $this->_get_incidents($param);
    }

    /**
     * Retrieves an incidents by a location id
     * @param int $loc_id the location id
     * @param string $orderfield optional. The fields to order by 
     * (incidentid|locationid|incidentdate) - incidentid is the default
     * @param int $sort optional. Sort by(0|1) - 0 is Ascending, 1 is Decending; 0 is the default 
     * @param int $limit optional. The number of incidents to return.  
     * @return object
     */
    public function _get_incidents_by_location_id($loc_id,$orderfield,$sort,$limit)
    {
        $param = array(
            'by' => 'locid',
            'id' => $loc_id
        );
        return $this->_get_incidents($param);
    }
    
    /**
     * Retrieves an incidents by a location name.
     * @param string $name the location name.
     * @param string $orderfield optional. The fields to order by 
     * (incidentid|locationid|incidentdate) - incidentid is the default
     * @param int $sort optional. Sort by(0|1) - 0 is Ascending, 1 is Decending; 0 is the default 
     * @param int $limit optional. The number of incidents to return.  
     * @return object the incident retrieved by location name.
     */
    public function _get_incidents_by_location_name($name,$orderfield,$sort,$limit)
    {
        $param = array(
            'by' => 'locname',
            'name' => $name
        );

        return $this->_get_incidents($param);
    }

    /**
     * Retrieves all incidents since a given incidents id.
     * @param int $since_id the incident id you want start from.
     * @param string $orderfield optional. The fields to order by 
     * (incidentid|locationid|incidentdate) - incidentid is the default
     * @param int $sort optional. Sort by(0|1) - 0 is Ascending, 1 is Decending; 0 is the default 
     * @param int $limit optional. The number of incidents to return.  
     *
     * @return object the incident retrieved by since id.
     */
    public function _get_incidents_by_since_id($since_id,$orderfield,$sort,$limit)
    {
        $param = array(
            'by' => 'sinceid',
            'id' => $since_id
        );

        return $this->_get_incidents($param);
    }

    /**
     * Retrieves incidents details by incident id. 
     * @param int $id the incident id. 
     * @param string $orderfield optional. The fields to order by 
     * (incidentid|locationid|incidentdate) - incidentid is the default
     * @param int $sort optional. Sort by(0|1) - 0 is Ascending, 1 is Decending; 0 is the default 
     * @param int $limit optional. The number of incidents to return.  
     * 
     * @return object the incident retrieved by id.
     */
    public function _get_incidents_by_id($id,$orderfield,$sort,$limit)
    {
        $param = array(
            'by' => 'incidentid',
            'id' => $id
        );

        return $this->_get_incidents($param);
    }

    /**
     * Retrieves all incidents by a latitude, longitude bounding box.
     * @param string - Required. The southwest corner of the bounding 
     * box( as string 'lat,lon')
     * @param string - Required. The northeast corner of the bounding 
     * box ( as string 'lat,lon')
     * $param int - Optional. The category id
     *
     * @return incident - An object that has all the incident api call
     */
    public function _get_incidents_by_bounds($southwest,$northeast,$cat_id="")
    {
        $param = array(
            'by' => 'bounds',
        );

        return $this->_get_incidents($param);
    }
    
    /**
     * Retrieves the number of incidents that have been approved.
     *
     * @return incident an object that has the number of incidents
     */
    public function _get_incidents_count()
    {
        $param = array(
            'task' => 'incidentcount',
        );
        
        // do a get request
        $json_data = json_decode($this->fetch_url($get_data));
        
        //parse the json data received from the server
        return $this->parse_json_data($json_data);

    }

    public function _get_geographic_midpoint()
    {
        $param = array(
            '?task' => 'geographicmidpoint',
        );

        // do a get request
        $json_data = json_decode($this->fetch_url($get_data));
        
        //parse the json data received from the server
        return $this->parse_json_data($json_data);

    }

    /**
     * Retrieves the number of incident/reports in each category
     *
     * @return incident an object that has the number of incidents in each category
     */
    public function _get_catcount()
    {
        $param = array(
            'by' => 'catcount',
        );

        return $this->_get_incidents($param);

    }

    /**
     * Get incidents in an ushahidi deployment
     *
     * @param array - The parameters to use to fetch incidents
     *
     * @return string - A JSON decoded string having details for the fetched incidents 
     */
    private function _get_incidents($param)
    {

        $get_data = array (
            '?task' => 'incidents',
        );

        if ((sizeof($param) > 0))
        {
            $get_data = array_merge($get_data, $param);
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
        
        $incidents = new Incidents();
        
        if( !empty($json_data) ) 
        {
            if ( ($json_data->error->code == 0) )
            {
                $incidents->set_domain($json_data->payload->domain);
                $incidents->set_code($json_data->error->code);
                $incidents->set_message($json_data->error->message);
                $incidents->set_items($json_data->payload->locations);
            
            } else {
                $incidents->set_code($json_data->error->code);
                $incidents->set_message($json_data->error->message);
            }

        }
        
        return $incidents;
    }
}
?>
