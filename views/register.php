<?php include('partials/header.php'); ?>

<div class="container">

    <form action="index.php" method="post" id="form-register" class="form-signin">
        <input type="hidden" name="action" value="register_attempt">
        <h2 class="form-signin-heading">Create new account</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPasswordVerify" class="form-control" placeholder="Retype Password" required name="password_verify">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    </form>

</div> <!-- /container -->

<?php include('partials/header.php'); ?>