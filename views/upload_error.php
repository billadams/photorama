<?php include('partials/header.php'); ?>

<div class='container'>
    <div class="col-md-4 col-md-offset-4">
        <h2>Image Upload Error</h2>
        <?php foreach($errors as $error) : ?>
            <p class="alert alert-warning"><?php echo $error; ?></p>
        <?php endforeach; ?>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="view_admin_profile">
            <button class="btn btn-lg btn-primary btn-block" type="submit">OK</button>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>