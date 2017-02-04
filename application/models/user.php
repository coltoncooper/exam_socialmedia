<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function validate_date($date)
	{
		if (! preg_match("/^[1-9][0-9]{3}-[0-1][0-9]-[0-3][0-9]$/", $date)){
			return 'Invalid date format. Please enter yyyy-mm-dd (ex. 2015-12-29)';
		}

		$dob_obj = date_create_from_format('Y-m-d', $date);

		if ($dob_obj->getTimestamp()>strtotime("now")) {
      	return "Please pick a valid birthday";
    	}
    
		// $dob_obj = date_create_from_format('Y-m-d', $date);
		// $now = date('Y-m-d');

		// if ($now < $dob_obj){
		// 	return 'Date of Birth cannot be future date';
		// }
		return null;
	}

	public function validate($user)
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("name","Name", "trim|required");
		$this->form_validation->set_rules("alias","Alias", "trim|required");
		$this->form_validation->set_rules("email","Email", "trim|valid_email|is_unique[users.email]|required");
		$this->form_validation->set_rules("password","Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("password_confirm","Confirm Password", "required|matches[password]");
		$this->form_validation->set_rules("dob", 'Date of Birth', "required");
	
		if($this->form_validation->run())
		{
			$dob_validation = $this->validate_date($user['dob']);
			if($dob_validation)
			{
				return $dob_validation;
			}
			else
			{
				return 'valid';
			}
		}
		else
		{
			return validation_errors();
		}	
	}
	
	public function add_user($user)
	{
		$value = array($user['name'], $user['alias'], $user['email'], md5($user['password']), $user['dob']);
		$query = "INSERT INTO users (name, alias, email, password, dob, created_at, updated_at) VALUES (?,?,?,?,?, NOW(), NOW())";
		return $this->db->query($query, $value);
	}

	public function get_user($email)
	{
		$query ="SELECT * FROM users WHERE email=?";
		$value = array($email);
		return $this->db->query($query, $value)->row_array();
	}

	public function user($id)
	{
		$this->load->view('profile');
	}

	public function get_user_by_id($id)
	{
		$value = array($id);
		$query="SELECT * FROM users WHERE id=?";
		return $this->db->query($query, $value)->row_array();
	}
}