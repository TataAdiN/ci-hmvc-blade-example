<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

class MY_Controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_hmvc_fixes();
    }

    public function _hmvc_fixes(): void
    {
        $this->load->library("form_validation");
        $this->form_validation->CI = &$this;
    }

    /**
     * @param mixed $middlewares
     */
    protected function middleware(mixed $middlewares): void
    {
        $middlewares = is_array($middlewares) ? $middlewares : func_get_args();

        foreach ($middlewares as $middleware) {
            $params = [];

            if (strpos($middleware, ":") !== false) {
                [$middleware, $paramString] = explode(":", $middleware, 2);
                $params = explode(",", $paramString);
            }

            $middlewareName = ucfirst($middleware) . "Middleware";
            $filepath = APPPATH . "middlewares/" . $middlewareName . ".php";

            if (file_exists($filepath)) {
                require_once $filepath;

                $instance = new $middlewareName();
                $instance->handle($params);
            } else {
                show_error(
                    "Error: Middleware '{$middlewareName}' not found",
                    500,
                );
            }
        }
    }
}
