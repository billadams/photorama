<?php include('partials/header.php'); ?>

<div class="container">

    <form action="index.php" method="post" id="form-register" class="form-signin">
        <input type="hidden" name="action" value="register">
        <h2 class="form-signin-heading">Create new account</h2>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-warning">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="inputUsername" class="sr-only">Username</label>
            <input type="text" id="inputUsername" class="form-control" placeholder="Desired username" required autofocus name="username" value="<?php echo htmlspecialchars($username); ?>">
        </div>
        <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required name="email" value="<?php echo htmlspecialchars($email); ?>">
        </div>
        <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password" value="<?php echo htmlspecialchars($password); ?>">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPasswordVerify" class="form-control" placeholder="Retype Password" required name="confirm_password" value="<?php echo htmlspecialchars($password_confirm); ?>">
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    </form>

</div> <!-- /container -->

<?php include('partials/header.php'); ?>