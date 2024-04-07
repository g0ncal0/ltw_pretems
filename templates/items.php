<?php 
    function output_item() { ?>
        <div class="box-item">             
            <img src="img/dress.jpeg">
        
            <div class="box-details">
                <h3>Title</h3>
                <p class="info"><span>NEW</span><span>BRAND</span></p>
                <div>
                    <p>PRICE</p>
                    <button class="button">ADD TO CART</button>
                </div>
            </div>
        </div>
    <?php }

    function output_full_item() { ?>
        <section class="item-page">
            <div class="item-page-photos">
                <img src="img/dress.jpeg">                
                <img src="img/dress-beach.jpeg">
                <img src="img/dress.jpeg">
                <img src="img/dress.jpeg">
                <img src="img/dress-beach.jpeg">
            </div>
        
            <div class="container">
                <h1>Title</h1>
                <p class="info"><span>NEW</span><span>BRAND</span><span>TAMANHO</span></p>
                <p>Uma pequena descrição sobre o produto</p>
    
                <p>PRICE</p>
                <button class="button">FAVORITES</button>
                <button class="button">ADD TO CART</button>
                <button class="button">ASK USER</button>
            </div>
        </section>
    <?php }

    function output_cart_item() { ?>
        <div class="box-item">             
            <img src="img/dress.jpeg">
        
            <div class="box-details">
                <h3>Title</h3>
                <div>
                    <p>PRICE</p>
                </div>
            </div>
        </div>
    <?php }

    function output_list_items() {
        // Esta função é para receber lista de items, está provisório assim
        output_item();
        output_item();
        output_item();
        output_item();
    }

    function output_list_cart_items() {
        // Esta função é para receber lista de items, está provisório assim ?>
        <h2>Cart</h2> <?php
        output_cart_item();
        output_cart_item();
        output_cart_item();
    }
?>