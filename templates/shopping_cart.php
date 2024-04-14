<?php
    function output_total() { ?>
        <div class="total">
            <form action="payment.php" method="get">  <!-- TODO: implement (change name) -->
                <h3>Total:</h3><br>    
                <p>[Show total here]</p>
                <button type="button">Checkout</button>
            </form>
        </div>
    <?php }
?>