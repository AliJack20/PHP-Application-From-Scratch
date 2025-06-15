<?php

session_start();
include('dbcon.php');

if(isset($_POST['update_product_btn'])){

    $productID= $_POST['productID'];
    $productname= $_POST['productname'];
    $product_Description= $_POST['product_Description'];
    $productprice= $_POST['productprice'];
    $productCategoryID= $_POST['productCategoryID'];
    $productImage= $_POST['productImage'];

    try{

        $query = "UPDATE products SET id =:productID, name=:productname, description=: product_Description, price=: productprice, category_id=: productCategoryID, image=: productImage WHERE id=:prod_id LIMIT 1";
        $stament = $conn->prepare($query);

        $data = [
            ':id' => $productID,
            ':name' => $productname,
            ':description' => $product_Description,
            ':price' => $productprice,
            ':category_id' => $productCategoryID,
            ':image' => $productImage,
            ':id' => $productID

        ];

        $query_execute = $stament->execute($data);

        if($query_execute){
             $_SESSION['message'] = "Updated Succesfully";
            header('Location: index.php');
            exit(0);

        } 


    } catch (PDOException $e){

        echo $e->getMessage();
    }


}

if(isset($_POST['save_product_btn'])){

    $productID= $_POST['productID'];
    $productname= $_POST['productname'];
    $product_Description= $_POST['product_Description'];
    $productprice= $_POST['productprice'];
    $productCategoryID= $_POST['productCategoryID'];
    $productImage= $_POST['productImage'];

    $query = "INSERT INTO products(Id,name,description,price,category_id,Image	
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

    if($query_execute){

        $_SESSION['message'] = "Inserted Succesfully";
        header('Location: index.php');
        exit(0);
    }
}

//12:49 on the video



?>