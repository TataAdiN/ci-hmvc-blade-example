<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
	public function index()
	{
		$data['title'] = "Dasboard Admin";
		$data['type'] = 'admin';
		$this->blade->render('admin', $data);
	}
}
