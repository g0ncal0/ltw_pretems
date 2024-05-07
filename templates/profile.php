<?php 
    function output_profile_top($profile){ ?>
        <h1>User Profile</h1>
        <div class="profile-top"><?php 
            output_profile($profile); ?>
            <a href="changeProfile.php"><button class="button">✏️ Edit Profile</button></a>
        </div>
    <?php } 

    function output_profile($profile) { ?>
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

    function output_user_area() { ?>
        <h2>User Actions</h2>
        <a href="addProduct.php"><button class="button">Add Product</button>
    </a>
    <?php }

    function output_admin_area() { ?>
        <h2>Admin Area</h2>
        <div class="admin-area-buttons">
            <a href="admin_area.php?area=category"><button class="button">Add Category</button></a>
            <a href="admin_area.php?area=size"><button class="button">Add Size</button></a>
            <a href="admin_area.php?area=condition"><button class="button">Add Condition</button></a>
            <a href="manage_users.php"><button class="button">Manage Users</button></a>
        </div>
    <?php }

    function output_profile_items($favorites, $selling_items, $sold_items){ ?> 
        <h2> Favorites Items </h2> <?php
        if($favorites){
            foreach ($favorites as $favorite_item) {
                output_profile_selling_item($favorite_item);
            }
        } else {
            echo "<p> No items </p>";
        }
        
        ?> <h2> Items that you are selling </h2> <?php
        if($selling_items){
            foreach ($selling_items as $selling_item) {
                output_profile_selling_item($selling_item);
            }
        } else {
            echo "<p> No items </p>";
        }

        ?> <h2> Items that you sold </h2> <?php
        if($sold_items){
            foreach ($sold_items as $sold_item) {
                output_profile_sold_item($sold_item);
            }
        } else {
            echo "<p> No items </p>";
        }
    }

    function output_profile_selling_item($product) {    
        $db = getDatabaseConnection();     
        ?><div class="box-item">             
            <img src="<?php echo $product['firstImg'] ?>">
        
            <div class="box-details">
                <a href="/item.php?id=<?php echo $product['id']?>">
                <h3><?php echo $product['name']?></h3></a>
                <p class="info"><span>NEW</span><span><?php echo getBrand($db, $product['brand'])?></span></p>
                <div>
                    <p><?php echo $product['price']?></p>
                </div>
            </div>
        </div>
    <?php }

    function output_profile_sold_item($product) {    
        $db = getDatabaseConnection(); 
        $shipping_info_ids = getShippingIds($db, $product['id']);
    
        ?><div class="box-item">             
            <img src="<?php echo $product['firstImg'] ?>">
        
            <div class="box-details">
                <a href="/item.php?id=<?php echo $product['id']?>">
                <h3><?php echo $product['name']?></h3></a>
                <p class="info"><span>NEW</span><span><?php echo getBrand($db, $product['brand'])?></span></p>
                <div>
                    <p><?php echo $product['price']?></p>
                    <a href="shipping_form.php?product_id=<?php echo $product['id']; ?>&purchase_id=<?php echo $shipping_info_ids['purchase_id'];?>"><button class="button">Print Shipping Forms</button></a>
                </div>
            </div>
        </div>
    <?php }
    

    function output_profile_logged($profile, $favorites, $selling_items, $sold_items) { ?>
        <section class="profile-page"><?php
            output_profile_top($profile);
            output_user_area();
            output_profile_items($favorites, $selling_items, $sold_items); ?>
        </section><?php
    }
    function output_profile_logged_admin($profile, $favorites, $selling_items, $sold_items) { ?>
        <section class="profile-page"><?php
            output_profile_top($profile);?>
            <p>You are an admin</p><?php
            output_user_area();
            output_admin_area();
            output_profile_items($favorites, $selling_items, $sold_items); ?>
        </section><?php
    }

    function output_profile_other_user($profile){ ?>
        <section class="profile-page"><?php
            output_profile_top($profile);?>
        </section><?php
    }



    function output_profile_purchases($purchases){
        foreach($purchases as $purchase){
        ?>
            <p><a href="/purchase.php?id=<?= $purchase['id']?>">Purchase on <?= $purchase['date']?> | <?= $purchase['cost']?></a></p>
        <?php
        }
    }

?>

