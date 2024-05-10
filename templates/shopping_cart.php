<?php
    function output_total() { ?>
        <div class="total">
            <div class="styled-input">  <!-- TODO: implement (change name) -->
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

?>