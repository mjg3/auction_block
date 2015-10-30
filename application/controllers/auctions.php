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
			$updated_time_end = $time_end+30;
			$bid_info = array(
					'bidder_id'=>$bidder_id,
					'time_end'=>$time_end,
					'updated_price'=>$updated_price,
					'product_id'=>$product_id
			);
			$this->auction->update_bid($bid_info);
			redirect('/');
		}

	}

?>
