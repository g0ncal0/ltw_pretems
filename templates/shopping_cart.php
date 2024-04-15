<?php
    function output_total($total) { ?>
        <div class="total">
            <form action="payment.php" method="get">  <!-- TODO: implement (change name) -->
                <h3>Total:</h3><br>    
                <p><?php echo $total?> €</p>
                <button class="proceed-checkout" type="button">Checkout</button>
            </form>
        </div>
    <?php }
    function output_list_cart_items($products) { ?>
        <section class="cart">
            <!-- <h2>Cart</h2> -->
            <?php foreach($products as $product) output_cart_item($product); ?>
        </section>
    <?php }
    
    
    function output_cart_item($product) { ?>
        <div class="box-item">             
            <img src="<?php echo $product['firstImg']?>">
        
            <div class="box-details">
                <h3><?php echo $product['name']?></h3>
                <div>
                    <p><?php echo $product['model']?></p><br>
                    <p><?php echo $product['size']?></p><br><br>
                    <p><?php echo $product['description']?></p><br>
                    <p><?php echo $product['price'];  echo ' €' ?></p>
                    <button class="remove-cart" data-id="<?php echo $product['id']?>">Remove from cart</button>
                </div>
            </div>
        </div>
    <?php }

?>