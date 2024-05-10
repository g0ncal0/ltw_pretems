<?php
    function output_total() { ?>
        <div class="total">
            <div class="styled-input"> 
                <h3>Discount</h3>
                <input type="text" id="discount-code" placeholder="Discount Code">
                <button type="submit" id="discount-submit" class="button">Submit</button>
                <p id="info-discount"></p>
                <h3>Total:</h3>
                <p id="cart-total-price"></p>
                
                <button class="proceed-checkout button" type="button">Checkout</button>
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