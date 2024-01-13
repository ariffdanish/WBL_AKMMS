<?php
require_once 'dbconnect.php';
require 'vendor/autoload.php'; // Include PHPMailer autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($phpMailerPassword == '' || $phpMailerUsername == '' || $phpMailerHost == '') {
    $_SESSION['message'] = alert('Please configure your email credentials in config.php', 'danger');
    redirect('login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $sql = "SELECT * FROM `tb_employee` WHERE `e_email` = '$email'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $token = md5($user['e_id'] . $user['e_email'] . time());

        $sql_token = "INSERT INTO `password_resets` (`password_reset_user_id`, `password_reset_token`, `password_reset_created_at`) VALUES ('" . $user['u_ic'] . "', '$token', '" . date('Y-m-d H:i:s') . "')";
        $con->query($sql_token);

        $link = base_url('reset-password.php?token=' . $token);

        $to = $user['e_email'];

        $subject = 'Reset Password';

        $message = 'Please click the link below to reset your password: <br><br>';
        $message .= '<a href="' . $link . '">' . $link . '</a>';

        try {

            $mail = new PHPMailer(true);

            // Set mailer to use SMTP
            $mail->isSMTP();

            // Your SMTP server address
            $mail->Host = $phpMailerHost;

            // Your SMTP username
            $mail->Username = $phpMailerUsername;

            // Your SMTP password
            $mail->Password = $phpMailerPassword;

            // Enable TLS or SSL encryption
            $mail->SMTPSecure = 'tls'; // tls or ssl
            $mail->SMTPAuth = true;

            // TCP port to connect to
            $mail->Port = 587; // Adjust accordingly

            // Set email format to HTML
            $mail->isHTML(true);

            // Set sender and recipient
            $mail->setFrom($mail->Username, 'AKmaju Resource');
            $mail->addAddress($to);

            // Set email subject and body
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Send the email
            if ($mail->send()) {
                $_SESSION['message'] = alert('Email sent', 'success');
            }
        } catch (Exception $e) {
            if (strpos($e->getMessage(), 'SMTP Error: Could not authenticate') !== false) {
                $_SESSION['message'] = alert("Authentication failed. Please check your email credentials.", 'danger');
            } elseif (strpos($e->getMessage(), 'Invalid address') !== false) {
                $_SESSION['message'] = alert("Invalid email address.", 'danger');
            } elseif (strpos($e->getMessage(), 'SMTP connect() failed') !== false) {
                $_SESSION['message'] = alert("Could not connect to SMTP server. Please check your internet connection.", 'danger');
            } elseif (strpos($e->getMessage(), 'Connection timed out') !== false) {
                $_SESSION['message'] = alert("Connection timed out. Please check your internet connection.", 'danger');
            } else {
                $_SESSION['message'] = alert($e->getMessage(), 'danger');
            }
        }
    }
}
?>

<script>
  document.addEventListener("DOMContentLoaded", function() 
  {
    // Retrieve the alert parameter from the URL
    var urlParams = new URLSearchParams(window.location.search);
    var alertMessage = urlParams.get('alert');

    // Display the alert if the parameter is present
    if (alertMessage) 
    {
      alert(alertMessage);
    }
  });
</script>

<body style="background-color: white;">
    <div class="container">
             <!-- Outer Row -->
             <div class="row justify-content-center">

<div class="col-xl-10 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                   <div class="col-lg-6 d-none d-lg-block" style="background: url('img/forgotpass.jpg') center center no-repeat; background-size: cover;"></div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                            <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                and we'll send you a link to reset your password!</p>
                        </div>
                        <form class="user" action="" method="post">
                            <?php if (isset($_SESSION['message'])) : ?>
                                <?= $_SESSION['message'] ?>
                                <?php unset($_SESSION['message']) ?>
                            <?php endif; ?>

                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Reset Password
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="login.php">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>

</div>
    </div>
    <?php include 'footer.php';?>