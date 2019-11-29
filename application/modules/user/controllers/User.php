<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

	public function index()
	{
		$data['title'] = "Selamat Datang User";
		$this->blade->render('user', $data);
	}
}
