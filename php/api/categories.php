<?php
/**
 * Categories api call
 */
require_once('payload.php');

class Categories extends Payload
{
    /**
     * The categories received from the server
     * 
     * @access private
     * @var array
     */
    private $categories = array();

    public function __construct()
    {
    }

    /**
     * Set the categories received from the server
     * 
     * @access public
     *
     * @param array the map categories from the server.
     */
    public function set_items($categories)
    {
        $this->categories = $categories;
    }

    /**
     * Get the map categories received from the server
     *
     * @access public
     *
     * @return map 
     */
    public function get_items()
    {
        return $this->categories;
    }
    
}
?>
