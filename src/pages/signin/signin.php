<?php
if(isset($_SESSION['admin'])) header("Location: /?page=adminpanel");
?>

<h3 class="card-header">
    Sign in
</h3>

<form style="border-radius: 0px; padding-top: 15px; width: 80%;" action="/src/pages/signin/verify.php" method="post">

    <div class="form-floating border-secondary" style="border-radius: 0px;">
        <input type="text" class="form-control" id="floatingInput" placeholder="#" name="username-or-email" >
        <label for="floatingInput">Username or Email</label>
    </div>

    <div class="form-floating border-secondary" style="border-radius: 0px;">
        <input type="password" class="form-control" id="floatingPassword" placeholder="password" name="password">
        <label for="floatingPassword">Password</label>
    </div>

    <div class="form-check text-start my-3" style="border-radius: 0px;">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            Remember me
        </label>

        <a href="/signin/forgotpassword" style="float: right;">
            Forgot password?
        </a>
    </div>

    <?php
    if(isset($_GET['error'])) {
        ?>
        <div class="alter alert-danger" role="alert" style="color: rgb(255, 0, 0); padding-bottom: 10px;    ">
            Username or password is incorrect
        </div>
        <?php 
    } 
    ?>

    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
</form>

<p style="padding-top: 10px;">
    Don't have an account? <a href="/signup">Sign up</a> instead.
</p>