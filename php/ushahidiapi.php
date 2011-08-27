<?php
/**
 * This class Encapsulates the various tasks as implemented by the Ushahidi deployment.
 *
 * @author Henry Addo <henry@addhen.org>
 * @version 1.0
 * @package php
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

function __autoload($class_name) {
    include 'api/tasks/'.$class_name . '.php';
}

class UshahidiApi {

    /**
     * The Ushahidi URL 
     *
     *@access private
     *@var string
     */
    private $url;

    /**
     * Turn debugging on
     *
     * @access private
     * @var bool
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
     * @param string $url the ushahidi deployment URL
     * @param bool $debug to turn on debugging on or off
     * @param int $timeout in miliseconds to timeout a connection
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
     * @return object the map api keys api object
     */
    public function map_api_keys_tasks() 
    {
        return new MapApiKeysTasks($this->url,$this->debug,$this->timeout);
    }

    /**
     * Make Categories Tasks object available
     *
     * @return object the categories tasks object
     */
    public function categories_tasks() 
    {
        return new CategoriesTasks($this->url,$this->debug,$this->timeout);
    }
    
    /**
     * Make Countries Tasks object available
     *
     * @return object the countries tasks object
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
    
    /**
     * Make Incident Tasks object available
     * 
     * @return object the incident tasks object.
     */
    public function incidents_tasks()
    {
        return new IncidentsTask($this->url,$this->debug,$this->timeout);
    }

}

?>
