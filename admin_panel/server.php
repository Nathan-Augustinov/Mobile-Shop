<?php 
function upload_image($path, $file){
	$targetDir=$path;
	$default="";

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
	$db = mysqli_connect('localhost', 'root', '', 'mobileshop');

	// initialize variables
	$brand = "";
	$name = "";
    $price = null;
	$image = null;
    $stock = null;
	$section = "";
	$description = "";
	$id = 0;
	$update = false;
	
	if (isset($_POST['save'])) {
        $brand = isset($_POST['brand']) ? $_POST['brand'] : '';
		$name = isset($_POST['name']) ? $_POST['name'] : '';
		$price = isset($_POST['price']) ? $_POST['price'] : 0;
		?><?php
		if(isset($_FILES['imageUpload']))
		{
			$files=$_FILES['imageUpload'];
		
			$productImage=upload_image('../assets/products/',$files);
		}
		?><?php
		$image = isset($_FILES['imageUpload']) ? './assets/products/'.$_FILES['imageUpload']['name'] : '' ;
		$stock = isset($_POST['stock']) ? $_POST['stock'] : 0;
		$section = isset($_POST['product_section']) ? $_POST['product_section'] : '';
		$description = isset($_POST['description']) ? $_POST['description'] : '';

		mysqli_query($db, "INSERT INTO product (item_brand,item_name,item_price,item_image,item_stock,item_description,item_section,item_register) VALUES ('$brand','$name',$price,'$image',$stock,'$description','$section',NOW())"); 
		header('location: admin-products.php');
	}
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $brand = $_POST['brand'];
		$name = $_POST['name'];
		$price = $_POST['price'];
		?><?php
		if(isset($_FILES['imageUpload']))
		{
			$files=$_FILES['imageUpload'];
		
			$productImage=upload_image('../assets/products/',$files);
		}
		?><?php
		$image = $_FILES['imageUpload']['size']>0 ? './assets/products/'.$_FILES['imageUpload']['name'] : $_POST['image'];
		$stock = $_POST['stock'];
		$section = $_POST['product_section'];
		$description = $_POST['description'];
    
        mysqli_query($db, "UPDATE product SET item_brand='$brand', item_name='$name',item_price='$price', item_image='$image',item_stock='$stock', item_description='$description', item_section='$section' WHERE item_id=$id");
        header('location: admin-products.php');
    }
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM product WHERE item_id=$id");
		header('location: admin-products.php');
	}

	