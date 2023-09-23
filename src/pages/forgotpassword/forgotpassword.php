<h3 class="card-header">
    Forgot Password
</h3>

<center class="card-body">
    <form class="responsive" method="post" action="/src/pages/forgotpassword/sendforgot.php">
        <p class="p w-100 mb-3">Please enter your email address below and we will send you information to change your password.</p>

        <div class="form-floating border-secondary" style="border-radius: 0px;">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
            <label for="floatingInput">Email address</label>
        </div>

        <button class="btn btn-primary w-100 mb-4" type="submit">Send Email</button>
    </form>
</center>