<?php 
    function output_item() { ?>
        <div class="box-item">             
            <img src="img/dress.jpeg">
        
            <div class="box-details">
                <h2>Title</h2>
                <p class="info"><span>NEW</span><span>BRAND</span></p>
                <div>
                    <p>PRICE</p>
                    <button class="button">ADD TO CART</button>
                </div>
            </div>
        </div>
    <?php }

    function output_full_item() { ?>
        <div class="box-item">             
            <img src="img/dress.jpeg">
        
            <div class="box-details">
                <h2>Title</h2>
                <p class="info"><span>NEW</span><span>BRAND</span><span>TAMANHO</span></p>
                <div>
                    <p>PRICE</p>
                    <button class="button">FAVORITES</button>
                    <button class="button">ADD TO CART</button>
                    <button class="button">ASK USER</button>
                </div>
                <p>Uma pequena descrição sobre o produto</p>
            </div>
        </div>
    <?php }
?>