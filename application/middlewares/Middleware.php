<?php
defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @property M_Auth $mAuth
 */
abstract class Middleware
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
        if (!isset($this->ci->session)) {
            $this->ci->load->library('session');
        }
        if (!isset($this->ci->mAuth)) {
            $this->ci->load->model('M_Auth', 'mAuth');
        }
    }

    /**
     * Handle how middleware work
     * @param array $params
     * @return void
     */
    abstract public function handle(array $params = []);
}