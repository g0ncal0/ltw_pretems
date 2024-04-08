<?php 
    function output_item($product) { ?>
        <div class="box-item">             
            <img src="img/dress.jpeg">
        
            <div class="box-details">
                <h3><?php echo $product['name']?></h3>
                <p class="info"><span>NEW</span><span><?php echo $product['Brand']?></span></p>
                <div>
                    <p><?php echo $product['price']?></p>
                    <button class="button">ADD TO CART</button>
                </div>
            </div>
        </div>
    <?php }

    function output_full_item($product) { ?>
        <section class="item-page">
            <div class="item-page-photos">
                <img src="img/dress.jpeg">                
                <img src="img/dress-beach.jpeg">
                <img src="img/dress.jpeg">
                <img src="img/dress.jpeg">
                <img src="img/dress-beach.jpeg">
            </div>
        
            <div class="container">
                <h1><?php echo $product['name']?></h1>
                <p class="info"><span>NEW</span><span><?php echo $product['Brand']?></span><span><?php echo $product['size']?></span></p>
                <p><?php echo $product['description']?></p>
    
                <p><?php echo $product['price']?></p>
                <button class="button">FAVORITES</button>
                <button class="button">ADD TO CART</button>
                <button class="button">ASK USER</button>
            </div>
        </section>
    <?php }

    function output_cart_item($product) { ?>
        <div class="box-item">             
            <img src="img/dress.jpeg">
        
            <div class="box-details">
                <h3><?php echo $product['name']?></h3>
                <div>
                    <p><?php echo $product['name']?></p>
                </div>
            </div>
        </div>
    <?php }

    function output_list_items($products) {?>
        <section class="products">
            <h2>Products</h2>
            <?php foreach($products as $product) output_item($product); ?>
        </section>
    <?php }

    function output_list_cart_items($products) { ?>
        <section class="cart">
            <h2>Cart</h2>
            <?php foreach($products as $product) output_cart_item($product); ?>
        </section>
    <?php }
?>