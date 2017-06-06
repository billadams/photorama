<?php include('partials/header.php'); ?>

<div class="container">

    <form action="index.php" method="post" class="form-signin">
        <input type="hidden" name="action" value="login">
        <h2 class="form-signin-heading">Please sign in</h2>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-warning">
                <?php foreach ($errors as $error) : ?>
                    <ul>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    </ul>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <label for="inputUsername" class="sr-only">Email address</label>
        <input type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus name="username" value="<?php echo htmlspecialchars($username); ?>">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password" value="<?php echo htmlspecialchars($password); ?>">
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

</div> <!-- /container -->

<?php include('partials/header.php'); ?>