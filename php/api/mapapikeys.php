<?php
require_once('payload.php');
class MapApiKeys extends Payload {
    
    /**
     * The services received from the server
     * 
     * @access private
     * @var array
     */
    private $services = array();

    public function __construct()
    {
    }

    /**
     * Set the map services received from the server
     * 
     * @access public
     *
     * @param array the map services from the server.
     */
    public function set_items($services)
    {
        $this->services = $services;
    }

    /**
     * Get the map services received from the server
     *
     * @access public
     *
     * @return map 
     */
    public function get_items()
    {
        return $this->services;
    }

}
?>
