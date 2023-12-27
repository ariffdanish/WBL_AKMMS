<?php include 'headerNav.php';?>


                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Customer Form</h3>
                    </div>

                    <div class="row">
                    <form class="user">
                                <div class="mb-3"><label for="exampleSelect1" class="form-label mt-4">Fullname</label><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Full Name" name="cname"></div>
                                <div class="mb-3"><label for="exampleSelect1" class="form-label mt-4">Phone No</label><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Phone No" name="cphone"></div>
                                <div class="mb-3"><label for="exampleSelect1" class="form-label mt-4">Address</label><textarea class="form-control form-control-user" type="text" id="exampleTextarea" placeholder="Address" name="caddress" rows="2"></textarea></div>
                                <div class="mb-3"><label for="exampleSelect1" class="form-label mt-4">Email</label><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Email" name="cemail"></div>
                                <div class="mb-3">
                                <label for="exampleSelect1" class="form-label mt-4">Type</label>
                                <select class="form-select form-control form-control-user" id="exampleSelect1" placeholder="Select" name="ctype">
                                    <option>Select</option>
                                    <option>Personnel</option>
                                    <option>Agency</option>
                                    <option>Goverment</option>
                                </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-dark">Reset</button>
                                <a type="cancel" class="btn btn-danger" href="customerdetails.php">Cancel</a>
                            </form>
                    </div>
                    
                </div>

<?php include 'footer.php';?>