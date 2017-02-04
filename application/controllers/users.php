<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function user($id)
	{
		$this->load->model('User');
		$view_data = array("user"=>$this->User->get_user_by_id($id));
		$this->load->view('profile', $view_data);
	}
}