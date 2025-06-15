<?php session_start();
include('dbcon.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wodth=device-width, initial-scale=1.0">

    <?php if(isset( $_SESSION['message'])) : ?>
        <h5 class= "alert alert-success"><?= $_SESSION['message']; ?></h5>
    <?php
        unset($_SESSION['message']);
        endif;  ?>
    <div class="card">
        <div class="card-header">
            <h3>PHP PDO CRUD 
                <a href="product-add.php" class="btn btn-primary float-end">Add Product</a>
            </h3>
        </div>
        <div class="card-body"></div>
            <table class="table table-bordered table-striped">
                <thread>
                    <tr> 
                        <th>ID</th>
                        <th>name</th>
                        <th>description</th>
                        <th>price</th>
                        <th>category_id</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    
                </thread>
                <tbody>
                    <?php
                        $query="SELECT * FROM products";
                        $statement = $conn->prepare($query);
                        $statement->execute();

                        $statement->setFetchMode(PDO::FETCH_OBJ);
                        $result = $statement-> fetchAll(); //PDO::FETCH_ASSOC
                        if($result)
                        {
                            foreach($result as $row)
                            {
                                ?>
                                <tr>
                                    <td><?= $row->id; ?></td>
                                    <td><?= $row->name; ?></td>
                                    <td><?= $row->description; ?></td>
                                    <td><?= $row->price; ?></td>
                                    <td><?= $row->category_id; ?></td>
                                    <td><?= $row->image; ?></td>
                                    <td>
                                        <a href="product-edit.php?id=<?= $row->id ?>" class="btn btn-primary"> Edit</a>
                                    </td>
                                    <td>
                                        <form action="code.php"method= "POST">
                                            <button type="submit" name="delete_product" value="<?=  $row->id  ?>" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }

                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan = "6">No Record Found</td>
                            </tr>
                            <?php
                        }
                    ?>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>


            </table>


    </div>
</head>
<body>

</body>
</html>



