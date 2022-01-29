<?php

require('helper.php');
require('../functions.php');
//error variable
$error=array();

$firstName=validate_input_text($_POST['firstName']);
if(empty($firstName))
{
    $error[]="You forgot to enter your first name";
}
$lastName=validate_input_text($_POST['lastName']);
if(empty($lastName))
{
    $error[]="You forgot to enter your last name";
}
$email=validate_input_email($_POST['email']);
if(empty($email))
{
    $error[]="You forgot to enter your e-mail";
}
else{
    $product_shuffle=$product->getData('user');
    foreach($product_shuffle as $item):
        if($item['email']==$email){
            $error[]="Another user has the exact e-mail.";
        }
    endforeach;
}
$password=validate_input_text($_POST['password']);
if(empty($password))
{
    $error[]="You forgot to enter your password";
}
$confirm_pwd=validate_input_text($_POST['confirm_pwd']);
if(empty($confirm_pwd))
{
    $error[]="You forgot to enter your confirm password";
}

if(isset($_FILES['profileUpload']))
{
    $files=$_FILES['profileUpload'];

$profileImage=upload_profile('../assets/profile-pictures/profile/',$files);
}

if(empty($error)){
    //register a new user
    $hashed_pass=password_hash($password,PASSWORD_DEFAULT);
    require('mysqli_connect.php');

    //make a query
    $query="INSERT INTO user (user_id,first_name,last_name,email,password,profileImage,register_date)";
    $query .="VALUES('',?,?,?,?,?,NOW())";

    //initialize statement
    $q=mysqli_stmt_init($con);

    //prepare sql statement
    mysqli_stmt_prepare($q,$query);

    //bind values
    mysqli_stmt_bind_param($q,'sssss',$firstName,$lastName,$email,$hashed_pass,$profileImage);

    //execute statement
    mysqli_stmt_execute($q);

    if(mysqli_stmt_affected_rows($q)==1)
    {
        //start a new session
        session_start();
        //create session variable
        $_SESSION['user_id']=mysqli_insert_id($con);
        header('location:login.php');
        exit(); 
    }
    else
    {
        print "error while registration";
    }
}
else{
    foreach($error as $item):
        echo $item;
    endforeach;
} 