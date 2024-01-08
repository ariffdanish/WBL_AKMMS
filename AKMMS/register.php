<?php 
include ('dbconnect.php');
include 'header.php';?>

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
                                <h4 class="text-dark mb-4">Register Account</h4>
                            </div>
                            <form method="POST" action="registerprocess.php" class="user">
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Full Name" name="fname"></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Staff ID" name="fid"></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email Address" name="femail"></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Telephone No" name="ftel"></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="password" id="examplePasswordInput" placeholder="Password" name="fpwd"></div>
                                <div class="mb-3">
                                <?php 
                                $sql="SELECT * FROM tb_emprole";
                                $result=mysqli_query($con,$sql);
                        
                                echo'<select class="form-select form-control form-control-user" id="exampleSelect1" placeholder="Select" name="ftype">';
                                while($row=mysqli_fetch_array($result))
                                {
                                  echo"<option value='".$row['role_id']."'>".$row['role_desc']."</option>";
                                }
                                
                                echo'</select>';
                              ?>
                                </div>
                                <button class="btn btn-primary d-block btn-user w-100" type="submit">Register Account</button><br>
                            </form>
                            <div class="text-center"><a class="small" href="forgotpassword.php">Forgot Password?</a></div>
                            <div class="text-center"><a class="small" href="index.php">Already have an account? Login!</a></div>
                        </div>
                    </div> 
                    
                    
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>