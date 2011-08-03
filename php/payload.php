<?php

/**
 * An abstract class that is implemented by all the api call
 */
abstract class Payload {

    /**
     * The domain from the api call
     * 
     * @access private
     * @var string domain
     */
    private $domain;

    /**
     * The id returned from the server
     * 
     * @access private
     * @var int id
     */
    private $id;

    /**
     * The map api key returned from the server
     *
     * @access private
     * @var string
     */
    private $apikey;

    /**
     * The code returned from the server
     * 
     * @access private
     * @var int
     */
    private $code;

    /**
     * The message received from the server
     *
     * @access private
     * @var string
     */
    private $message;
 
    public function __construct()
    {
    }

    /**
     * Set the domain received from the server
     * 
     * @access public
     *
     * @param string the domain from the server.
     */
    public function set_domain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Get the domain received from the server
     *
     * @access public
     *
     * @return string
     */
    public function get_domain()
    {
        return $this->domain;
    }
    
    /**
     * Set the code received from the server
     * 
     * @access public
     *
     * @param int the code from the server.
     */
    public function set_code($code)
    {
        $this->code = $code;
    }

    /**
     * Get the code received from the server
     *
     * @access public
     *
     * @return int
     */
    public function get_code()
    {
        return $this->code;
    }

    /**
     * Set the message received from the server
     * 
     * @access public
     *
     * @param string the message from the server.
     */
    public function set_message($message)
    {
        $this->message = $message;
    }

    /**
     * Get the message received from the server
     *
     * @access public
     *
     * @return string
     */
    public function get_message()
    {
        return $this->message;
    }

    /**
     * Abstract method to be implemented by 
     * all subclasses so they set the actual data 
     * retrieved from the server via the api.
     *
     * @access public
     * @param array the items retrieved from the server
     */
    abstract public function set_items($items);
    
    /**
     * Abstract method to be implemented by all 
     * subclasses so they get the actual data
     * received from the server via the api call.
     *
     * @return array - the items
     */
    abstract public function get_items();
}
?>
