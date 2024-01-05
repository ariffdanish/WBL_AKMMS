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

$sqlr ="SELECT *FROM tb_order
        WHERE Ord_id = $fbid";

//Execute 
$resultr=mysqli_query($con,$sqlr);
$rowr=mysqli_fetch_array($resultr);
include 'headerNav.php';
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


                        <form method="POST" action="customereditADVprocess.php" class="user">
                            <?php echo'<input type="hidden" value="'.$rowr['Ord_id'].'" name="fbid">';?>

                        <div class="row mb-3">
                            <label for="ctype" class="col-sm-3 col-form-label">Customer Type:</label>
                            <div class="col-sm-9">
                            <?php 
                                $sql="SELECT * FROM tb_customer";
                                $result=mysqli_query($con,$sql);
                        
                                echo'<select class="form-select" id="Ord_cid" placeholder="Select" name="Ord_cid">';
                                while($row=mysqli_fetch_array($result))
                                {
                                  echo"<option value='".$row['c_id']."'>".$row['c_name']."</option>";
                                }
                                
                                echo'</select>';
                            ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="orderDate" class="col-sm-3 col-form-label">Order Date:</label>
                            <div class="col-sm-9">
                            <?php echo'<input class="form-control" type="date" value="'.$rowr['Ord_date'].'" id="Ord_date" name="Ord_date" required>';?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="orderName" class="col-sm-3 col-form-label">Order Name:</label>
                            <div class="col-sm-9">
                            <?php echo'<input class="form-control" type="text" value="'.$rowr['Ord_name'].'" id="Ord_name" name="Ord_name" required>';?>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="orderType" class="col-sm-3 col-form-label">Order Type:</label>
                            <div class="col-sm-9">
                            <?php 
                                $sql="SELECT * FROM tb_ordertype";
                                $result=mysqli_query($con,$sql);
                        
                                echo'<select id="Ord_type" name="Ord_type" class="form-control" required>';
                                while($row=mysqli_fetch_array($result))
                                {
                                  echo"<option value='".$row['OT_id']."'>".$row['OT_desc']."</option>";
                                }
                                
                                echo'</select>';
                            ?>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="item" class="col-sm-3 col-form-label">Select Item:</label>
                            <div class="col-sm-9">
                            <?php
                                $sql="SELECT * FROM tb_order";
                                $result=mysqli_query($con,$sql);

                            echo'<select id="Ord_itemName" name="Ord_itemName" class="form-control" required onchange="updateMaterialOptions()">';
                            while($row=mysqli_fetch_array($result))
                            {
                            echo"<option value='".$row['Ord_id']."'>".$row['Ord_itemName']."</option>";
                            }
                            echo'</select>';
                            ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="material" class="col-sm-3 col-form-label">Select Material:</label>
                            <div class="col-sm-9">
                            <?php
                                $sql="SELECT * FROM tb_order";
                                $result=mysqli_query($con,$sql);
                        
                                echo'<select id="Ord_itemMaterial" name="Ord_itemMaterial" class="form-control">';
                                while($row=mysqli_fetch_array($result))
                                {
                                echo"<option value='".$row['Ord_id']."'>".$row['Ord_itemMaterial']."</option>";
                                }
                            echo'</select>';
                            ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="quantity" class="col-sm-3 col-form-label">Quantity:</label>
                            <div class="col-sm-9">
                            <?php echo'<input class="form-control" type="number" value="'.$rowr['Ord_itemQuantity'].'" id="Ord_itemQuantity" name="Ord_itemQuantity">';?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-sm-3 col-form-label">Unit Price (RM):</label>
                            <div class="col-sm-9">
                            <?php echo'<input class="form-control" type="number" value="'.$rowr['Ord_itemPrice'].'" id="Ord_itemPrice" name="Ord_itemPrice">';?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="discount" class="col-sm-3 col-form-label">Discount % (RM):</label>
                            <div class="col-sm-9">
                            <?php echo'<input class="form-control" type="number" value="'.$rowr['Ord_itemDiscount'].'" id="Ord_itemDiscount" name="Ord_itemDiscount">';?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tax" class="col-sm-3 col-form-label">Tax Amount % (RM):</label>
                            <div class="col-sm-9">
                            <?php echo'<input class="form-control" type="number" value="'.$rowr['Ord_itemTax'].'" id="Ord_itemTax" name="Ord_itemTax">';?>
                            </div>
                        </div>

                                <div class="mb-3 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Place Order</button>
                                    <button type="reset" class="btn btn-dark mx-2">Reset</button>
                                    <a class="btn btn-danger" href="customerorderADV.php">Cancel</a>
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
    // Function to update material options based on the selected item
    function updateMaterialOptions() {
        var selectedItem = document.getElementById("Ord_itemName").value;
        var materialSelect = document.getElementById("Ord_itemMaterial");

        // Clear existing options
        materialSelect.innerHTML = "";

        // Add material options based on the selected item
        if (selectedItem === "Clothes") {
            addOption(materialSelect, "Jersey", "Jersey");
            addOption(materialSelect, "Cotton", "Cotton");
        } else if (selectedItem === "Book") {
            addOption(materialSelect, "A5", "A5");
            addOption(materialSelect, "B5", "B5");
            addOption(materialSelect, "F4", "F4");
        } else if (selectedItem === "Banner" || selectedItem === "Signboard" || selectedItem === "Bag" || selectedItem === "Sport Bottle") {
            // For banner and signboard, add a default option with value "-"
            addOption(materialSelect, "-", "-", "-", "-");
        }

        // You can add more conditions for additional items

    }

    // Function to add options to a select element
    function addOption(selectElement, value, text) {
        var option = document.createElement("option");
        option.value = value;
        option.text = text;
        selectElement.add(option);
    }
</script>


<?php include 'footer.php';?>
