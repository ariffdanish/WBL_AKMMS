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
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow">
            <div class="card-header text-center bg-primary">
                <h3 class="text-white mb-0 font-weight-bold">Customer Form</h3>
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
                            <select class="form-select" id="ctype" name="ctype">
                                <option disabled selected>Select Customer Type</option>
                                <option>Personnel</option>
                                <option>Agency</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ctypeOrd" class="form-label">Order Type</label>
                            <select class="form-select" id="ctypeOrd" name="ctypeOrd">
                                <option disabled selected>Select Order Type</option>
                                <option>Advertising</option>
                                <option>Construction</option>
                            </select>
                        </div>
                        <div class="mb-3 d-flex justify-content-center gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-dark mx-2">Reset</button>
                            <a type="cancel" class="btn btn-danger" href="customerdetails.php">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'footer.php';?>