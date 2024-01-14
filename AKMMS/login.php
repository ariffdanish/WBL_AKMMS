<?php include 'header.php';?>

<body style="background-color: white;">
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;assets/img/AKMMS/bg.jpg&quot;);"></div>
                    </div>


                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Welcome Back !</h4>
                                    </div>
                                    <form method="POST" action="loginprocess.php" class="user">
                                        <div class="mb-3"><input class="form-control form-control-user" type="type" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Staff ID" name="fid"></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="fpwd"></div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label></div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary d-block btn-user w-100" type="submit">Login</button><br>
                                    </form>
                                    <div class="text-center"><a class="small" href="forgotpassword.php">Forgot Password?</a></div>
                                    <div class="text-center"><a class="small" href="register.php">Register Account</a></div>
                                </div>
                            </div>

                
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>