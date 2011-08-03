<?php
/**
 * Locations api call
 */
require_once('payload.php');

class Locations extends Payload
{
    /**
     * The locations received from the server
     * 
     * @access private
     * @var array
     */
    private $locations = array();

    public function __construct()
    {
    }

    /**
     * Set the locations received from the server
     * 
     * @access public
     *
     * @param array the map categories from the server.
     */
    public function set_items($locations)
    {
        $this->locations = $locations;
    }

    /**
     * Get the map locations received from the server
     *
     * @access public
     *
     * @return map 
     */
    public function get_items()
    {
        return $this->locations;
    }
    
}
?>
