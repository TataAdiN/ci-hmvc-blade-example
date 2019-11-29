<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VIP extends MY_Controller
{

	public function index()
	{
		$data['title'] = "Dasboard VIP";
		$data['type'] = 'vip';
		$this->blade->render('vip', $data);
	}
}
