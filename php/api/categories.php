<?php
/**
 * This class encapsulates the categories API methods. 
 *
 * @author Henry Addo <henry@addhen.org>
 * @version 1.0
 * @package php.api
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
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
