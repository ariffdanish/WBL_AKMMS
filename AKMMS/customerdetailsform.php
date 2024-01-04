<?php 
    include ('mysession.php');
        if(!session_id())
        {
            session_start();
        }
    include 'headerNav.php';
    include ('dbconnect.php');
?>


<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-gradient-primary text-white text-center">
                            <h3 class="mb-0">Customer Information</h3>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="customerdetailsformprocess.php" class="user">
                            <div class="mb-3">
                            <label for="cidnum" class="form-label">Customer ID</label>
                            <input class="form-control" type="text" id="cidnum" placeholder="Enter Customer ID" name="cidnum">
                        </div>
                        <div class="mb-3">
                            <label for="cname" class="form-label">Full Name</label>
                            <input class="form-control" type="text" id="cname" placeholder="Enter Full Name" name="cname">
                        </div>
                        <div class="mb-3">
                            <label for="cphone" class="form-label">Phone No</label>
                            <input class="form-control" type="text" id="cphone" placeholder="Enter Phone No" name="cphone">
                        </div>
                        <div class="mb-3">
                            <label for="caddress" class="form-label">Address</label>
                            <textarea class="form-control" id="caddress" placeholder="Enter Address" name="caddress" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="cemail" class="form-label">Email</label>
                            <input class="form-control" type="text" id="cemail" placeholder="Enter Email" name="cemail">
                        </div>

                        <div class="mb-3">
                            <label for="ctype" class="form-label">Customer Type</label>
                            <?php 
                                $sql="SELECT * FROM tb_custtype";
                                $result=mysqli_query($con,$sql);
                        
                                echo'<select class="form-select" id="ctype" placeholder="Select" name="ctype">';
                                while($row=mysqli_fetch_array($result))
                                {
                                  echo"<option value='".$row['CT_id']."'>".$row['CT_desc']."</option>";
                                }
                                
                                echo'</select>';
                            ?>
                        </div>
                        <div class="mb-3 d-flex justify-content-center gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-dark mx-2">Reset</button>
                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


<?php include 'footer.php';?>