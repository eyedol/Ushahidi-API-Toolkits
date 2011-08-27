<?php

/**
 * This class Implements all front end API methods for Categories. 
 * See { @link http://wiki.ushahidi.com/doku.php?id=ushahidi_api#get_methods Incidents methods }
 *
 * @author Henry Addo <henry@addhen.org>
 * @version 1.0
 * @package php.api.tasks
 */
require_once('apicalls.php');
require_once('api/categories.php');
class CategoriesTasks extends ApiCalls {

    
    /**
     * The default constructor
     *
     * @param string @url the ushahidi URL
     * @param bool $debug turn debug on or off
     * @param int timeout the time in miliseconds to timeout a connection
     */
    public function __construct($url,$debug,$timeout)
    {
        parent::__construct($url, $debug,$timeout);
    }

    /**
     * Gets all categories in the Ushahidi deployment
     *
     * @return object the details of all the categories retrieved.
     */
    public function get_all_categories()
    {
        return $this->_get_categories();

    }

    /**
     * Gets categories by category id.
     *
     * @param int $id the category id.
     *
     * @return object the details of the category fetched by id.
     */
    public function get_categories_by_id($id)
    {
        $variables = array(
            'by' => 'catid',
            'id' => $id
        );
        return $this->_get_categories($variables);

    }

    /**
     * Gets the categories in the Ushahidi deployment
     * @param array the different parameters to use to fetch category
     *
     * @return 
     */ 
    private function _get_categories($variables = array())
    {
        $get_data = array (
            '?task' => 'categories',
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
     * Parse JSON data received from the server.
     *
     * @access private
     * 
     * @param string json data 
     *
     * @return array
     */
    private function parse_json_data($json_data)
    {
        
        $categories = new Categories();
        
        if( !empty($json_data) ) 
        {
            $categories->set_domain($json_data->payload->domain);
            $categories->set_code($json_data->error->code);
            $categories->set_message($json_data->error->message);
            $categories->set_items($json_data->payload->categories);

        return $categories;
    }
}
?>
