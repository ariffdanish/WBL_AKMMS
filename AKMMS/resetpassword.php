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
                                <h4 class="text-dark mb-4">Reset Password</h4>
                            </div>
                            <form method="POST" action="resetprocess.php" class="user">
                                <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleFirstName" placeholder="Enter new password" name="password"></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleFirstName" placeholder="Repeat new password" name="password"></div>
                                <button class="btn btn-primary d-block btn-user w-100" type="submit">Reset</button><br>
                            </form>
                            <div class="text-center"><a class="small" href="index.php">Already have an account? Login!</a></div>
                        </div>
                        
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>