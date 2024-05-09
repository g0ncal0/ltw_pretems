<?php
    function output_total() { ?>
        <div class="cart_interface">
        <div class="cart">
        </div>
            <div class="total">
                <div>
                    <h3>Total:</h3><br>    
                    <p id="cart-total-price"></p>
                    <button class="proceed-checkout button" type="button">Checkout</button>
                </div>
            </div>
        </div>
    <?php }


    function output_list_cart_items($products) { ?>
        <section class="cart">
            <?php foreach($products as $product) output_cart_item($product); ?>
        </section>
    <?php }
    
    
    function output_cart_item($product) { ?>
        <div class="cart-item">             
            <img src="<?php echo $product['firstImg']?>">
        
            <div class="cart-details">
                <h3><?php echo $product['name']?></h3>
                <div>
                    <p><?php echo $product['model']?></p>
                    <p><?php echo $product['size']?></p>
                    <p><?php echo $product['description']?></p>
                    <p><?php echo $product['price'];  echo ' €' ?></p>
                    <button class="button remove-cart" data-id="<?php echo $product['id']?>">Remove from cart</button>
                </div>
            </div>
        </div>
    <?php }


    function output_checkout(){ ?>
        <div class="container" id="checkout" style="display: none">
            <p class="special">Checkout</p>
            <h2>In one step, everything will be yours..</h2>
            <form method="post" action="/actions/action_checkout.php">
                <input name="delivery" id="delivery" type="text" placeholder="Delivery Spot">
                <input name="zipcode" id="zipcode" type="text" pattern="[0-9]{4}-[0-9]{3}" placeholder="ZipCode">
                <button type="submit">Pay</button>
            </form>
        </div> 
    <?php }

?>