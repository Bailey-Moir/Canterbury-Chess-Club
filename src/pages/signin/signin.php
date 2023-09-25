<!-- Gavith -->
<?php
if (isset($_SESSION['logged_in'])) 
    if ($_SESSION['logged_in']['admin'] == TRUE) header("Location: /chessclub/admin");
    else header("Location: /chessclub/accounts/".urlencode($_SESSION['logged_in']['name'])."/games");
?>

<h3 class="card-header">
    Sign in
</h3>

<form class="card-body" style="padding-bottom: 10px !important; padding-top: 10px !important; padding-left: 60px !important; padding-right: 60px !important;" action="/chessclub/src/pages/signin/verify.php" method="post">
    <div class="form-floating border-secondary" style="border-radius: 0px;">
        <input type="text" class="form-control" id="floatingInput" name="username-or-email" >
        <label for="floatingInput">Username or Email</label>
    </div>

    <div class="form-floating border-secondary" style="border-radius: 0px;">
        <input type="password" class="form-control" id="floatingPassword" name="password">
        <label for="floatingPassword">Password</label>
    </div>

    <div class="form-check text-start mb-3" style="border-radius: 0px;">
        <!-- <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            Remember me
        </label> -->

        <a href="/chessclub/signin/forgotpassword" style="float: right;">
            Forgot password?
        </a>
    </div>

    <?php
    if(isset($_GET['error'])) {
        ?>
        <div class="alter alert-danger" role="alert" style="color: red; padding-bottom: 10px;    ">
            Username or password is incorrect
        </div>
        <?php 
    } 
    ?>

    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
            
    <p class="p pt-2">
        Don't have an account? <a href="/chessclub/signup">Sign up</a> instead.
    </p>
</form>