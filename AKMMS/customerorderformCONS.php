<?php 
    include ('mysession.php');
        if(!session_id())
        {
            session_start();
        }
    include 'headerNav.php';
    include ('dbconnect.php');
?>


<div class="container">
    <div class="row mt-5">
        <div class="col-lg-6 offset-lg-3">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Customer Order Form</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="customerdetailsformprocess.php" class="user">

                        <div class="mb-3">
                            <label for="orderName" class="form-label">Order Name:</label>
                            <input class="form-control" type="text" id="orderName" name="order_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="orderDate" class="form-label">Order Date:</label>
                            <input class="form-control" type="date" id="orderDate" name="order_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="orderType" class="form-label">Order Type:</label>
                            <select id="orderType" name="order_type" class="form-control" required>
                                <option value="advertising">Advertising</option>
                                <option value="construction">Construction</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="item" class="form-label">Select Item:</label>
                            <select id="item" name="item" class="form-control" required>
                                <option value="clothes">Clothes</option>
                                <option value="book">Book</option>
                                <option value="banner">Banner</option>
                                <option value="signboard">Signboard</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="material" class="form-label">Select Material:</label>
                            <select id="material" name="material" class="form-control" required>
                                <!-- Add material options based on the selected item -->
                                <!-- For example, if "clothes" is selected, provide fabric options -->
                                <!-- If "book" is selected, provide paper options, and so on -->
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="height" class="form-label">Height (cm):</label>
                                <input class="form-control" type="number" id="height" name="height" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="width" class="form-label">Width (cm):</label>
                                <input class="form-control" type="number" id="width" name="width" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="depth" class="form-label">Depth (cm):</label>
                                <input class="form-control" type="number" id="depth" name="depth" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="length" class="form-label">Length (cm):</label>
                            <input class="form-control" type="number" id="length" name="length" required>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input class="form-control" type="number" id="quantity" name="quantity" required>
                        </div>

                        <div class="mb-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Place Order</button>
                            <button type="reset" class="btn btn-dark mx-2">Reset</button>
                            <a class="btn btn-danger" href="customerorderCONS.php">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include 'footer.php';?>
