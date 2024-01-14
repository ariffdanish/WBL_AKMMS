<?php include 'header.php';?>

<body style="background-image: url(&quot;bg4.gif&quot;);">
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;bg.jpg&quot;);"></div>
                    </div>


                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Welcome Back !</h4>
                                    </div>

                                    <div class="container">
                                        <form method="POST" action="loginprocess.php" class="user">
                                            <div class="form-group">
                                                <label for="staffId">Staff ID:</label>
                                                <input class="form-control" type="text" id="staffId" placeholder="Enter Staff ID" name="fid">
                                            </div><br>

                                            <div class="form-group">
                                                <label for="password">Password:</label>
                                                <input class="form-control" type="password" id="password" placeholder="Password" name="fpwd">
                                            </div><br>

                                            <div class="form-group form-check">
                                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember Me</label>
                                            </div><br>

                                            <button class="btn btn-primary btn-block mx-auto" type="submit">Login</button>
                                        </form>
                                    </div>

                            <div class="text-center mt-3">
                                <a class="small" href="forgotpassword.php">Forgot Password?</a>
                            </div>
                            <div class="text-center mt-2">
                                <p class="small">Don't have an account? <a href="register.php">Register Here</a></p>
                            </div>


                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include 'footer.php';?>