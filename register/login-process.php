<?php
require('../functions.php');

$error=array();

$email=validate_input_email($_POST['email']);
if(empty($email))
{
    $error[]="You forgot to enter your e-mail";
}
$password=validate_input_text($_POST['password']);
if(empty($password))
{
    $error[]="You forgot to enter your password";
}
if(empty($error) && $email==ADMIN_EMAIL && $password==ADMIN_PASSWORD)
{
    header("location:../admin_panel/admin-index.php");
}
else
{
if(empty($error)){
    //sql query
    $query="SELECT user_id,first_name,last_name,email,password,profileImage,register_date FROM user WHERE email=?";
    $q=mysqli_stmt_init($con);
    mysqli_stmt_prepare($q,$query);

    //bind the parameter

    mysqli_stmt_bind_param($q,'s',$email);

    //execute query
    mysqli_stmt_execute($q);

    $result=mysqli_stmt_get_result($q);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

    if(!empty($row)){
        //verify password
        if(password_verify($password,$row['password'])){
            session_start();
            $_SESSION['user_id']=$row['user_id'];
            header("location:../index.php");
            exit();
        }
        else{
            print("You entered the wrong credentials!");
        }
    }
    else{
        print("You are not a customer. Please register!");
    }
}else{
    echo "Please fill in the e-mail and the password to login";
}
}