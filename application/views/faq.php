<html>
    <head>
        <title>F.A.Q.</title>
        <?php
            $this->load->view('/partials/meta');
        ?>
    </head>
    <body>
        <div class="container">
            <nav>
                <div class="nav-wrapper red darken-3">
                    <a href="/"><img class="brand-logo left small_logo bump_right" src="/assets/images/hammer.gif"/></a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="/">Auction</a></li>
                        <li><a href="/users/dash">Your Dash</a></li>
                        <li><a href="/users/logout">Logout</a></li>
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li><a href="/">Auction</a></li>
                        <li><a href="/users/dash">Your Dash</a></li>
                        <li><a href="/users/logout">Logout</a></li>
                    </ul>
                </div>
            </nav>
            <div class="container">
                <div class="card-panel">
                    <h3>Frequently Asked Questions</h3>
                    <h6>1) What makes your auction site unique?</h6>
                    <p>
                        The Hammer is a new take on the classic auction. We combine a modern browsing experience with instant gratification. Our game-like structure will help keep you addicted to purchasing products online and that, overall, will make us money.
                    </p>
                    <h6>2) Why do you require members to have a Stripe Account?</h6>
                    <p>
                        Our instant win auction needs to be able to purchase the highest bidder's product immediately so members can start the bidding on the next product in line. If we had to wait for members to purchase the products on their own time, it could delay the next auction.
                    </p>
                    <h6>3) My shipping address changed. How can I updated it?</h6>
                    <p>
                        Please visit <a href="/users/dash">Your Dash</a> and update your shipping address.
                    </p>
                    <h6>4) Do you have any job opportunities?</h6>
                    <p>
                        Quite possibly. Please <a class="modal-trigger " href="#modal2">contact us</a> and we'll let you know if any positions open up!
                    </p>
                    <!-- Modal Structure -->
                    <div id="modal2" class="modal">
                        <div class="modal-content">
                            <h5>Send Us an Email</h5>
                            <!--add email form-->
                            <form id="email_form" action="/users/faq" method="post">
                                <div class="input-field">
                                    <input type="text" name="name" disabled value="theHammerCollective@gmail.com">
                                </div>
                                <div class="input-field">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <label for="email_body">Your reason for contacting us</label>
                                    <textarea id="email_body" class="materialize-textarea" name="email_body"></textarea>
                                </div>
                                <input class="btn right modal-close red darken-2" type="submit" value="Send Email!">
                            </form>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
