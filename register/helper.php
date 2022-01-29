<?php

function validate_input_text($textValue){
    if(!empty($textValue)){
        $trim_text=trim($textValue);
        //remove illegal character
        $sanitize_str=filter_var($trim_text,FILTER_SANITIZE_STRING);
        return $sanitize_str;
    }
    return '';
}

function validate_input_email($emailValue){
    if(!empty($emailValue)){
        $trim_text=trim($emailValue);
        //remove illegal character
        $sanitize_str=filter_var($trim_text,FILTER_SANITIZE_EMAIL);
        return $sanitize_str;
    }
    return '';
}

//profile image
function upload_profile($path, $file){
    $targetDir=$path;
    $default="beard.png";

    //get the filename

    $filename=basename($file['name']);
   
   
    $targetFilePath=$targetDir.$filename;
    $fileType=pathinfo($targetFilePath,PATHINFO_EXTENSION);

    if(!empty($filename)){
        //allow certain file format
        $allowType=array('jpg','png','jpeg');
        if(in_array($fileType,$allowType)){
            //upload the file to the server
            if(move_uploaded_file($file['tmp_name'],$targetFilePath)){
                return $targetFilePath;
            }
        }
    }
    //return default image
    return $path.$default;
}

//get user info
function get_user_info($con,$user_id){
    $query="SELECT user_id,first_name,last_name,email,password,profileImage FROM user WHERE user_id=?";
    $q=mysqli_stmt_init($con);
    mysqli_stmt_prepare($q,$query);
    //bind the parameter
    mysqli_stmt_bind_param($q,'i',$user_id);
    //execute sql statement
    mysqli_stmt_execute($q);
    $result=mysqli_stmt_get_result($q);
    $row=mysqli_fetch_array($result);
    return empty($row) ? false : $row;
    
}
//get user info
function get_product_info($con,$item_id){
    $query="SELECT item_id,item_brand,item_name,item_price,item_image,item_stock,item_description FROM product WHERE item_id=?";
    $q=mysqli_stmt_init($con);
    mysqli_stmt_prepare($q,$query);
    //bind the parameter
    mysqli_stmt_bind_param($q,'i',$item_id);
    //execute sql statement
    mysqli_stmt_execute($q);
    $result=mysqli_stmt_get_result($q);
    $row=mysqli_fetch_array($result);
    return empty($row) ? false : $row;
    
}

