<?php
defined('BASEPATH') || exit('No direct script access allowed');

require_once APPPATH . 'middlewares/Middleware.php';

class GuestMiddleware extends Middleware
{
    public function handle(array $params = [])
    {
        if ($this->ci->mAuth->check()) {
            redirect(base_url('admin'));
            exit;
        }
    }
}