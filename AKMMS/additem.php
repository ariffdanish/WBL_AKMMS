<?php 
include ('mysession.php');
if(!session_id())
{
    session_start();
}
include 'headerNav.php';?>

        
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
                                    <option disabled selected>-Sila Pilih-</option>
                                    <option>Advertising</option>
                                    <option>Construction</option>
                                </select>
                                </div>
                                
                                <h6>Item Type</h6>
                                <div class="mb-3">
                                <select class="form-select form-control form-control-user" id="exampleSelect1" placeholder="Jenis barang" name="imaterial" required>
                                    <option disabled selected>-Sila Pilih-</option>
                                    <option>I- PENDAWAIAN</option>
                                    <option>II- PAPAN AGIHAN, PEMUTUS LITAR DAN PERALATAN PERLINDUNGAN</option>
                                    <option>III- ALAT-ALAT LENGKAP PENDAWAIAN ELEKTRIK</option>
                                    <option>IV- LENGKAPAN PENCAHAYAAN, LAMPU, KOMPONEN-KOMPONEN LAMPU DAN KIPAS</option>
                                    <option>V- PEMASANGAN LUAR - LAMPU JALAN, LAMPU ISYARAT, DAN LAMPU KAWASAN</option>
                                    <option>VI- KABEL BAWAH TANAH DAN AKSESORI</option>
                                    <option>VII - PELBAGAI</option>
                                    <option>Kayu</option>
                                    <option>Besi</option>
                                    <option>Plastik</option>
                                    <option>Kaca</option>
                                    <option>Aluminium</option>
                                </select>
                                </div>
                                
                                <h6>Item Quantity</h6>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Nombor Bulat sahaja" name="iquantity" required></div>
                               
                                <h6>Item Price per Unit</h6>
                                <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="(RM, 2 t.p.)" name="iprice" required></div>
                                <div class="mb-3 d-flex justify-content-center gap-2">
                                    <button type="submit" class="btn btn-primary">Add Item</button>
                                    <button type="reset" class="btn btn-dark mx-2">Reset</button>
                                    <a type="cancel" class="btn btn-danger" href="browseitem.php">Cancel</a>
                                
                                </div>
                            </form>
                    </div>
                </div>
            </div>
<?php include 'footer.php';?>
