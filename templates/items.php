<?php 
    function output_item($product) {
        $db = getDatabaseConnection(); ?>
        
        <div class="box-item">             
            <img src="<?php echo $product['firstImg'] ?>">
        
            <div class="box-details">
                <a href="/item.php?id=<?php echo $product['id']?>">
                <h3><?php echo $product['name']?></h3></a>
                <p class="info"><span>NEW</span><span><?php echo getBrand($db, $product['brand'])?></span></p>
                <div>
                    <p><?php echo $product['price']?></p>
                    <button data-id="<?php echo $product['id'] ?>"  class="button add-cart">ADD TO CART</button>
                </div>
            </div>
        </div>
    <?php }

    function output_full_item($product, $id, $images) {
        $db = getDatabaseConnection(); ?>

        <section class="item-page">
            <div class="item-page-photos">
                <?php foreach($images as $image) { ?>
                    <img src=<?php echo $image['path']?>>
                <?php } ?>
            </div>
        
            <div class="container">
                <h1><?php echo $product['name']?></h1>
                <p class="info"><span><?php echo getBrand($db, $product['brand'])?></span><span><?php echo getSize($db, $product['size'])?></span></p>
                <p><?php echo getCategory($db, $product['category'])?></p>
                <p><?php echo $product['date']?></p>
                <p><a href="profile.php?id=<?php echo $product['user'] ?>"><?php echo getUser($db, $product['user'])['username']?></a></p>
                <p><?php echo $product['model']?></p>
                <p><?php echo $product['price']?></p>
                <button class="button">FAVORITES</button>
                <button data-id="<?php echo $product['id'] ?>" class="button">ADD TO CART</button>
                <a href="chat.php?buyerId=<?php echo $id?>&productId=<?php echo $product['id']?>"><button class="button">ASK USER</button></a>
            </div>
        </section>
    <?php }

    function output_list_items($products) {?>
        <section class="container products">
            <?php foreach($products as $product) output_item($product); ?>
        </section>
    <?php }

    

?>