<?php
/**
 * This class encapsulates the incidents API methods. 
 *
 * @author Henry Addo <henry@addhen.org>
 * @version 1.0
 * @package php.api
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */
require_once('payload.php');

class Incidents extends Payload
{
    /**
     * The locations received from the server
     * 
     * @access private
     * @var array
     */
    private $incidents = array();

    public function __construct()
    {
    }

    /**
     * Set the incidents received from the server
     * @param array the incidents from the server.
     */
    public function set_items($incidents)
    {
        $this->incidents = $incidents;
    }

    /**
     * Get the incidents
     * @return map 
     */
    public function get_items()
    {
        return $this->incidents;
    }
    
}
?>
