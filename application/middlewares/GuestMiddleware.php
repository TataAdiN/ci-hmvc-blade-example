<?php
defined('BASEPATH') || exit('No direct script access allowed');

require_once APPPATH . 'middlewares/Middleware.php';

class GuestMiddleware extends Middleware
{
    public function handle(array $params = [])
    {
        if ($this->ci->mAuth->check()) {
            if ($this->ci->mAuth->level() == 1) {
                redirect(base_url('admin'));
            } else {
                redirect(base_url('user'));
            }
            exit;
        }
    }
}