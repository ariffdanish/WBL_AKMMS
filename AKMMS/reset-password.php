<?php include 'header.php';

require_once 'dbconnect.php'; 

function base_url($url = null)
{
    global $baseUrl;
    return $baseUrl . $url;
}

$baseUrl = 'http://localhost/WBL_AKMMS/AKMMS/';


// redirect url
function redirect($url = null)
{
    echo "<script>window.location.href='" . $url . "'</script>";
    die;
}

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


if (isset($_GET['token'])) {
    session_start();
    $token = $_GET['token'];

    // 30 minutes
    $current_date = date('Y-m-d H:i:s');
    $sql = "SELECT * FROM `password_resets` WHERE `password_reset_token` = '$token' AND `password_reset_status` = '1' AND `password_reset_created_at` >= DATE_SUB('$current_date', INTERVAL 30 MINUTE)";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $password_reset = $result->fetch_assoc();

        $user = $password_reset['password_reset_user_id'];

        $sql_user = "SELECT * FROM `tb_employee` WHERE `e_id` = '$user'";
        $result_user = $con->query($sql_user);

        if ($result_user->num_rows > 0) {
            $user = $result_user->fetch_assoc();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $password = $_POST['fpwd'];

                $error = [];

                if (empty($password)) {
                    $error['fpwd'] = 'Password is required';
                } else if (strlen($password) < 8) {
                    $error['fpwd'] = 'Password must be at least 8 characters';
                }

                if (empty($error)) {
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    $sql_update = "UPDATE `tb_employee` SET `e_pwd` = '$password' WHERE `e_id` = '" . $user['e_id'] . "'";
                    $con->query($sql_update);

                    // $sql_delete = "DELETE FROM `password_resets` WHERE `password_reset_user_id` = '$user_id'";
                    // update
                    $sql_delete = "UPDATE `password_resets` SET `password_reset_status` = '0' WHERE `password_reset_user_id` = '$suic'";
                    $con->query($sql_delete);

                    $_SESSION['message'] = alert('Password has been reset successfully', 'success');
                    redirect('index.php');
                }
            }
        } else {
            $_SESSION['message'] = alert('Invalid token', 'danger');
            redirect('index.php');
        }
    } else {
        $_SESSION['message'] = alert('Invalid token', 'danger');
        redirect('index.php');
    }
}
?>

<body style="background-image: url(&quot;bg4.gif&quot;);">
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;bg.jpg&quot;);"></div>
                    </div>


                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Reset Password</h4>
                            </div>
                            <?php if (isset($_SESSION['message'])) : ?>
                                <?= $_SESSION['message'] ?>
                                <?php unset($_SESSION['message']) ?>
                            <?php endif; ?>
                            <form method="POST">
                                <div class="form-group">
                                    <input type="password" name="fpwd" id="password" class="form-control <?= isset($error['fpwd']) ? 'is-invalid' : '' ?>" placeholder="Password">
                                    <?php if (isset($error['fpwd'])) : ?>
                                        <div class="invalid-feedback"><?= $error['fpwd'] ?></div>
                                    <?php endif; ?>
                                </div><br>

                                <button type="submit" class="btn btn-primary">Reset Password</button>
                            </form>
                            <div class="text-center"><a class="small" href="index.php">Already have an account? Login!</a></div>
                        </div>

                    </div> 
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>