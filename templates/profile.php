<?php 
    declare(strict_types = 1);

    function output_profile_top(array $profile) : void {
        $session = new Session(); ?>
        <div class="profile-top"><?php 
            output_profile($profile); 
            if ($profile['id'] == $session->getId()) {?>
                <a href="changeProfile.php"><button class="button">✏️ Edit Profile</button></a>
            <?php }
            else if ($session->getAdmin()) { ?>
                </div>
                <form action="/actions/action_block_user.php" method="post">
                <h2>Admin Actions</h2>
                    <input type="hidden" class="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>
                    <input type="hidden" name="userId" value="<?php echo $profile['id']?>">
                    <button type="submit" class="button" onclick="return confirm('Are you sure you want to block this user?')">BLOCK USER</button>
                </form>
                <?php return;
            } ?>
        </div>
    <?php } 

    function output_profile(array $profile) : void { ?>
        <section id="profile_info">
            <div class="user-profile-img">
                <img src=<?php echo $profile['profileImg']?> alt="Profile Image" id="profile_image">
            </div>
            <div class="user-profile-info">
                <span id="name"><?php echo $profile['name']?></span>
                <span id="username"><?php echo $profile['username']?></span>
                <span id="email"><?php echo $profile['email']?></span>
            </div>
        </section>
    <?php }

    function output_user_area() : void { ?>
        <h2>User Actions</h2>
        <a href="addProduct.php"><button class="button">Add Product</button>
    </a>
    <?php }

    function output_admin_area() : void { ?>
        <h2>Admin Area</h2>
        <div class="admin-area-buttons">
            <a href="admin_area.php?area=category"><button class="button">Add Category</button></a>
            <a href="admin_area.php?area=size"><button class="button">Add Size</button></a>
            <a href="admin_area.php?area=condition"><button class="button">Add Condition</button></a>
            <a href="admin_area.php?area=brand"><button class="button">Add Brand</button></a>
            <a href="manage_users.php"><button class="button">Manage Users</button></a>
        </div>
    <?php }

    function output_profile_items(?array $favorites,?array $selling_items,?array $sold_items) : void { ?> 
        <h2> Favorites Items </h2> <?php
        if($favorites){
            echo "<div class=products>";
                foreach ($favorites as $favorite_item) {
                    output_profile_selling_item($favorite_item);
                }
            echo "</div>";
        } else {
            echo "<p> No items </p>";
        }
        
        ?> <h2> Items that you are selling </h2> <?php
        if($selling_items){
            echo "<div class=products>";
                foreach ($selling_items as $selling_item) {
                    output_profile_selling_item($selling_item);
                }
            echo "</div>";
        } else {
            echo "<p> No items </p>";
        }

        ?> <h2> Items that you sold </h2> <?php
        if($sold_items){
            echo "<div class=products>";
            foreach ($sold_items as $sold_item) {
                output_profile_sold_item($sold_item);
            }
            echo "</div>";
        } else {
            echo "<p> No items </p>";
        }
    }

    function output_profile_selling_item(array $product) : void {    
        $session = new Session(); 
        $db = getDatabaseConnection();     
        ?><div class="box-item">             
            <img src="<?php echo $product['firstImg'] ?>">
        
            <div class="box-details">
                <a href="/item.php?id=<?php echo $product['id']?>">
                <h3><?php echo $product['name']?></h3></a>
                <p class="info"><span><?php echo getBrand($db, $product['brand'])?></span></p>
                <div>
                    <p><?php echo $product['price']?>€</p>
                </div>
                <?php if ((($session->getId() != $product['user']) || (!$session->isLoggedIn())) && $product['available']) echo '<button data-id=' . $product['id'] .  ' class="button add-cart">ADD TO CART</button>'; ?>            
            </div> 
        </div>
    <?php }

    function output_profile_sold_item(array $product) : void {    
        $db = getDatabaseConnection(); 
        $shipping_info_ids = getShippingIds($db, $product['id']);
    
        ?><div class="box-item">             
            <img src="<?php echo $product['firstImg'] ?>">
        
            <div class="box-details">
                <a href="/item.php?id=<?php echo $product['id']?>">
                <h3><?php echo $product['name']?></h3></a>
                <p class="info"><span><?php echo getBrand($db, $product['brand'])?></span></p>
                <div>
                    <p><?php echo $product['price']?>€</p>
                    <a href="shipping_form.php?product_id=<?php echo $product['id']; ?>&purchase_id=<?php echo $shipping_info_ids['purchase_id'];?>"><button class="button">Print Shipping Forms</button></a>
                </div>
            </div>
        </div>
    <?php }
    

    function output_profile_logged(array $profile, ?array $favorites, ?array $selling_items, ?array $sold_items) : void { ?>
        <section class="profile-page container"><?php
            output_profile_top($profile);
            output_user_area();
            output_profile_items($favorites, $selling_items, $sold_items); ?>
        </section><?php
    }
    function output_profile_logged_admin(array $profile, ?array $favorites, ?array $selling_items, ?array $sold_items) : void { ?>
        <section class="profile-page container"><?php
            output_profile_top($profile);?>
            <p class="is-admin">You are an admin</p><?php
            output_user_area();
            output_admin_area();
            output_profile_items($favorites, $selling_items, $sold_items); ?>
        </section><?php
    }

    function output_profile_other_user(array $profile, ?array $selling_items) : void { ?>
        <section class="profile-page container"><?php
            output_profile_top($profile);?>
            <h2> Items that the user is selling </h2> 
            <div class=products> <?php
            if($selling_items){
                foreach ($selling_items as $selling_item) {
                    output_profile_selling_item($selling_item);
                }
            } else {
                echo "<p> No items </p>";
            } 
            echo "</div>"; ?>

        </section><?php
    }



    function output_profile_purchases(?array $purchases) : void {
        ?>
        <div class="container">
        <h2>Purchases</h2>
        
        <?php
        if(empty($purchases)){echo "<p>You have no purchases.. yet! Start buying!! </p>";}

        foreach($purchases as $purchase){
        ?>
            <p><a href="/purchase.php?id=<?=$purchase['id']?>">Purchase on <?= $purchase['date']?> | <?= $purchase['cost']?></a></p>
        <?php
        }
        ?>
        </div>
        <?php
    }

?>

