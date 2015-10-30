<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Auction extends CI_Model {

		public function __construct(){
			parent:: __construct();
		}

		public function create_product($product_info) {
			// Codeigniter insert method
			$this->db->insert('products', $product_info);
			// Let's get the id of the product we just inserted
			$product_id = $this->db->insert_id();
			$seller_id  = $product_info['seller_id'];
			// Then we'll insert the proudct into the queue
			$this->db->insert('queues',
			array('product_id' => $product_id, 'seller_id' => $seller_id));
		}

		public function product_detail($product_id) {
			// get the product information for the provided id, and return
			// an array of that information.
			$product_information = $this->db->get_where('products', array('id' => $product_id))->result_array();
			return $product_information;
	}

	// returns the id of the product that is the first item in the queue
	// and ready to be sold
	public function for_sale(){
			$query = 'SELECT product_id, id FROM queues ORDER BY id ASC LIMIT 1';
			$product_id = $this->db->query($query)->row_array();
			return $product_id;
	}

	public function purchased_products($user_id){
			return $this->db->query("SELECT purchased_products.name as product_name, purchased_products.price as bid_price,
															sellers.first_name as seller_name, purchased_products.seller_id as seller_id, date_format(purchased_products.created_at, '%l:%i %p, %b %D, %Y') as date_sold
															FROM purchased_products
															JOIN users AS sellers ON purchased_products.seller_id = sellers.id
															WHERE purchased_products.buyer_id =?", $user_id)->result_array();

	}

	public function sold_products($user_id){
			return $this->db->query("SELECT products.name as product_name, sold_products.price as bid_price,
																buyers.first_name as buyer_name, sold_products.buyer_id as buyer_id,
																date_format(sold_products.created_at, '%l:%i %p, %b %D, %Y') as date_sold
																FROM sold_products
																JOIN users as buyers ON sold_products.buyer_id = buyers.id
																JOIN products ON sold_products.product_id = products.id
																WHERE sold_products.seller_id = ?", $user_id)->result_array();

	}

	public function products_in_queue($user_id){
			return $this->db->query("SELECT products.name as product_name, products.starting_price as min_price,
			queues.id as id
			FROM queues
			JOIN products ON products.id = queues.product_id
			WHERE queues.seller_id =?", $user_id)->result_array();

	}

	public function get_time_end(){
		return $this->db->query("SELECT time_end FROM queues")->row_array();
	}

	public function update_bid($bid_info){
		// var_dump($bid_info);

		$sql = "UPDATE products
				JOIN queues ON products.id=queues.product_id
				SET products.bidder_id=?, queues.time_end=?, products.selling_price=?
				WHERE queues.product_id=?";
		return $this->db->query($sql, $bid_info);
	}
}

?>
