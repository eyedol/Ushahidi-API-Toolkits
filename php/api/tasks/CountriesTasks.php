<?php

require_once('apicalls.php');
require_once('api/countries.php');
class CountriesTasks extends ApiCalls {

    
    /**
     * The default constructor
     *
     * @param url - The ushahidi url
     */
    public function __construct($url,$debug,$timeout)
    {
        parent::__construct($url, $debug,$timeout);
    }

    /**
     * Gets all countries in the Ushahidi deployment
     *
     * @return object
     */
    public function get_all_countries()
    {
        return $this->_get_countries();

    }
    
    /**
     * Get countries by ISO
     *
     * @param int - The country ISO
     *
     * @return object
     */
    public function get_countries_by_iso($iso)
    {
        $variables = array(
            'by' => 'countryiso',
            'iso' => $iso
        );
        return $this->_get_countries($variables);

    }

    /**
     * Gets countries by country name
     *
     * @param int - The country name
     *
     * @return object
     */
    public function get_countries_by_name($name)
    {
        $variables = array(
            'by' => 'countryname',
            'name' => $name
        );
        return $this->_get_countries($variables);

    }

    /**
     * Gets countries by country id
     *
     * @param int - The country id
     *
     * @return object
     */
    public function get_countries_by_id($id)
    {
        $variables = array(
            'by' => 'countryid',
            'id' => $id
        );
        return $this->_get_countries($variables);

    }


    /**
     * Gets the countries in
     * the Ushahidi deployment
     *
     * @param array other variables
     * @param int id - the category ID
     */ 
    private function _get_countries($variables = array())
    {
        $get_data = array (
            '?task' => 'countries',
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
        
        $countries = new Countries();
        
        if( !empty($json_data) ) 
        {
            if ( ($json_data->error->code == 0) )
            {
                $countries->set_domain($json_data->payload->domain);
                $countries->set_code($json_data->error->code);
                $countries->set_message($json_data->error->message);
                $countries->set_items($json_data->payload->countries);
            
            } else {
                $countries->set_code($json_data->error->code);
                $countries->set_message($json_data->error->message);
            }

        }
        
        return $countries;
    }
}
?>
