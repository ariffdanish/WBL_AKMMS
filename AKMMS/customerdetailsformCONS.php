<?php 
    include ('mysession.php');
        if(!session_id())
        {
            session_start();
        }
    include 'headerNav.php';
    include ('dbconnect.php');
?>


    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Customer Form</h3>
        </div>

        <div class="row">
        <form method="POST" action="customerdetailsformprocess.php" class="user">
                    <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Customer ID" name="cidnum"></div>
                    <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Full Name" name="cname"></div>
                    <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Phone No" name="cphone"></div>
                    <div class="mb-3"><textarea class="form-control form-control-user" type="text" id="exampleTextarea" placeholder="Address" name="caddress" rows="2"></textarea></div>
                    <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Email" name="cemail"></div>
                    <div class="mb-3">
                    <select class="form-select form-control form-control-user" id="exampleSelect1" placeholder="Select" name="ctype">
                        <option>Customer Type</option>
                        <option>Personnel</option>
                        <option>Agency</option>
                    </select>
                    </div>
                    <div class="mb-3">
                    <select class="form-select form-control form-control-user" id="exampleSelect1" placeholder="Select" name="ctypeOrd">
                        <option>Order Type</option>
                        <option>Advertising</option>
                        <option>Construction</option>
                    </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-dark">Reset</button>
                    <a type="cancel" class="btn btn-danger" href="customerorderCONS.php">Cancel</a>
                </form>
        </div>
    </div>

<?php include 'footer.php';?>