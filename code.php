<?php

session_start();
include('dbcon.php');

if(isset($_POST['delete_product']))
{

    $productID= $_POST['delete_product'];

    try
    {
        $query = "DELETE FROM products WHERE id = :productID";
        $stament = $conn->prepare($query);
        $data = [':productID' => $productID];
        $query_execute = $stament->execute($data);

        if($query_execute){
             $_SESSION['message'] = "Deleted Succesfully";
            header('Location: index.php');
            exit(0);

        } 

    } catch(PDOException $e) {
        echo $e->getMessage();

    }

}

if(isset($_POST['update_product_btn'])){

    $productID= $_POST['productID'];
    $productname= $_POST['productname'];
    $product_Description= $_POST['product_Description'];
    $productprice= $_POST['productprice'];
    $productCategoryID= $_POST['productCategoryID'];
    $imageName = $_FILES['productImage']['name'];
    $imageTmpName = $_FILES['productImage']['tmp_name'];
    $uploadDir = 'uploads/';
    $imagePath = $uploadDir . basename($imageName);

// Move file to uploads directory
    move_uploaded_file($imageTmpName, $imagePath);;

    try{

        $query = "UPDATE products SET name = :productname, description = :product_Description, price = :productprice, category_id = :productCategoryID, image = :productImage WHERE id = :productID LIMIT 1";
        $stament = $conn->prepare($query);

        $data = [
            ':productID' => $productID,
            ':productname' => $productname,
            ':product_Description' => $product_Description,
            ':productprice' => $productprice,
            ':productCategoryID' => $productCategoryID,
            ':productImage' => $imagePath 
        ];


        $query_execute = $stament->execute($data);

        if ($_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
            $imgName = $_FILES['productImage']['name'];
            move_uploaded_file($_FILES['productImage']['tmp_name'], 'uploads/' . $imgName);
        }else {
            // Fetch old image from DB
            $stmt = $conn->prepare("SELECT image FROM products WHERE id = :id");
            $stmt->execute([':id' => $productID]);
            $imgName = $stmt->fetchColumn();
        }


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
    $imageName = $_FILES['productImage']['name'];
    $imageTmpName = $_FILES['productImage']['tmp_name'];
    $uploadDir = 'uploads/';
    $imagePath = $uploadDir . basename($imageName);

    // Move file to uploads directory
    move_uploaded_file($imageTmpName, $imagePath);

    $productImage = $imgName ?? null;

    $query = "INSERT INTO products(Id,name,description,price,category_id,Image	
) VALUES(:productID, :productname, :product_Description, :productprice, :productCategoryID, :productImage) ";

    $query_run = $conn->prepare($query);

    $data = [

        ':productID' => $productID,
        ':productname' => $productname,
        ':product_Description' => $product_Description,
        ':productprice' => $productprice,
        ':productCategoryID' => $productCategoryID,
        ':productImage' => $imagePath 

    ];

    $query_execute= $query_run->execute($data);

    if($query_execute){

        $_SESSION['message'] = "Inserted Succesfully";
        header('Location: index.php');
        exit(0);
    }

    if ($_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
    $imgName = $_FILES['productImage']['name'];
    $imgTmp = $_FILES['productImage']['tmp_name'];

    // Set upload path (make sure this folder exists and is writable)
    $uploadDir = 'uploads/';
    $uploadPath = $uploadDir . basename($imgName);

    // Move the uploaded file
    move_uploaded_file($imgTmp, $uploadPath);
  } else {
    $imgName = null; // or retain old image in update
}
}

//12:49 on the video



?>