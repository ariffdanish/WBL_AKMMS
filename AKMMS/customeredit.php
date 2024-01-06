<?php 
    include ('mysession.php');
        if(!session_id())
        {
            session_start();
        }
    //Get Booking ID from URL
    if(isset($_GET['id']))
    {
        $fbid=$_GET['id'];
    }
    include ('dbconnect.php');

    $sqlr ="SELECT c_id, c_idnum, c_name, c_phone, c_address, c_email, c_type
            FROM tb_customer
            WHERE c_id = $fbid";
    
    //Execute 
    $resultr=mysqli_query($con,$sqlr);
    $rowr=mysqli_fetch_array($resultr);
    include 'headerNav.php';
?>


<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow">
            <div class="card-header text-center bg-primary">
            <h3 class="text-white mb-0 font-weight-bold">Customer Edit Form</h3>
        </div>

        <div class="card-body">
        <form method="POST" action="customereditprocess.php" class="user">
            <?php echo'<input type="hidden" value="'.$rowr['c_id'].'" name="fbid">';?>

                    <div class="mb-3"><label for="cidnum" class="form-label">Customer ID</label>
                        <?php echo'<input class="form-control " type="text" value="'.$rowr['c_idnum'].'" id="exampleFirstName" placeholder="Customer ID" name="cidnum">'?>
                    </div>

                    <div class="mb-3">
                        <label for="cname" class="form-label">Full Name</label>
                        <?php echo'<input class="form-control " type="text" value="'.$rowr['c_name'].'" id="exampleFirstName" placeholder="Full Name" name="cname">'?>
                    </div>

                    <div class="mb-3">
                        <label for="cphone" class="form-label">Phone No</label>
                        <?php echo'<input class="form-control " type="text" value="'.$rowr['c_phone'].'" id="exampleFirstName" placeholder="Phone No" name="cphone">'?>
                    </div>

                    <div class="mb-3">
                        <label for="caddress" class="form-label">Address</label>
                        <?php echo'<input class="form-control " type="text" value="'.$rowr['c_address'].'" id="exampleTextarea" placeholder="Address" name="caddress" rows="2">'?>
                    </div>

                    <div class="mb-3">
                        <label for="cemail" class="form-label">Email</label>
                        <?php echo'<input class="form-control " type="text" value="'.$rowr['c_email'].'"  id="exampleFirstName" placeholder="Email" name="cemail">'?>
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
                            <a type="cancel" class="btn btn-danger" href="customerdetails.php">Cancel</a>
                    </div>
        </form>
        </div>
    </div>

<?php include 'footer.php';?>