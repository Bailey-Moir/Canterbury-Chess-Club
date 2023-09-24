<!-- Gavith -->
<h3 class="card-header">
    Sign up
</h3>

<form class="card-body" style="padding-bottom: 30px !important; padding-top: 10px !important; padding-left: 60px !important; padding-right: 60px !important;" action="/src/pages/signup/verify.php" method="post">
    <div class="form-floating border-secondary" style="border-radius: 0px;">
        <input type="text" class="form-control" id="floatingInput" name="username">
        <label for="floatingInput">Username</label>
    </div>

    <div class="form-floating border-secondary" style="border-radius: 0px;">
        <input type="email" class="form-control" id="floatingInput2" name="email">
        <label for="floatingInput2">Email address</label>
    </div>
    

    <div class="form-floating border-secondary" style="border-radius: 0px;">
        <input type="password" class="form-control" id="floatingPassword" name="password">
        <label for="floatingPassword">Password</label>
    </div>
    
    <?php
    if (isset($_GET['err'])) {
        ?>
        <p class="p w-100 text-danger text-center mb-3"><?php
                 if ($_GET['err'] == "username") echo "Username may only contain alphanumeric characters, '-', '_', '.', and must be between 1 and 16 characters";
            else if ($_GET['err'] == "taken")    echo "Username or email is already in use";
            else if ($_GET['err'] == "email")    echo "Invalid email";
            else if ($_GET['err'] == "password") echo "Password must contain a captial, lowercase, digit, and be at least 8 characters";
        ?></p>
        <?php
    }
    ?>

    <button class="btn btn-primary w-100 py-2" type="submit">Sign up</button>
</form>