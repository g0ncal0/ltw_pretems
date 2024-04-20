<?php
    function output_total() { ?>
        <div class="total">
            <div>  <!-- TODO: implement (change name) -->
                <h3>Total:</h3><br>    
                <p id="cart-total-price"></p>
                <button class="proceed-checkout button" type="button">Checkout</button>
            </div>
        </div>
    <?php }
    function output_list_cart_items($products) { ?>
        <section class="cart">
            <!-- <h2>Cart</h2> -->
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

?>