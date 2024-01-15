<?php 
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('headerNav.php');
include('dbconnect.php');
?>

<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-12">
            <div class="row justify-content-center">

                <!-- Order Information Card -->
                <div class="col-lg-6 ">
                    <div class="card shadow">
                        <div class="card-header bg-gradient-primary text-white text-center">
                            <h3 class="mb-0">Payment Information</h3>
                        </div>

                        <div class="card-body">
                        <form method="POST" action="paymentformprocess.php" class="user">

                        <div class="row mb-3">
                            <label for="ctype" class="col-sm-3 col-form-label">Select Order :</label>
                            <div class="col-sm-9">
                            <?php 
                                $sql="SELECT * FROM tb_order";
                                $result=mysqli_query($con,$sql);
                        
                                echo'<select class="form-select" id="p_ordID" placeholder="Select" name="p_ordID">';
                                while($row=mysqli_fetch_array($result))
                                {
                                  echo"<option value='".$row['Ord_id']."'>".$row['Ord_name']."</option>";
                                }
                                
                                echo'</select>';
                            ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ctype" class="col-sm-3 col-form-label">Status :</label>
                            <div class="col-sm-9">
                            <?php 
                                $sql="SELECT * FROM tb_paymentstatus";
                                $result=mysqli_query($con,$sql);
                        
                                echo'<select class="form-select" id="p_status" placeholder="Select" name="p_status">';
                                while($row=mysqli_fetch_array($result))
                                {
                                  echo"<option value='".$row['PS_id']."'>".$row['PS_desc']."</option>";
                                }
                                
                                echo'</select>';
                            ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="orderName" class="col-sm-3 col-form-label">Amount Payment (RM):</label>
                            <div class="col-sm-9">
                            <input class="form-control" type="text" id="p_amount" name="p_amount" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="quantity" class="col-sm-3 col-form-label">Date:</label>
                            <div class="col-sm-9">
                            <input class="form-control" type="date" id="p_date" name="p_date">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="p_proof" class="col-sm-3 col-form-label">Proof of Payment (PDF):</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="file" id="p_proof" name="p_proof" accept=".pdf" required>
                                <small class="text-muted">Upload a PDF file as proof of payment.</small>
                            </div>
                        </div>

                                <div class="mb-3 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-dark mx-2">Reset</button>
                                    <a class="btn btn-danger" href="payment.php">Cancel</a>
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
