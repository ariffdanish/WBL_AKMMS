<?php include 'headerNav.php';?>

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
                                <h4 class="text-dark mb-4">Add Item</h4>
                            </div>
                            <form method="POST" action="additemprocess.php" class="user">
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Item Name" name="iname"></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Item Code" name="icode"></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Item Description" name="idesc"></div>
                                <div class="mb-3">
                                <select class="form-select form-control form-control-user" id="exampleSelect1" placeholder="Item Category" name="icategory">
                                    <option>Advertising</option>
                                    <option>Construction</option>
                                </select>
                                </div>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Item Height (cm)" name="iheight"></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Item Width (cm)" name="iwidth"></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Item Depth (cm)" name="idepth"></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Item Length (cm)" name="ilength"></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Item Weight (kg)" name="iweight"></div>
                                <select class="form-select form-control form-control-user" id="exampleSelect1" placeholder="Item Material" name="imaterial">
                                    <option>Wood</option>
                                    <option>Steel</option>
                                </select>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Item Quantity" name="iquantity"></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Item Price" name="iprice"></div>
                                    <button class="btn btn-primary d-block btn-user w-100" type="submit">Add Item</button><br>
                            </form>

                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php';?>