<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class user extends CI_Model {

		public function __construct(){
			parent:: __construct();

		}

		//validate registration
		public function validate_registration($post)
		{
			$this->load->helper(array('form', 'url'));
		    $this->load->library('form_validation');
		    $this->form_validation->set_rules('first_name', 'First Name', 'trim|min_length[3]|alpha_dash|required|xss_clean');
		    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|min_length[3]|alpha_dash|required|xss_clean');
		    $this->form_validation->set_rules('email', 'Email', 'trim|is_unique[users.email]|valid_email|required');
		    $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|matches[confirm_password]|required|md5');
		    if($this->form_validation->run())
		    {
		    	return "valid";
		    }
		    else
		    {
		    	return array(validation_errors());
		    }
		}

		//validate login form
		public function validate_login($login_info)
		{
			$this->load->helper(array('form', 'url'));
		    $this->load->library('form_validation');
		    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|callback_check_database');
		    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		    if($this->form_validation->run())
		    {
		    	return "valid";
		    }
		    else
		    {
		    	return array(validation_errors());
		    }
		}

		//make sure user is unique and matches database before logging in
		public function login($email, $password)
		{
		    $this->db->select('email', 'password', 'id');
		    $this->db->from('users');
		    $this->db->where('email', $email);
		    $this->db->where('password', md5($password));
		    $this->db->limit(1);

		    $query = $this -> db -> get();

		    if($query -> num_rows() == 1)
		    {
		    	return $query->result();
		    }
		    else
		    {
		    	return false;
		    }
		}
		public function add_user($user_info) {
		$query = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
		$values = [$user_info['first_name'], $user_info["last_name"], $user_info['email'], $user_info['password'], '0'];
		return $this->db->query($query, $values);
	}

		//get user for showing purposes
		public function get_user_by_email($email){
			return $this->db->query("SELECT first_name, last_name, email, id, stripe_id, created_at
									FROM users
									WHERE email =?", $email)->row_array();
		}
		public function get_user_by_id($user_id) {
			return $this->db->query("SELECT first_name, last_name, email, id, stripe_id, created_at
									FROM users
									WHERE id=?", $user_id)->row_array();
		}

		public function purchased_product($winner_id) {
			// won products will be a list of all proudcts that a user has been the last
			// bidder on.
			$won_products =
			$this->db->get_where('products',
			array('bidder_id' => $winner_id))->result_array();

			return $won_products;
		}

		public function sold_product($seller_id) {
			// sold products will be a list of all proudcts that a user has sold
			$sold_products =
			$this->db->get_where('products',
			array('seller_id' => $seller_id))->result_array();

			return $sold_products;
		}

	//Stuff for Stripe Info
		public function update_billing($stripe_id, $user_id) {
			$billing_info = array('stripe_id' => $stripe_id);
			$this->db->where('id', $user_id);
			$this->db->update('users', $billing_info);

		}

		public function get_customer_id($user_id){
			$customer_info = $this->db->get_where('users', array('id' => $user_id))->result_array();
			$customer_id   = $customer_info[0]['stripe_id'];
			return $customer_id;
		}

	//Getting reviews for the profile page
		public function get_profile_reviews($id){
			return $this->db->query("SELECT review, reviews.created_at, reviews.rating, writers.first_name as first_name, writer_id
									FROM reviews
									JOIN users as writers ON reviews.writer_id = writers.id
									WHERE user_id=?", $id)->result_array();
		}
}

?>
