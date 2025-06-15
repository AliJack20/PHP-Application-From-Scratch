<?php

session_start();
include('dbcon.php');

// Registration
if (isset($_POST['register_btn'])) {

    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password =$_POST['password']; // secure password hashing


    try {
        $query = "INSERT INTO member (id, fullname, email, password)
                  VALUES (:id, :fullname, :email, :password)";

        $query_run = $conn->prepare($query);

        $data = [
            ':id' => $id,
            ':fullname' => $fullname,
            ':email' => $email,
            ':password' => $password
        ];

        $query_execute = $query_run->execute($data);

        if ($query_execute) {
            $_SESSION['message'] = "Registered successfully!";
            header("Location: login.php");
            exit(0);
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//kane password= kane

// Login
if (isset($_POST['login_btn'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $query = "SELECT * FROM member WHERE email = :email LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password'])  {
            // Success: store session and redirect
            $_SESSION['id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];

            $_SESSION['message'] = "Logged in successfully!";
            header("Location: index.php"); 
            exit();
        } else {
            $_SESSION['message'] = "Invalid email or password.";
            header("Location: login.php");
            exit(0);
        }

    } catch (PDOException $e) {
        echo "Login Error: " . $e->getMessage();
    }
}



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