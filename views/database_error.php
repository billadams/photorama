<?php include('views/partials/header.php'); ?>

<div class="container">
    <div class="col-md-4 col-md-offset-4">
        <h1>Database Error</h1>
        <div class="alert alert-danger">
            <p>Error connecting to database.</p>
            <p>Exception message: <?php echo htmlspecialchars($error_message); ?></p>
        </div>
    </div>
</div>

<?php include('views/partials/footer.php'); ?>
