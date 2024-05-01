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
                <div>
                    <div>
                        <h1><?php echo $product['name']?></h1>
                        <p class="price-info"><?=$product['price']?>€</p>
                    </div>
                    <div class="user-profile-pr">
                        <?php $user = getUser($db, $product['user']); ?>
                        <img class="profile-img" src=<?=$user['profileImg']?>>
                        <p><a href="profile.php?id=<?php echo $product['user'] ?>"><?php echo $user['username']?></a></p>
                    </div>
                </div>
                <div>
                    <div>
                        <p><span class="special">Category:</span> <?php echo getCategory($db, $product['category'])?></p>
                        <p><span class="special">Brand:</span> <?php echo getBrand($db, $product['brand'])?></p>
                        <p><span class="special">Size:</span> <?php echo getSize($db, $product['size'])?></p>
                        <p><span class="special">Model:</span> <?= $product['model']?></p>
                        <p><span class="special">Condition:</span> <?= $product['condition']?></span> 
                        <p><span class="special">Uploaded:</span> <?= $product['date']?></span> 
                    </div>
                    <div>
                        <button class="button">FAVORITES</button>
                        <button data-id="<?php echo $product['id'] ?>" class="button">ADD TO CART</button>
                        <a href="chat.php?buyerId=<?php echo $id?>&productId=<?php echo $product['id']?>"><button class="button">ASK USER</button></a>
                    </div>
                </div>
            </div>
        </section>
    <?php }

    function output_list_items($products) {?>
        <section id="products" class="container products">
            <?php foreach($products as $product) output_item($product); ?>
        </section>
    <?php }

    

?>