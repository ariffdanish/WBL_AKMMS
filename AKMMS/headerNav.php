<?php include 'header.php';?>

<body id="page-top">

    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary shadow p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex align-items-center sidebar-brand m-0" href="#">
                    <img src="akmaju.jpeg" alt="Profile Picture" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                    <div class="sidebar-brand-text mx-3">
                        <span>AKMMS</span>
                    </div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>DASHBOARD</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customerdetails.php">
                        <i class="fas fa-users"></i>
                        <span>LIST OF CUSTOMER</span>
                    </a>
                </li>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-list"></i>
                        <span>LIST OF ORDER</span>
                    </a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in border-0"> <!-- Removed border -->
                        <a class="nav-link dropdown-toggle" href="customerorderADV.php" style="font-size: 14px;"> <!-- Adjusted font size -->
                            <i class="fas fa-bullhorn"></i> <!-- Symbol for Advertising -->
                            ADVERTISEMENT
                        </a>
                        <a class="nav-link dropdown-toggle" href="customerorderCONS.php" style="font-size: 14px;"> <!-- Adjusted font size -->
                            <i class="fas fa-hard-hat"></i> <!-- Symbol for Construction -->
                            CONSTRUCTION
                        </a>
                    </div>
                </li>

                
                <li class="nav-item">
                    <a class="nav-link" href="payment.php">
                        <i class="fas fa-money-bill"></i>
                        <span>STATUS & PAYMENT</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="browseitem.php">
                        <i class="fas fa-box"></i>
                        <span>INVENTORY AND STOCK</span>
                    </a>
                </li>
            </ul>
            </div>
        </nav>


        <div class="d-flex flex-column" id="content-wrapper">
    <div id="content">
        <nav class="navbar navbar-expand bg-gradient-primary shadow mb-4 topbar static-top navbar-light">
            <div class="container-fluid">
                <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button">
                    <i class="fas fa-bars text-dark"></i>
                </button>

                <ul class="navbar-nav flex-nowrap ms-auto">
                    <!--<li class="nav-item ms-auto">
                        <span class="nav-link font-weight-bold text-dark" style="font-size: 18px;">AK MAJU RESOURCES</span>
                    </li>--> 

                    <li class="nav-item">
                        <span id="date-gregorian" class="nav-link text-dark"></span>
                    </li>
                    <li class="nav-item">
                        <span id="date-islamic" class="nav-link text-dark"></span>
                    </li>
                    <li class="nav-item">
                        <span id="clock" class="nav-link text-dark"></span>
                    </li>

                    <li class="nav-item dropdown d-sm-none no-arrow">
                        <a class="dropdown-toggle nav-link text-dark" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                            <i class="fas fa-search text-dark"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="me-auto navbar-search w-100">
                                <div class="input-group">
                                    <input class="bg-light form-control border-0 small text-dark" type="text" placeholder="Search for ...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary py-0" type="button">
                                            <i class="fas fa-search text-dark"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                                </div>
                            </li>

                           

                            <li class="nav-item dropdown no-arrow mx-1">
    <div class="nav-item dropdown no-arrow">
        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
            <span class="badge bg-danger badge-counter" id="notificationCount">5</span>
            <i class="fas fa-envelope fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in" id="notificationDropdown">
            <h6 class="dropdown-header">Notification Centers</h6>
            <?php
                // Replace these with your actual database credentials
                include 'dbconnect.php';

                // Display all notifications from tb_inbox
                $query = "SELECT * FROM tb_inbox ORDER BY inb_timestamp DESC LIMIT 5";
                $result = $con->query($query);

                echo '<div id="notificationList">';

                while ($row = $result->fetch_assoc()) {
                    echo '<a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image me-3">
                                <!-- Add an image/icon if needed -->
                            </div>
                            <div class="fw-bold">
                                <div class="text-white small">' . $row['inb_timestamp'] . '</div>
                                <span class="text-white">' . $row['inb_decs'] . '</span>
                            </div>
                        </a>';
                }

                echo '</div>';
            ?>

            <a id="showNotificationsLink" class="dropdown-item text-center small text-white" href="#">Reload Notifications</a>

<script>
    document.getElementById("showNotificationsLink").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the default behavior of following the link

        // Use AJAX to reload the content of notification.php
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Update the content of the notificationList div with the reloaded content
                document.getElementById("notificationList").innerHTML = xhr.responseText;

                // Update the notification count
                var notificationCount = xhr.getResponseHeader("X-Notification-Count");
                document.getElementById("notificationCount").innerText = notificationCount;
            }
        };
        xhr.open("GET", "notification.php", true);
        xhr.send();
    });
</script>


        </div>
    </div>
    
    <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
</li>


                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                    <img class="border rounded-circle img-profile" src="akmaju.jpeg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item text-white" href="logout.php">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <script>
    // Function to update clock, time, and date
    function updateClock() {
        var now = new Date();

        // Format the time in 12-hour format with 'am' or 'pm'
        var hours = now.getHours();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // 12-hour clock, so 0 becomes 12
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var timeString = hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds + ' ' + ampm;

        // Format the Gregorian date in English
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        var gregorianDateString = now.toLocaleDateString('en-US', options);

        // Format the Islamic (Hijri) date in Bahasa Melayu
        var islamicDate = new Intl.DateTimeFormat('ms-MY-u-ca-islamic', { day: 'numeric', month: 'long', year: 'numeric' }).format(now);

        // Update the clock, Gregorian date, and Islamic date elements
        document.getElementById('clock').textContent = timeString;
        document.getElementById('date-gregorian').textContent = gregorianDateString;
        document.getElementById('date-islamic').textContent = islamicDate;

        // Update every second
        setTimeout(updateClock, 1000);
    }

    // Call the function to initialize
    updateClock();
</script>


