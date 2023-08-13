<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "header.php"; ?>
	<title>Canterbury Chess Club</title>
</head>
<body>
	
    <div id="main">

        <div class="row justify-content-center" style="width: 100%; margin-top: 15%;">
            <p><a class="navbar-brand" href="/php/pages/home/index.php"><img src="/res/black_logo.svg" alt="Icon"></a></p>
            <div class="col-6">

                <div class="card" style="padding-bottom: 20px; border-radius: 0px;"> 
                    <h3 class="card-header">
                        Forgot Password
                       <p>Please enter your email address below and we will send you information to change your password.</p>
                    </h3>

                    <form style="border-radius: 0px; padding-top: 15px; width: 80%;" action="#" method="post">

                    <div class="form-floating border-secondary" style="border-radius: 0px;">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                        <label for="floatingInput">Email address</label>
                    </div>


                    <button class="btn btn-primary w-100 py-2" type="submit">Send Email</button>
                </form>

                </div>
            </div>
	</div>
	
</body>
</html>