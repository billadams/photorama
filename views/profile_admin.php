<?php include('partials/header.php'); ?>

<?php //var_dump($user_images);
//var_dump($user_image_library);
      //var_dump($user); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img src="<?php echo $user->get_profile_image(); ?>">
                <p class="text-muted">Change profile image. For best results, use an image that is 150px x 150px.</p>
                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="update_profile_image">
                    <input type="file" name="image" id='choose_file'>
<!--                    <input type="submit"/>-->
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Change Image</button>
                </form>
            </div>
            <div class="col-md-10">
                <h1><?php echo $user->get_username(); ?></h1>
                <p>Number of galleries: </p>
                <p>Number of images: </p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <h2><?php echo $user->get_username(); ?>'s Galleries</h2>
            </div>
        </div>

        <?php foreach ($user_image_library as $user_image) : ?>
            <div class="row">
                <div class="col-md-12">
                    <h3><?php echo $user_image['category => category_name']; ?></h3>
                    <img src="<?php echo $user_image['image_path']; ?>" alt="User Image">
                    <p><?php echo $user_image['caption']; ?></p>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>

<!--        <div class="row">-->
<!--            <div class="col-md-12">-->
<!--                <h3>Colorado</h3>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <hr>-->
<!---->
<!--        <div class="row">-->
<!--            <div class="col-md-12">-->
<!--                <h3>Ocean</h3>-->
<!--            </div>-->
<!--        </div>-->

    </div> <!-- /container -->

<?php include('partials/header.php'); ?>