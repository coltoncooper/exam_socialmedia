<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friend extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	function get_friends($email)
	{
		$query ="SELECT * FROM users WHERE id in (SELECT friend_id FROM friends WHERE user_id = (SELECT id FROM users WHERE email =?))";
		$value = array($email);
		return $this->db->query($query, $value)->result_array();
	}

	function get_strangers($email)
	{
		$query = "SELECT * FROM users WHERE email != ? AND id NOT in (SELECT friend_id FROM friends WHERE user_id = (SELECT id FROM users WHERE email = ?))";
		$value = array($email, $email);
		return $this->db->query($query, $value)->result_array();

	}

	function add_friend($user_id, $friend_id)
	{
		$query = "INSERT INTO friends(user_id, friend_id) VALUES (?,?)";
		$value = array($user_id, $friend_id);
		return $this->db->query($query, $value);
	}

	function remove_friend($user_id, $friend_id)
	{
		$query = "DELETE FROM friends WHERE user_id = ? AND friend_id = ?";
		$value = array($user_id, $friend_id);
		return $this->db->query($query, $value);
	}
}