<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class auctions extends CI_Controller {

		public function index() {
			redirect('/');
		}
		public function update_bid(){
			$updated_price = $this->input->post('updated_price'); //updated price
			$product_id = $this->input->post('product_id');
			$bidder_id = $this->session->userdata('id');
			$this->load->model('auction');
			$time = $this->auction->get_time_end();
			$time_end = $time['time_end'];

			date_default_timezone_set('America/Los_Angeles');
			$updated_time_end = 	strtotime($time_end) + 30;
			$bid_info = array(
					'bidder_id'=>$bidder_id,
					'time_end'=>$updated_time_end,
					'updated_price'=>$updated_price,
					'product_id'=>$product_id
			);
			$this->auction->update_bid($bid_info);
			redirect('/');
		}

		public function next_product(){
			$this->load->model('auction');
			$product_id_holder = $this->auction->for_sale();
			$product_id = $product_id_holder['product_id'];
			$product_info = $this->auction->product_detail($product_id);
			$this->auction->purchase_insert($product_info);

			$this->auction->sold_insert($product_info);

			$this->auction->delete_from_queue($product_id);
			$this->auction->update_queue();
	}
}
?>
