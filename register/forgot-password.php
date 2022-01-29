<?php
session_start();
    include('register_header.php');
    include('helper.php');
    include('mysqli_connect.php');
    require('../functions.php');
?>
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require_once('../vendor/autoload.php'); 
    $result=null;   
    function sendPasswordResetLink($email,$user)
    {
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->Host=gethostbyname("smtp.gmail.com");
        $mail->SMTPDebug= 0;
        $mail->SMTPAuth= TRUE;
        $mail->SMTPSecure= "ssl";
        $mail->Port= 465;
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );
        
        $mail->Username= EMAIL;
        $mail->Password= PASSWORD;
        $mail->Priority= 1;
        $mail->CharSet= 'UTF-8';
        $mail->Encoding= '8bit';
        
        $mail->From = EMAIL;
        $mail->FromName = "Mobile Shop";
        $mail->addAddress($email);
        
        $mail->addReplyTo(EMAIL, "Reply");
        $mail->isHTML(true);
        $mail->Subject = "Reset your password";
        $mail->Body = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Reset Password E-mail</title>
        </head>
        <body>
            <div class="wrapper">
                <p>
                    Hello,
                    
                    Please click on the link below to reset your password.

                </p>
                <a href="http://localhost/mobile%20shop/onlinemobileshop/register/reset_password.php?user='.$user.'">Reset your password</a>
            </div>
        </body>
        </html>';
        try {
            $result=$mail->send();
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        

    }
    $user=array();
    $error=null;
    $mail_sent=null;
    if(isset($_SESSION['user_id'])){
        $user=get_user_info($con,$_SESSION['user_id']);
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $already_in_database=false;
        $email=validate_input_email($_POST['email']);
        if(empty($email))
        {
            $error="You forgot to enter your e-mail";
        }
        else{
            $product_shuffle=$product->getData('user');
            foreach($product_shuffle as $item):
                if($item['email']==$email){
                    $already_in_database=true;
                }
            endforeach;
            if($already_in_database==false){
                $error="The e-mail you entered is not the correct one!";
            }
            else{
                $sql="SELECT * FROM user WHERE email='$email'";
                $result=mysqli_query($con,$sql);
                $user=mysqli_fetch_assoc($result);
                sendPasswordResetLink($email, $user['user_id']);
                if($result){
                    $mail_sent="The e-mail has been sent successfully";
                }
            }
        }

        
    }   
?>
<!-- registration area -->
    <section id="login-form">
        <div class="row m-0">
            <div class="col-lg-8 offset-lg-2">
                <div class="text-center pb-5">
                <h1 class="login-title text-dark">Recover your password</h1>
                <p class="p-1 m-0 font-ubuntu text-black-50">Enter the e-mail address associated with your account
                    <br>and we will send you a link to reset your password.
                    <br> If you do not find it in the inbox section, search for it in the spam emails folder.
                </p>
            </div>
        </div> 
                <div class="d-flex justify-content-center">
                    <form action="" method="post" enctype="multipart/form-data" id="log-form">
                        <div class="form-row my-3">
                            <div class="col">
                                <input type="email" required name="email" id="email" style="width:100%" class="form-control" placeholder="Email*">
                                <small id="email_error" class="text-danger"><?php echo $error; ?></small>
                                <small id="mail_send" class="text-success"><?php echo $mail_sent; ?></small>
                            </div>
                        </div>
                        <div class="submit-btn text-center my-5">
                            <button type="submit" class="btn-warning rounded-pill text-dark px-5">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<!-- registration area -->
<?php
    //register_header.php
    include('register_footer.php');
?>
