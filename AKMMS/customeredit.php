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
    $sqlr ="SELECT c_id, c_idnum, c_name, c_phone, c_address, c_email, c_type, c_typeOrd 
            FROM tb_customer
            WHERE c_id=$fbid";
    


    //Execute 
    $resultr=mysqli_query($con,$sqlr);
    $rowr=mysqli_fetch_array($resultr);
    include 'headerNav.php';
?>


    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Customer Edit Form</h3>
        </div>

        <div class="row">
        <form method="POST" action="customereditprocess.php" class="user">
            <?php echo '<input type="hidden" value="'.$rowr['c_id'].'" name="fbid">'; ?>

                    <div class="mb-3">
                        <?php echo'<input class="form-control form-control-user" type="text" value="'.$rowr['c_idnum'].'" id="exampleFirstName" placeholder="Customer ID" name="cidnum">'?>
                    </div>
                    <div class="mb-3">
                        <?php echo'<input class="form-control form-control-user" type="text" value="'.$rowr['c_name'].'" id="exampleFirstName" placeholder="Full Name" name="cname">'?>
                    </div>
                    <div class="mb-3">
                        <?php echo'<input class="form-control form-control-user" type="text" value="'.$rowr['c_phone'].'" id="exampleFirstName" placeholder="Phone No" name="cphone">'?>
                    </div>
                    <div class="mb-3">
                        <?php echo'<input class="form-control form-control-user" type="text" value="'.$rowr['c_address'].'" id="exampleTextarea" placeholder="Address" name="caddress" rows="2">'?>
                    </div>
                    <div class="mb-3">
                        <?php echo'<input class="form-control form-control-user" type="text" value="'.$rowr['c_email'].'"  id="exampleFirstName" placeholder="Email" name="cemail">'?>
                    </div>

                    <div class="mb-3">
                        <select class="form-select form-control form-control-user" id="exampleSelect1" name="ctype">
                            <option <?php echo ($rowr['c_type'] == 'Personnel') ? 'selected' : ''; ?>>Personnel</option>
                            <option <?php echo ($rowr['c_type'] == 'Agency') ? 'selected' : ''; ?>>Agency</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <select class="form-select form-control form-control-user" id="exampleSelect1" name="ctypeOrd">
                            <option <?php echo ($rowr['c_typeOrd'] == 'Advertising') ? 'selected' : ''; ?>>Advertising</option>
                            <option <?php echo ($rowr['c_typeOrd'] == 'Construction') ? 'selected' : ''; ?>>Construction</option>
                        </select>
                    </div>
            
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-dark">Reset</button>
                    <a type="cancel" class="btn btn-danger" href="customerdetails.php">Cancel</a>
        </form>
        </div>
    </div>

<?php include 'footer.php';?>