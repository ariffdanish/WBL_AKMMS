<?php 
include('mysession.php');
if (!session_id()) {
    session_start();
}
//Get Booking ID from URL
if(isset($_GET['id']))
{
    $fbid=$_GET['id'];
}
include ('dbconnect.php');

$sqlr ="SELECT *FROM tb_quotation
        WHERE q_id = $fbid";

//Execute 
$resultr=mysqli_query($con,$sqlr);
$rowr=mysqli_fetch_array($resultr);
include('headerNav.php');
?>

<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-12">
            <div class="row justify-content-center">

                <!-- Order Information Card -->
                <div class="col-lg-6 ">
                    <div class="card shadow">
                        <div class="card-header bg-gradient-primary text-white text-center">
                            <h3 class="mb-0">Order Information</h3>
                        </div>

                        <div class="card-body">
                        <form method="POST" action="customereditQuotationADVprocess.php" class="user">
                        <?php echo'<input type="hidden" value="'.$rowr['q_id'].'" name="fbid">';?>

                        <div class="row mb-3">
                            <label for="ctype" class="col-sm-3 col-form-label">Customer Type:</label>
                            <div class="col-sm-9">
                            <?php 
                                $sql="SELECT * FROM tb_order";
                                $result=mysqli_query($con,$sql);
                        
                                echo'<select class="form-select" id="q_ordID" placeholder="Select" name="q_ordID">';
                                while($row=mysqli_fetch_array($result))
                                {
                                  echo"<option value='".$row['Ord_id']."'>".$row['Ord_name']."</option>";
                                }
                                
                                echo'</select>';
                            ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="orderName" class="col-sm-3 col-form-label">Item Description:</label>
                            <div class="col-sm-9">
                            <?php echo'<input class="form-control" type="text" value="'.$rowr['q_itemDesc'].'" id="q_itemDesc" name="q_itemDesc" required>';?>
                            </div>
                        </div>
                        

                        <!--<div class="row mb-3">
                            <label for="item" class="col-sm-3 col-form-label">Select Item:</label>
                            <div class="col-sm-9">
                            <select id="Ord_itemName" name="Ord_itemName" class="form-control" required onchange="updateMaterialOptions()">
                                <option value="clothes">Clothes</option>
                                <option value="book">Book</option>
                                <option value="banner">Banner</option>
                                <option value="signboard">Signboard</option>
                                <option value="bag">Bag</option>
                                <option value="sport bottle">Sport Bottle</option>
                            </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="material" class="col-sm-3 col-form-label">Select Material:</label>
                            <div class="col-sm-9">
                            <select id="Ord_itemMaterial" name="Ord_itemMaterial" class="form-control">
                            </select>
                            </div>
                        </div>--> 

                        <div class="row mb-3">
                            <label for="quantity" class="col-sm-3 col-form-label">Quantity:</label>
                            <div class="col-sm-9">
                            <?php echo'<input class="form-control" type="number" value="'.$rowr['q_quantity'].'" id="q_quantity" name="q_quantity">';?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-sm-3 col-form-label">Unit Price (RM):</label>
                            <div class="col-sm-9">
                            <?php echo'<input class="form-control" type="number" value="'.$rowr['q_price'].'" id="q_price" name="q_price">';?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="discount" class="col-sm-3 col-form-label">Discount % (RM):</label>
                            <div class="col-sm-9">
                            <?php echo'<input class="form-control" type="number" value="'.$rowr['q_discount'].'" id="q_discount" name="q_discount">';?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tax" class="col-sm-3 col-form-label">Tax Amount % (RM):</label>
                            <div class="col-sm-9">
                            <?php echo'<input class="form-control" type="number" value="'.$rowr['q_tax'].'" id="q_tax" name="q_tax">';?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tax" class="col-sm-3 col-form-label">Total Cost Inc. Tax (RM):</label>
                            <div class="col-sm-9">
                            <?php echo'<input class="form-control" type="number" value="'.$rowr['q_totalcost'].'" id="q_totalcost" name="q_totalcost">';?>
                            </div>
                        </div>

                                <div class="mb-3 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Place Order</button>
                                    <button type="reset" class="btn btn-dark mx-2">Reset</button>
                                    <a class="btn btn-danger" href="customerQuotationADV.php">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>

    // Function to add options to a select element
    function addOption(selectElement, value, text) {
        var option = document.createElement("option");
        option.value = value;
        option.text = text;
        selectElement.add(option);
    }
</script>


<?php include 'footer.php';?>
