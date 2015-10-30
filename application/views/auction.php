<html>
    <head>
        <title>The Hammer</title>
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
                <div class="col s8 offset-s2">
                    <div id="clock" class="card-panel center-align big z-depth-5"></div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 col m5 offset-m1">
                    <img id="feature_img" class="responsive-img" src="<?=$product_info[0]['image']?>" onerror='this.onerror = null; this.src="/assets/images/alt_feature.gif"' alt="No Product"/>
                </div>
                <div class="col s12 col m5">
                    <h5 id="feature_product_name"><?= $product_info[0]['name'] ?></h5>
                    <p id="feature_product_description">
                        <?= $product_info[0]['description'] ?>
                    </p>
                    <h6 class="col s8 offset-s4">Seller: <a href="/users/profile/<?=$product_info[0]['seller_id']?>"><?= $product_info[0]['seller_name'] ?></a></h6>
                    <div class="row">
                        <div class="col s4">
                            <h4>Price:</h4>
                        </div>
                        <div class="col s8">
                            <h4 id="current_price">$<?=$product_info[0]['selling_price']?>.00</h4>
                        </div>
                        <h6 class="col s8 offset-s4">Highest Bidder: <a id="bidder_name">Be the first!</a></h6>

                    </div>
                    <div class="row">
                        <div class="col s12">
                            <form id="bid" action="/auctions/update_bid" class="input-field" method="post">
                                <div class="input-field">
                                    <select name="updated_price" class="grey-text text-lighten-1">
                                        <option value="" disabled selected>Your Bid ($USD)</option>
<?php
                                    for($i=$product_info[0]['selling_price']+5; $i<=2000; $i = $i + 5){?>
                                        <option value="<?=$i?>"><?=$i?>.00</option>
<?php
                                    }
?>
                                    </select>
                                </div>
                                <input type="hidden" name="product_id" value="<?= $product_info[0]['id'] ?>">
                                <input class="btn right modal-close red darken-2" type="submit" value="Bid!">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
