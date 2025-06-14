<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wodth=device-width, initial-scale=1.0">
    <title>Insert data into databse using PHP PDO</title>
    <div class="card">
        <div class="card-header">
            <h3>Insert data into databse using PHP PDO
                <a href="index.php" class="btn btn-danger float-end">BACK</a>
            </h3>
        </div>
        <div class="card-body">

            <form action="code.php" method= "POST">
                <div class = "mb-3">
                    <label>Product ID</label>
                    <input type="text" name="productID" class="form-control" />
                </div>  

                <div class = "mb-3">
                    <label>Product Name</label>
                    <input type="text" name="productname" class="form-control" />
                </div>  

                <div class = "mb-3">
                    <label>Product Description</label>
                    <input type="text" name="product_Description" class="form-control" />
                </div>  

                <div class = "mb-3">
                    <label>Product Price</label>
                    <input type="text" name="productprice" class="form-control" />
                </div> 
                
                <div class = "mb-3">
                    <label>Product CategoryID</label>
                    <input type="text" name="productCategoryID" class="form-control" />
                </div>  

                <div class = "mb-3">
                    <label>Product Image</label>
                    <input type="text" name="productImage" class="form-control" />
                </div>  

                <div class = "mb-3">
                    <button type ="submit" name="save_product_btn" class = "btn btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</head>
<body>

</body>
</html>



