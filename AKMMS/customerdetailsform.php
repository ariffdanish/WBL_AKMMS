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
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-gradient-primary text-white text-center">
                    <h3 class="mb-0">Customer Information</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="customerdetailsformprocess.php" class="user">
                        <?php
                        // Function to generate form input fields
                        function generateInputField($id, $label, $type, $placeholder, $name, $required = true)
                        {
                            echo "<div class='mb-3'>
                                    <label for='$id' class='form-label'>$label</label>
                                    <input class='form-control' type='$type' id='$id' placeholder='$placeholder' name='$name' " . ($required ? 'required' : '') . ">
                                </div>";
                        }

                        // Function to generate form textarea field
                        function generateTextareaField($id, $label, $placeholder, $name, $rows, $required = true)
                        {
                            echo "<div class='mb-3'>
                                    <label for='$id' class='form-label'>$label</label>
                                    <textarea class='form-control' id='$id' placeholder='$placeholder' name='$name' rows='$rows' " . ($required ? 'required' : '') . "></textarea>
                                </div>";
                        }

                        generateInputField('cidnum', 'Customer ID', 'text', 'Enter Customer ID', 'cidnum');
                        generateInputField('cname', 'Full Name', 'text', 'Enter Full Name', 'cname');
                        generateInputField('cphone', 'Phone No', 'text', 'Enter Phone No', 'cphone');
                        generateTextareaField('caddress', 'Address', 'Enter Address', 'caddress', 2);
                        generateInputField('cemail', 'Email', 'text', 'Enter Email', 'cemail');

                        echo "<div class='mb-3'>
                                <label for='ctype' class='form-label'>Customer Type</label>";

                        $sql = "SELECT * FROM tb_custtype";
                        $result = mysqli_query($con, $sql);

                        echo '<select class="form-select" id="ctype" placeholder="Select" name="ctype" required>';
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['CT_id'] . "'>" . $row['CT_desc'] . "</option>";
                        }

                        echo '</select></div>';

                        ?>
                        <div class="mb-3 d-flex justify-content-center gap-2">
                            <button type="submit" class="btn btn-primary" onclick="return confirmSubmit()">Submit</button>
                            <button type="reset" class="btn btn-dark mx-2">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmSubmit() {
            return confirm("Are you sure you want to submit?");
        }
    </script>

    <?php include 'footer.php'; ?>
