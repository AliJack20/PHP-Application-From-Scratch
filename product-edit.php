<?php
include('dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wodth=device-width, initial-scale=1.0">
    <title>Insert data into databse using PHP PDO</title>
    <div class="card">
        <div class="card-header">
            <h3>Edit and Update data into databse using PHP PDO
                <a href="index.php" class="btn btn-danger float-end">BACK</a>
            </h3>
        </div>
        <div class="card-body">
            <?php
            if(isset($_GET['id']))
            {
                $product_id= $_GET['id'];

                $query ="SELECT * FROM products WHERE id=:prod_id LIMIT 1";
                $statement = $conn->prepare($query);
                $data = [':prod_id' => $product_id];
                $statement->execute($data);

                $result = $statement-> fetch(PDO::FETCH_OBJ);

            }
            ?>

            <form action="code.php" method= "POST">

                
                <div class = "mb-3">
                    <label>Product ID</label> 
                    <input type="text" name="productID" value ="<?= $result->id; ?>" class="form-control" />
                </div>  

                <div class = "mb-3">
                    <label>Product Name</label>
                    <input type="text" name="productname" value ="<?= $result->name; ?>" class="form-control" />
                </div>  

                <div class = "mb-3">
                    <label>Product Description</label>
                    <input type="text" name="product_Description" value ="<?= $result->description; ?>" class="form-control" />
                </div>  

                <div class = "mb-3">
                    <label>Product Price</label>
                    <input type="text" name="productprice" value ="<?= $result->price; ?>" class="form-control" />
                </div> 
                
                <div class = "mb-3">
                    <label>Product CategoryID</label>
                    <input type="text" name="productCategoryID" value ="<?= $result->category_id; ?>" class="form-control" />
                </div>  

                <div class = "mb-3">
                    <label>Product Image</label>
                    <input type="text" name="productImage" value ="<?= $result->image; ?>" class="form-control" />
                </div>  

                <div class = "mb-3">
                    <button type ="submit" name="update_product_btn" class = "btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</head>
<body>

</body>
</html>



