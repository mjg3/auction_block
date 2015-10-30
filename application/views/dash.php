<!DOCTYPE html>
<html>
    <head>
        <title>Your Dashboard</title>
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
                        <li><a href="/users/logout">Logout</a></li>
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li><a href="/users/faq">FAQ</a></li>
                        <li><a href="/">Auction</a></li>
                        <li><a href="/users/logout">Logout</a></li>
                    </ul>
                </div>
            </nav> <!-- End of Nav Bar-->
            <div class="row">
                <div class="col s 12">
                    <h5>Welcome, <a href="/users/profile/<?=$user_info['id']?>"><?=$user_info['first_name']?></a></h5>
                </div>
            </div> <!-- End Welcome Header-->
            <div class="row">
                <div class="col s12 col l5">
                    <h6 class="red-text text-darken-4">Items Won</h6>
                    <table class="striped responsive-table my_grey">
                        <thead>
                            <tr>
                                <th data-field="product_name">Product</th>
                                <th data-field="bid_price">Bid</th>
                                <th data-field="seller_name">Seller</th>
                                <th data-field="date_sold">Date</th>
                            </tr>
                        </thead>
                        <tbody>
<?php                       if ($purchases == null) {
?>
                              <tr>
                                <td colspan="4">Go buy some stuff, silly!</td>
                              </tr>
<?php                       }
                            else
                            {
                              foreach($purchases as $key => $values)
                              {
?>
                            <tr>
                                <td><?=$values['product_name']?></td>
                                <td><?=$values['bid_price']?></td>
                                <td><a href="/users/profile/<?=$values['seller_id']?>"><?=$values['seller_name']?></a></td>
                                <td><?=$values['date_sold']?></td>
                            </tr>
<?php                         } }
?>
                        </tbody>
                    </table>
                </div>
                <div class="col s12 col l5 offset-l2">
                    <h6 class="red-text text-darken-4">Sales History</h6>
                    <table class="striped responsive-table my_grey">
                        <thead>
                            <tr>
                                <th data-field="product_name">Product</th>
                                <th data-field="bid_price">Bid</th>
                                <th data-field="buyer_name">Buyer</th>
                                <th data-field="date_sold">Date</th>
                            </tr>
                        </thead>
                        <tbody>
<?php                   if($sales == null)
                        {
?>                      <tr><td colspan="4">You haven't sold anything!</td></tr>
<?php                   }
                        else
                        {
                          foreach($sales as $key => $values)
                            {
?>                             <tr>
                                  <td><?=$values['product_name']?></td>
                                  <td><?=$values['bid_price']?></td>
                                  <td><a href="/users/profile/<?=$values['buyer_id']?>"><?=$values['buyer_name']?></a></td>
                                  <td><?=$values['date_sold']?></td>
                              </tr>
<?php
                            }
                        }
?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- End of 1st table row-->
            <div class="row">
                <div class="col s12 col l8 offset-l2">
                    <div class="row">
                        <div class="col s6">
                            <h6 class="red-text text-darken-4">Your Items on Deck</h6>
                        </div>
                        <div class="col s4 offset-s2">
                            <!-- Modal Trigger -->
                            <a class="btn modal-trigger red darken-4" href="#modal1">Add Product</a>
                            <!-- Modal Structure -->
                            <div id="modal1" class="modal">
                                <div class="modal-content">
                                    <h5>Add Product to The Hammer</h5>
                                    <!--add product form-->
                                    <?php $this->load->helper('form');
                                    echo form_open_multipart('/products/do_upload');?>
                                    <form id="add_product_form" action="/products/do_upload" method="post">
                                        <div class="input-field">
                                            <label for="name">Product Name</label>
                                            <input type="text" name="name">
                                        </div>
                                        <div class="input-field">
                                            <i class="material-icons prefix">mode_edit</i>
                                            <label for="description">Description</label>
                                            <textarea id="description" class="materialize-textarea" name="description"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col s8">
                                                <div class="input-field">
                                                    <select name="starting_price" class="grey-text text-lighten-1">
                                                        <option value="" disabled selected>Starting Price ($USD)</option>
<?php
                                                    for($i=5; $i<=2000; $i = $i + 5){?>
                                                        <option value="<?=$i?>"><?=$i?>.00</option>
<?php
                                                    }
?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col s4">
                                                <div class="file-field input-field">
                                                    <div class="btn red lighten-2"><span>File</span>
                                                        <input type="file" name="userfile" size="20">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input class="btn right modal-close red darken-2" type="submit" value="Add Your Product!">
                                    </form>
                                </div>
                                <div class="modal-footer"></div>
                            </div>
                        </div>
                    </div>

                    <table class="striped responsive-table my_grey">
                        <thead>
                            <tr>
                                <th data-field="product_name">Product</th>
                                <th data-field="min_price">Minimum Bid</th>
                                <th data-field="batting_order">Batting Order</th>
                            </tr>
                        </thead>
                        <tbody>
<?php                   if($queues == null)
                        {
?>                      <tr><td colspan="3">You don't have anything in the queue!</td></tr>
<?php                   }
                        else
                        {
                          foreach($queues as $key => $values)
                            {
?>                             <tr>
                                  <td><?=$values['product_name']?></td>
                                  <td><?=$values['min_price']?></td>
                                  <td><?php if ($values['batting_order'] == 1) { ?>
                                            You're on deck!
<?php                               } else if($values['batting_order'] == 0) { ?>
                                            Selling NOW!
<?php                                    }
                                        else {?>
                                     <?=$values['batting_order']?> away</td>
                              </tr>
<?php
                            }
                        }
                    }
?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
