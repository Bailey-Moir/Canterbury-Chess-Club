<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "../../header.php"; ?>
	<title>Canterbury Chess Club</title>
</head>
<body>
	<?php include "../../modules/navbar/navbar.php"; ?>
	<div id="main">
        
        <div class="row justify-content-center" style="margin-top: 8%;">
            <p><a class="navbar-brand" href="/index.php"><img src="/res/black_logo.svg" alt="Icon"></a></p>
            <div class="col-6">

                <div class="card" style="padding-bottom: 20px; border-radius: 0px;"> 
                    <h3 class="card-header">
                        Sign up
                    </h3>

                    <form style="border-radius: 0px; padding-top: 15px; width: 80%;" action="verify.php" method="post">
                        
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

                        <?php
                            if(isset($_GET['error'])) {
                                ?>
                                <div class="alter alert-danger" role="alert" style="color: rgb(255, 0, 0); padding-bottom: 10px;    ">
                                    Useranme or Password is already in use, please use something else
                                </div>
                                <?php 
                            } 
                        ?>
                        
                        <button class="btn btn-primary w-100 py-2" type="submit">Sign up</button>
                    </form>

                </div>
            </div>
        </div>


        
	</div>
	<?php include "../../modules/footer/footer.php"; ?>
</body>
</html>