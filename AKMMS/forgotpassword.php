<?php include 'header.php';

require_once 'dbconnect.php';
require 'vendor/autoload.php'; // Include PHPMailer autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function base_url($url = null)
{
    global $baseUrl;
    return $baseUrl . $url;
}

$baseUrl = 'http://localhost/WBL_AKMMS/AKMMS/';

function alert($message, $type = 'info')
{
    // bootsrap 4 alert
    $text = '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">';
    $text .= $message;
    $text .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    $text .= '<span aria-hidden="true">&times;</span>';
    $text .= '</button>';
    $text .= '</div>';
    return $text;
}

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

        $sql_token = "INSERT INTO `password_resets` (`password_reset_user_id`, `password_reset_token`, `password_reset_created_at`) VALUES ('" . $user['e_id'] . "', '$token', '" . date('Y-m-d H:i:s') . "')";
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
}?>


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

<body style="background-image: url(&quot;bg4.gif&quot;);">
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;assets/img/AKMMS/bg.jpg&quot;);"></div>
                    </div>


                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Reset Password</h4>
                            </div>
                            <form method="POST" action="" class="user">
                                <div class="form-group">
                                    <?php if (isset($_SESSION['message'])) : ?>
                                            <?= $_SESSION['message'] ?>
                                            <?php unset($_SESSION['message']) ?>
                                        <?php endif; ?>
                                    <label for="email">Email Address:</label>
                                    <input class="form-control" type="email" id="email" placeholder="Enter Your Email Address" name="email">
                                </div><br>

                                <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                            </form>

                            <div class="text-center mt-3">
                                <p class="small">Remember your password? <a href="index.php">Login here</a></p>
                            </div>
                        
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>