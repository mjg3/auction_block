$(document).ready(function(){

//Login/Registration scripts
    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $('#register-form-link').removeClass('text-darken-3');
        $('#register-form-link').addClass('text-lighten-2');
        $(this).removeClass('text-lighten-2');
        $(this).addClass('active');
        $(this).addClass('text-darken-3');
        e.preventDefault();
    });

    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $('#login-form-link').removeClass('text-darken-3');
        $('#login-form-link').addClass('text-lighten-2');
        $(this).removeClass('text-lighten-2');
        $(this).addClass('active');
        $(this).addClass('text-darken-3');
        e.preventDefault();
    });

//Stripe Functions
    jQuery(function($) {
    $('#payment-form').submit(function(event) {
        // this identifies your website in the createToken call below
        Stripe.setPublishableKey('pk_test_TDsy5q9d81vbIu1BSfaZ12cF');
        var $form = $(this);

        // Disable the submit button to prevent repeated clicks
        $form.find('button').prop('disabled', true);

        Stripe.card.createToken($form, stripeResponseHandler);

        // Prevent the form from submitting with the default action
            return false;
        });
    });
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

//Materialize Initializations
    $(".button-collapse").sideNav();
    $('.modal-trigger').leanModal();
    $('select').material_select();

    $('#modal1').on('modal-close', function (e) {
        $(this).find("input,textarea,select").val('').end();
    })
    $('#modal2').on('modal-close', function (e) {
        $(this).find("input,textarea,select").val('').end();
    })

//Auction Magic scripts

  setInterval(function() {
      $.get('/users/refresh', function(res){
            console.log(res);
            var time = res.time;
            var price = res.selling_price;
            var bidder_id = res.bidder_id;
            var bidder_name = res.bidder_name;

            var image = res.image;
            var description = res.description;

            // need to properly format the time
            time  = time.split("-");
            time[0] = time[0] + "/" + time[1] + "/" + time[2];
            time = time[0];
            var timeTest = time.replace(/^"(.+(?="$))"$/, '$1');

         $("#clock").countdown(timeTest, function(event) {

             $(this).html(event.strftime('%M : %S'));
         });
        //  .on('finish')

             $(this).html(event.strftime(' Time Left: %H:%M:%S'));
         })




         $('#current_price').empty();
         $('#current_price').html('$' + price + '.00');
         $('#bidder_name').html(bidder_name);
         $('#bidder_name').attr("href",'/users/profile/'+bidder_id);

   }, "JSON");
 }, 100);

         $('#feature_img').attr("src", image);
         $('#feature_product_description').empty();
         $('#feature_product_description').html(description);


   }, "JSON");
 }, 5000);

 $("#clock").on('finish.countdown', function(){
    console.log("something else");
    $.get('/auctions/next_product');
   });


    //    setInterval(function() {
        //    location.reload();
    //        $.get('/users/refresh', null, function(res){
    //            $('#show').text('this is working!');
    //        });
        //    console.log('hi');
        //    var randomnumber = Math.floor(Math.random() * 100);
        //    $('#show').text(
        //            'I am getting refreshed every 3 seconds..! Random Number ==> '
        //                    + randomnumber);
    //    }, 1000);

    // setInterval("updateMyContent();", 1000);

    // $('#bid').submit(function(){
    //     $.post('/auctions/update_bid', $(this).serialize(), function(res){
    //         console.log('hi');
    //     });
    //     return false;
    // })

});
