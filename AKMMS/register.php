<?php 
include ('dbconnect.php');
include 'header.php';?>

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
                                <h4 class="text-dark mb-4">Register Account</h4>
                            </div>
                            <form method="POST" action="registerprocess.php" class="user">
                                <div class="form-group">
                                    <label for="fname">Full Name:</label>
                                    <input class="form-control" type="text" id="fname" placeholder="Enter Full Name" name="fname">
                                </div><br>

                                <div class="form-group">
                                    <label for="fid">Staff ID:</label>
                                    <input class="form-control" type="text" id="fid" placeholder="Enter Staff ID" name="fid">
                                </div><br>

                                <div class="form-group">
                                    <label for="femail">Email Address:</label>
                                    <input class="form-control" type="email" id="femail" aria-describedby="emailHelp" placeholder="Enter Email Address" name="femail">
                                </div><br>

                                <div class="form-group">
                                    <label for="ftel">Telephone No:</label>
                                    <input class="form-control" type="text" id="ftel" placeholder="Enter Telephone No" name="ftel">
                                </div><br>

                                <div class="form-group">
                                    <label for="fpwd">Password:</label>
                                    <input class="form-control" type="password" id="fpwd" placeholder="Enter Password" name="fpwd">
                                </div><br>

                                <div class="form-group">
                                    <label for="ftype">Employee Role:</label>
                                    <?php 
                                    $sql="SELECT * FROM tb_emprole";
                                    $result=mysqli_query($con,$sql);
                                    
                                    echo '<select class="form-select" id="ftype" name="ftype">';
                                    while($row=mysqli_fetch_array($result)) {
                                        echo "<option value='".$row['role_id']."'>".$row['role_desc']."</option>";
                                    }
                                    echo '</select>';
                                    ?>
                                </div><br>

                                <button class="btn btn-primary btn-block" type="submit">Register Account</button>
                            </form><br>

                            <div class="text-center mt-2">
                                <p class="small">Forgot password ? Click <a class="small" href="forgotpassword.php">here</a></p>
                            </div>
                        </div>
                    </div> 
                    
                    
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>