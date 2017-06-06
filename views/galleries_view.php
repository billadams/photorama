<?php include('partials/header.php'); ?>

    <div class="container">
        <h1>Photo Galleries</h1>

        <?php foreach ($users as $user) : ?>

            <div class="row col-md-6 col-md-offset-3 gallery_snapshot">
                <div class="col-md-4">
                    <img src="<?php echo htmlspecialchars($user['profile_image']); ?>">
                </div>
                <div class="col-lg-8">
                    <h1><?php echo htmlspecialchars($user['username']); ?></h1>
                    <p><a class="btn btn-default btn-primary" href="index.php?action=view_profile&user_id=<?php echo htmlspecialchars($user['user_id']); ?>">View Profile</a></p>
                </div>
            </div>

        <?php endforeach; ?>

    </div>  <!-- /.container -->

<?php include('partials/footer.php');