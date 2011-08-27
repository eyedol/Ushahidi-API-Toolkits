<?php
/**
 * This class encapsulates the mapapikeys API methods. 
 *
 * @author Henry Addo <henry@addhen.org>
 * @version 1.0
 * @package php.api
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

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
