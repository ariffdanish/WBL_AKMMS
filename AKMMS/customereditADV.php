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

                        <div class="mb-3">
                            <label for="ctype" class="form-label">Customer Type</label>
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

                        <div class="mb-3">
                            <label for="orderDate" class="form-label">Order Date:</label>
                            <?php echo'<input class="form-control" type="date" value="'.$rowr['Ord_date'].'" id="Ord_date" name="Ord_date" required>';?>
                        </div>

                        <div class="mb-3">
                            <label for="orderName" class="form-label">Order Name:</label>
                            <?php echo'<input class="form-control" type="text" value="'.$rowr['Ord_name'].'" id="Ord_name" name="Ord_name" required>';?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="orderType" class="form-label">Order Type:</label>
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


                        <div class="mb-3">
                            <label for="item" class="form-label">Select Item:</label>
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

                        <div class="mb-3">
                            <label for="material" class="form-label">Select Material:</label>
                            <?php
                                $sql="SELECT * FROM tb_order";
                                $result=mysqli_query($con,$sql);
                        
                                echo'<select id="Ord_itemMaterial" name="Ord_itemMaterial" class="form-control" required>';
                                while($row=mysqli_fetch_array($result))
                                {
                                echo"<option value='".$row['Ord_id']."'>".$row['Ord_itemMaterial']."</option>";
                                }
                            echo'</select>';
                            ?>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="height" class="form-label">Height (cm):</label>
                                <?php echo'<input class="form-control" type="number" value="'.$rowr['Ord_itemHeight'].'" id="Ord_itemHeight" name="Ord_itemHeight">';?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="width" class="form-label">Width (cm):</label>
                                <?php echo'<input class="form-control" type="number" value="'.$rowr['Ord_itemWidth'].'" id="Ord_itemWidth" name="Ord_itemWidth">';?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="depth" class="form-label">Depth (cm):</label>
                                <?php echo'<input class="form-control" type="number" value="'.$rowr['Ord_itemDepth'].'" id="Ord_itemDepth" name="Ord_itemDepth">';?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="length" class="form-label">Length (cm):</label>
                            <?php echo'<input class="form-control" type="number" value="'.$rowr['Ord_itemLength'].'" id="Ord_itemLength" name="Ord_itemLength">';?>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <?php echo'<input class="form-control" type="number" value="'.$rowr['Ord_itemQuantity'].'" id="Ord_itemQuantity" name="Ord_itemQuantity">';?>
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
        if (selectedItem === "clothes") {
            addOption(materialSelect, "jersey", "Jersey");
            addOption(materialSelect, "cotton", "Cotton");
        } else if (selectedItem === "book") {
            addOption(materialSelect, "A5", "A5");
            addOption(materialSelect, "B5", "B5");
            addOption(materialSelect, "F4", "F4");
        } else if (selectedItem === "banner" || selectedItem === "signboard") {
            // For banner and signboard, add a default option with value "-"
            addOption(materialSelect, "-", "-");
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