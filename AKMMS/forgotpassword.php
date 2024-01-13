<?php include 'header.php';?>

<body style="background-image: url(&quot;bg4.gif&quot;);">
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
                            <form method="POST" action="forgotprocess.php" class="user">
                                <div class="form-group">
                                    <label for="email">Email Address:</label>
                                    <input class="form-control" type="email" id="email" placeholder="Enter Your Email Address" name="email">
                                </div><br>

                                <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                            </form>

                            <div class="text-center mt-3">
                                <p class="small">Remember your password? <a href="index.php">Login here</a></p>
                            </div>
                        
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>