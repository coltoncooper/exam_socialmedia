<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friends extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function index()
	{
		if(isset($this->session->userdata['is_logged_in'])&& $this->session->userdata['is_logged_in'] == true)
		{
			$this->load->model('Friend');
        	$view_data=array("friends"=>$this->Friend->get_friends($this->session->userdata['email']), "strangers"=>$this->Friend->get_strangers($this->session->userdata['email']));
        	$this->load->view('friends', $view_data);
		}
	  	else
	  	{
	  		redirect('/');
	  	}
	}

	public function add($id)
	{
		$this->load->model('Friend');
		$this->Friend->add_friend($this->session->userdata['id'], $id);
		$this->Friend->add_friend($id, $this->session->userdata['id']);
		redirect('/friends');	
	}

	public function remove($id)
	{
		$this->load->model('Friend');
		$this->Friend->remove_friend($this->session->userdata['id'], $id);
		$this->Friend->remove_friend($id, $this->session->userdata['id']);
		redirect('/friends');
	}
}