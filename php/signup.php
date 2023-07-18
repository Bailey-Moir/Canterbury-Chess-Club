<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "header.php"; ?>
	<title>Canterbury Chess Club</title>
</head>
<body>
	<?php include "modules/navbar/navbar.php"; ?>
	<div id="main">
        
        <div class="row justify-content-center">
            <div class="col-6">

                <div class="card" style="padding-bottom: 20px; border-radius: 0px;"> 
                    <h3 class="card-header">
                        Sign up
                       <p>By making an account with us you equip yourself with access to club forums, games studies and more.</p>
                    </h3>

                    <form-signup style="border-radius: 0px; padding-top: 15px; width: 80%;">
                        
                        <div class="form-floating border-secondary" style="border-radius: 0px;">
                            <input type="email" class="form-control" id="floatingInput" placeholder="Examplename123">
                            <label for="floatingInput">Username</label>
                        </div>

                        <div class="form-floating border-secondary" style="border-radius: 0px;">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        

                        <div class="form-floating border-secondary" style="border-radius: 0px;">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                            <span class="material-symbols-outlined">eye-open</span>
                        </div>

                        <a href="/php/account.php" style="text-decoration: none; color: white; "><button class="btn btn-primary w-100 py-2" type="submit">Sign up</button></a>
                        
                    </form>

                </div>

            </div>
        </div>
        
	</div>
	<?php include "modules/footer/footer.php"; ?>
</body>
</html>