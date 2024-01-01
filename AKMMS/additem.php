<?php include 'headerNav.php';?>

        
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Add Item</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">What Item Do You Want To Add?</p>
                        </div>

                        <div class="card-body">
                            
                            
                            <form method="POST" action="additemprocess.php" class="user">
                                <h6>Item Name</h6>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Kayu Jati, etc." name="iname" required></div>
                                <h6>Item Code</h6>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="WD634-2, etc." name="icode" required></div>
                                <h6>Item Date</h6>
                                <div class="mb-3"><input class="form-control form-control-user" type="date" id="exampleFirstName" placeholder="01/01/2024" name="idate" required></div>
                                <h6>Item Description</h6>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Keterangan barang" name="idesc" required></div>
                                <h6>Item Category</h6>
                                <div class="mb-3">
                                <select class="form-select form-control form-control-user" id="exampleSelect1" placeholder="Kategori" name="icategory" required>
                                    <option>Advertising</option>
                                    <option>Construction</option>
                                </select>
                                </div>
                                <h6>Item Height</h6>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Tinggi (cm)" name="iheight" required></div>
                                <h6>Item Width</h6>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Lebar (cm)" name="iwidth" required></div>
                                <h6>Item Depth</h6>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Kedalaman (cm)" name="idepth" required></div>
                                <h6>Item Length</h6>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Panjang (cm)" name="ilength" required></div>
                                <h6>Item Weight</h6>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Berat (kg)" name="iweight" required></div>
                                <h6>Item Material</h6>
                                <div class="mb-3">
                                <select class="form-select form-control form-control-user" id="exampleSelect1" placeholder="Jenis barang" name="imaterial" required>
                                    <option>Kayu</option>
                                    <option selected>Besi</option>
                                    <option>Plastik</option>
                                    <option>Kaca</option>
                                </select>
                                </div>
                                <h6>Item Quantity</h6>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Nombor Bulat sahaja" name="iquantity" required></div>
                                <h6>Item Price per Unit</h6>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="(RM, 2 t.p.)" name="iprice" required></div>
                                    <button class="btn btn-primary d-block btn-user w-100" type="reset">Reset</button><br>
                                    <button class="btn btn-primary d-block btn-user w-100" type="submit">Add Item</button><br>
                            </form>
                            

                        </div>
                    </div>
                </div>
            </div>
<?php include 'footer.php';?>
