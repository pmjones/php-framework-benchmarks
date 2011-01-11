<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index()
	{
		    $this->request->response = View::factory('welcome/index'); // This will load views/hello/world.php
	}

} // End Welcome
