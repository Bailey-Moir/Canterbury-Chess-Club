<!-- Gavith -->
<h3 class="card-header">
    Sign up
</h3>

<form class="card-body" style="padding-bottom: 30px !important; padding-top: 10px !important; padding-left: 60px !important; padding-right: 60px !important;" action="/src/pages/signup/verify.php" method="post">
    <div class="form-floating border-secondary" style="border-radius: 0px;">
        <input type="text" class="form-control" id="floatingInput" placeholder="#" name="username">
        <label for="floatingInput">Username</label>
    </div>

    <div class="form-floating border-secondary" style="border-radius: 0px;">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
        <label for="floatingInput">Email address</label>
    </div>
    

    <div class="form-floating border-secondary" style="border-radius: 0px;">
        <input type="password" class="form-control" id="floatingPassword" placeholder="password" name="password">
        <label for="floatingPassword">Password</label>
    </div>
    
    <?php
    if(isset($_GET['error'])) {
        ?>
        <div class="alter alert-danger text-danger pb-3" role="alert" style="color: red;">
            Username, Email or Password is already in use, please use something else
        </div>
        <?php 
    } 
    ?>
    
    <button class="btn btn-primary w-100 py-2" type="submit">Sign up</button>
</form>