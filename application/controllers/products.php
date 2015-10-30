<?php

class products extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->load->view('add_product', array('error' => ' ' ));
	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '500';
		$config['max_width']  = '3200';
		$config['max_height']  = '3200';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{

			$data = $this->upload->data();
			$seller_id = $this->session->userdata('id');
			$this->load->model('user');
			$seller_info = $this->user->get_user_by_id($seller_id);
			$seller_name = $seller_info['first_name'] . " ". $seller_info['last_name'];

			$image = base_url() . 'uploads/' .$data['file_name'];
			
			$product_info = array(
				'seller_id' => $seller_id,
				'name'      => $this->input->post('name'),
				'starting_price' => $this->input->post('starting_price'),
				'selling_price'  => $this->input->post('starting_price'),
				'description'    => $this->input->post('description'),
				'seller_name'    => $seller_name,
				'image'		       => $image);

				// $shield = array('product_info' => $product_info);

			$this->load->model('auction');
			$this->auction->create_product($product_info);
			redirect('/users/dash');
		}
	}
}
?>
