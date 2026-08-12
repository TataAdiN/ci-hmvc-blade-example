<?php
defined('BASEPATH') || exit('No direct script access allowed');

require_once APPPATH . 'middlewares/Middleware.php';

class AuthMiddleware extends Middleware
{
    public function handle(array $params = [])
    {
        if ($this->ci->mAuth->guest()) {
            redirect(base_url());
            //exit;
        }
        if (in_array('admin', $params)) {
            if ($this->ci->mAuth->level() !== 'admin') {
                show_error('Akses Ditolak. Anda bukan Administrator.', 403);
            }
        }
    }
}