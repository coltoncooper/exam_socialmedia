<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->view('main');
	}

	public function register()
	{
		$this->load->model('User');
		$result = $this->User->validate($this->input->post());
		if($result == 'valid')
		{
			$this->User->add_user($this->input->post());
			$this->session->set_flashdata('register_message', "You have created your account, please login!");
			redirect('/main');
		}
		else
		{
			$this->session->set_flashdata('register_message', $result);
			redirect('/main');
		}
	}

	public function login()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $this->load->model('User');
        $user = $this->User->get_user($email);
        if($user && $user['password'] == $password)
        {
            $view_data = array(
               'id' => $user['id'],
               'email' => $user['email'],
               'name' => $user['name'],
               'alias' => $user['alias'],
               'is_logged_in' => true,
               'dob' => $user['dob']
            );
            $this->session->set_userdata($view_data);
            redirect('/friends'); 
        }
        else
        {
            $this->session->set_flashdata("login_message", "Invalid email or password!");
            redirect("/");
        }
    }

    public function logout()
	 {
	   $this->session->unset_userdata('is_logged_in');
	   $this->session->sess_destroy();
	   redirect('/', 'refresh');
	 }
}

//end of main controller