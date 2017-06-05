<?php include('partials/header.php'); ?>

    <div class="container">
        <h1>Photo Galleries</h1>

        <?php foreach ($users as $user) : ?>

            <div class="row col-md-8 col-md-offset-2 gallery_snapshot">
                <div class="col-md-4">
                    <img src="<?php echo $user['profile_image']; ?>">
                </div>
                <div class="col-md-8">
                    <h1><?php echo $user['username']; ?></h1>
                    <p>Number of galleries: WIP</p>
                    <p>Number of images: WIP</p>
                </div>
            </div>

        <?php endforeach; ?>

    </div>  <!-- /.container -->

<?php include('partials/footer.php');