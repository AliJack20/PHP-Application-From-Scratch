<?php

include('dbcon.php');

if(isset($_POST['save_product_btn'])){

    $productID= $_POST['productID'];
    $productname= $_POST['productname'];
    $product_Description= $_POST['product_Description'];
    $productprice= $_POST['productprice'];
    $productCategoryID= $_POST['productCategoryID'];
    $productImage= $_POST['productImage'];
    $productImage= $_POST['productImage'];

    $query = "INSERT INTO products(id,name,description,price,category_id,image,created_at	
) VALUES(:productID, :productname, :product_Description, :productprice, :productCategoryID, :productImage) ";

    $query_run = $conn->prepare($query);

    $data = [

        ':productID' => $productID,
        ':productname' => $productname,
        ':product_Description' => $product_Description,
        ':productprice' => $productprice,
        ':productCategoryID' => $productCategoryID,
        ':productImage' => $productImage

    ];

    $query_execute= $query_run->execute($data);
}

//12:49 on the video



?>