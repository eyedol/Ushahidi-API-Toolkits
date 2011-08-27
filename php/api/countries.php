<?php
/**
 * This class encapsulates the countries API methods. 
 *
 * @author Henry Addo <henry@addhen.org>
 * @version 1.0
 * @package php.api
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */
require_once('payload.php');

class Countries extends Payload
{
    /**
     * The countries received from the server
     * 
     * @access private
     * @var array
     */
    private $countries = array();

    public function __construct()
    {
    }

    /**
     * Set the countries received from the server
     * 
     * @access public
     *
     * @param array the map categories from the server.
     */
    public function set_items($countries)
    {
        $this->countries = $countries;
    }

    /**
     * Get the map countries received from the server
     *
     * @access public
     *
     * @return map 
     */
    public function get_items()
    {
        return $this->countries;
    }
}
?>
