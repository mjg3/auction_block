<html>
    <head>
        <title>Profile</title>
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
                        <li><a href="/users/faq">FAQ</a></li>
                        <li><a href="/">Auction</a></li>
                        <li><a href="/users/dash">Your Dash</a></li>
                        <li><a href="/users/logout">Logout</a></li>
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li><a href="/users/faq">FAQ</a></li>
                        <li><a href="/users/dash">Your Dash</a></li>
                        <li><a href="/users/logout">Logout</a></li>
                    </ul>
                </div>
            </nav>
            <div class="row">
                <div class="offset-s1 col s10">
                    <div class="row profile_info">
                        <div class="center offset-s1 col s10 offset-l2 col l2">
                            <img class="profile_img" src="/assets/images/person.gif" alt="No Photo" />
                        </div>
                        <div class="card offset-s1 col s10 offset-l1 col l5">
                            <div class="row">
                                <div class="col s6">
                                    <h6>Member Name:</h6>
                                    <h6>Joined:</h6>
                                    <h6>Online Status:</h6>
                                </div>
                                <div class="col s6">
                                    <h6 class="weight-lighten"><?=$user_info['first_name']?></h6>
                                    <h6 class="weight-lighten"><?=$user_info['created_at']?></h6>
                                    <h6 class="weight-lighten">logged on!</h6>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Profile Info Row-->
                    <div class="row review_card">
                        <div class="offset-s1 col s10 card">
                            <h5 class="weight-lighten">Recent Reviews:</h5>
                            <div class="row">
                                <div class="offset-s1 col s10 review card grey lighten-3">
<?php                               foreach($reviews as $review){
                                        for($i=0; $i<$review['rating'];$i++){?>
                                            <i class="tiny material-icons no-width">star_rate</i>
<?php                                   }?>
                                        <h6 class="weight-lighten"><a href="/users/profile/<?=$review['writer_id']?>"><?=$review['first_name']?></a> says</h6>
                                        <p><?=$review['review']?></p>
<?php
                                    }
?>
                                </div>
                            </div> <!-- Review Box-->
                        </div>
                    </div>
                </div> <!-- End of Profile Info with Reviews-->
            </div>
        </div> <!-- End Page container-->
    </body>
</html>
