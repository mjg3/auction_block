<?php ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Stripe Getting Started Form</title>
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <!-- jQuery is used only for this example; it isn't required to use Stripe -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript">
            // this identifies your website in the createToken call below
            Stripe.setPublishableKey('pk_test_TDsy5q9d81vbIu1BSfaZ12cF');

            function stripeResponseHandler(status, response) {
              var $form = $('#payment-form');

              if (response.error) {
                // Show the errors on the form
                $form.find('.payment-errors').text(response.error.message);
                $form.find('button').prop('disabled', false);
              } else {
                // response contains id and card, which contains additional card details
                var token = response.id;
                // Insert the token into the form so it gets submitted to the server
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                // and submit
                $form.get(0).submit();
              }
            };
            $(document).ready(function() {
                jQuery(function($) {
                $('#payment-form').submit(function(event) {
                  var $form = $(this);

                  // Disable the submit button to prevent repeated clicks
                  $form.find('button').prop('disabled', true);

                  Stripe.card.createToken($form, stripeResponseHandler);

                  // Prevent the form from submitting with the default action
                  return false;
                    });
                  });
                });
        </script>
    </head>
    <body>
        <h1>Testing Stripe</h1>
        <form action="/handler/create_customer" method="POST" id="payment-form">
          <span class="payment-errors"></span>

          <div class="form-row">
            <label>
              <span>Card Number</span>
              <input type="text" size="20" data-stripe="number"/>
            </label>
          </div>

          <div class="form-row">
            <label>
              <span>CVC</span>
              <input type="text" size="4" data-stripe="cvc"/>
            </label>
          </div>
          <div class="form-row">
            <label>
              <span>Expiration (MM/YYYY)</span>
              <input type="text" size="2" data-stripe="exp-month"/>
            </label>
            <span> / </span>
            <input type="text" size="4" data-stripe="exp-year"/>
          </div>
          <button type="submit">Submit Payment</button>
        </form>
    </body>
</html>