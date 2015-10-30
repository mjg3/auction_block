<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require ('stripe-php-master/init.php');

class handler extends CI_Controller {

public function create_customer() {

  \Stripe\Stripe::setApiKey("sk_test_bv8w53EEDkNDQmA3oGQGI0VZ");
  $token = $this->input->post('stripeToken');

  // Create a Customer
  $customer = \Stripe\Customer::create(array(
    "source" => $token,
    "description" => "Charles Brian")
  );

  $stripe_id = $customer->id;
  $user_id   = $this->session->userdata['id'];
  $this->session->set_userdata('stripe_id', $stripe_id);
  $this->load->model('user');
  // Attaches a stripe id to a given customer
  $this->user->update_billing($stripe_id, $user_id);
  $this->charge($user_id, '100');
  redirect('/');


}
  // After we create a customer, we want to store their information in
  // the database.
public function charge($user_id, $price) {
  // We'll have to pass stripe a customer id that we retrieve from the
  // database using a user_id.
  $this->load->model('user');
  $customer_id = $this->user->get_customer_id($user_id);

  \Stripe\Charge::create(array(
    "amount" => $price, # amount in cents, again
    "currency" => "usd",
    "customer" => $customer_id
  ));

    }
}
?>
