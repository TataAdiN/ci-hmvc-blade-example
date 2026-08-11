<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Blade $blade CI3 Blade Extensions
 */
class Landing extends MY_Controller
{

	public function index()
	{
		$this->blade->render('index');
	}
}
