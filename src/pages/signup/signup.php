<h3 class="card-header">
    Sign up
</h3>

<form-signup style="border-radius: 0px; padding-top: 15px; width: 80%;" action="verify2.php" method="post">
    <p>By making an account with us you equip yourself with access to club forums, games studies and more.</p>
    
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
        <span class="material-symbols-outlined">eye-open</span>
    </div>
    
    <button class="btn btn-primary w-100 py-2" type="submit">Sign up</button>
</form>