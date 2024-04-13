<?php 
    function output_item($product) { ?>
        <div class="box-item">             
            <img src="img/dress.jpeg">
        
            <div class="box-details">
                <a href="/item.php?id=<?php echo $product['id']?>">
                <h3><?php echo $product['name']?></h3></a>
                <p class="info"><span>NEW</span><span><?php echo $product['brand']?></span></p>
                <div>
                    <p><?php echo $product['price']?></p>
                    <button data-id="<?php echo $product['id'] ?>"  class="button add-cart">ADD TO CART</button>
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
                <p class="info"><span><?php echo $product['brand']?></span><span><?php echo $product['size']?></span></p>
                <p><?php echo $product['category']?></p>
                <p><?php echo $product['date']?></p>
                <p><?php echo $product['user']?></p>
                <p><?php echo $product['model']?></p>
                <p><?php echo $product['price']?></p>
                <button class="button">FAVORITES</button>
                <button data-id="<?php echo $product['id'] ?>" class="button">ADD TO CART</button>
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
        <section class="container products">
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