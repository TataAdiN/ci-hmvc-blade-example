<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Blade $blade
 * @property CI_Loader $load
 * @property M_Auth $mAuth
 */
class User extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_Auth", "mAuth");
		$this->middleware('auth');
	}

	public function index()
	{
		$data['title'] = "Selamat Datang User";
		$this->blade->render('user', $data);
	}
}
