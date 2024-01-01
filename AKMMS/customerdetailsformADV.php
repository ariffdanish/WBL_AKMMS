<?php 
    include ('mysession.php');
        if(!session_id())
        {
            session_start();
        }
    include 'headerNav.php';
    include ('dbconnect.php');
?>


    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Customer Order Form</h3>
        </div>

        <div class="row">
        <form method="POST" action="customerdetailsformprocess.php" class="user">
        <div class="mb-3"><input class="form-control form-control-user" type="text" id="orderName" placeholder="Order Name" name="order_name" required></div>
    
    <div class="mb-3">
        <label for="orderDate">Order Date :</label>
        <input class="form-control form-control-user" type="date" id="orderDate" name="order_date" required>
    </div>

    <div class="mb-3">
        <label for="orderType">Order Type:</label>
        <select id="orderType" name="order_type" class="form-control form-control-user" required>
            <option value="advertising">Advertising</option>
            <option value="construction">Construction</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="item">Select Item:</label>
        <select id="item" name="item" class="form-control form-control-user" required>
            <option value="clothes">Clothes</option>
            <option value="book">Book</option>
            <option value="banner">Banner</option>
            <option value="signboard">Signboard</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="material">Select Material:</label>
        <select id="material" name="material" class="form-control form-control-user" required>
            <!-- Add material options based on the selected item -->
            <!-- For example, if "clothes" is selected, provide fabric options -->
            <!-- If "book" is selected, provide paper options, and so on -->
        </select>
    </div>

    <div class="row">
        <div class="col-md-2 mb-3">
            <label for="height">Height (cm):</label>
            <input class="form-control form-control-user" type="number" id="height" name="height" required>
        </div>
        <div class="col-md-2 mb-3">
            <label for="width">Width (cm):</label>
            <input class="form-control form-control-user" type="number" id="width" name="width" required>
        </div>
        <div class="col-md-2 mb-3">
            <label for="depth">Depth (cm):</label>
            <input class="form-control form-control-user" type="number" id="depth" name="depth" required>
        </div>
        <div class="col-md-2 mb-3">
            <label for="length">Length (cm):</label>
            <input class="form-control form-control-user" type="number" id="length" name="length" required>
        </div>
        <div class="col-md-2 mb-3">
            <label for="quantity">Quantity:</label>
            <input class="form-control form-control-user" type="number" id="quantity" name="quantity" required>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Place Order</button>
    <button type="reset" class="btn btn-dark">Reset</button>
    <a class="btn btn-danger" href="customerorderADV.php">Cancel</a>
                </form>
        </div>
    </div>

<?php include 'footer.php';?>
