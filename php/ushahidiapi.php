<?php
/**
 * Api
 *
 * Base class for all API library implementations.
 * 
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Henry Addo <henry@addhen.org>
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

function __autoload($class_name) {
    include 'api/tasks/'.$class_name . '.php';
}

/**
 * Encapsulates the various tasks
 */
class UshahidiApi {

    /**
     * The Ushahidi url 
     *
     *@access private
     *@var string
     */
    private $url;

    /**
     * Turn debugging on
     *
     * @access private
     * @var boolean
     */
    private $debug;

    /**
     * The time to timeout when server is taking forever to respond
     *
     * @access private
     * @var int
     */
    private $timeout;

    /**
     * Default constructor
     *
     * @param string url
     * @param boolean debug
     * @param int timeout
     */
    public function __construct($url,$debug=false,$timeout=10)
    {
        $this->url = $url;
        $this->debug = $debug;
        $this->timeout = $timeout;
    }

    /**
     * Make MapApiKeysTasks object available
     *
     * @return object - The map api keys api object
     */
    public function map_api_keys_tasks() 
    {
        return new MapApiKeysTasks($this->url,$this->debug,$this->timeout);
    }

    /**
     * Make Categories Tasks object available
     *
     * @return object - The categories tasks object
     */
    public function categories_tasks() 
    {
        return new CategoriesTasks($this->url,$this->debug,$this->timeout);
    }
    
    /**
     * Make Countries Tasks object available
     *
     * @return object - The countries tasks object
     */
    public function countries_tasks() 
    {
        return new CountriesTasks($this->url,$this->debug,$this->timeout);
    }

    /**
     * Make Location Tasks object available
     *
     * @return object - The location tasks object
     */
    public function locations_tasks() 
    {
        return new LocationsTasks($this->url,$this->debug,$this->timeout);
    }

    public function incidents_tasks()
    {
        return new IncidentsTask($this->url,$this->debug,$this->timeout);
    }

}

?>
