<?php 
    function output_profile($profile) { ?>
        <h2>User Profile</h2>
        <section id="profile_info">
            <label>Name: <span id="name"><?php echo $profile['name']?></span></label>
            <label>Username: <span id="username"><?php echo $profile['username']?></span></label>
            <label>Email: <span id="email"><?php echo $profile['email']?></span></label>
            <img src=<?php echo $profile['profileImg']?> alt="Profile Image" id="profile_image">
        </section>
    <?php }
?>