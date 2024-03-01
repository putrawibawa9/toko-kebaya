<?php

require_once "Product.php";




//check whether the button has been click or not
if(isset($_POST['submit'])){
    $add = new Product;
    
    
    if ($add->addProduct($_POST)){
        echo "
            <script>
            alert('data successfuly added');
            document.location.href = 'home.php';
            </script>
        ";
    }else{
        echo " <script>
        alert('data failed to added');
        document.location.href = 'home.php';
        </script>
    ";

    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            margin-top: 10px;
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>
    
<h1>Add Product</h1>

<form action="" method="post" enctype="multipart/form-data">
<ul>
    <li>
        <label for="product_name">Product Name :</label>
        <input type="text" name="product_name" id="product_name" required >
    </li>

    <li>
        <label for="product_desc">Product Descriptions :</label>
        <input type="text" name="product_desc" id="product_desc" required >
    </li>


    <li>
        <label for="product_thumb">Product Photo:</label>
        <input type="file" name="product_thumb" id="product_thumb" required >
    </li>
    <li>
        <label for="product_stok">Product Stock :</label>
        <input type="text" name="product_stok" id="product_stok" required >
    </li>
   
    <li>
        <label for="product_price">Product Price:</label>
        <input type="text" name="product_price" id="product_price" required >
    </li>
    <button type="submit" name="submit">Post</button>
</ul>

<a href="home.php">back</a>
</form>


</body>
</html>