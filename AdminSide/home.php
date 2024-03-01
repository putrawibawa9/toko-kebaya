<?php
require_once 'Product.php';
require_once 'header.php';

$product = new Product;
$product = $product->readProduct();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        h1, .form {
            color: #4F6F52;
        }

        a {
            color: blue;
            margin-right: 10px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #212529;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        header {
            background-color: #212529;
            color: #fff;
            padding: 1em;
            text-align: center;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        footer {
            background-color: #212529;
            color: #fff;
            text-align: center;
            padding: 1em;
            bottom: 0;
            width: 100%;
        
        }
        .container {
            text-align: center;

        }

        .container a {
            display: block;
            margin: 10px;
            color: blue   ;
        }
    </style>
</head>
<body>
 
    <header>
        <h1 style="color: white;">Toko Kebaya dan Jas</h1>
        <h1 style="color: white;">Product List</h1>
    </header>

  

  

 <!-- <form action="" method="get" class="form">
    <input type="text" name="keyword" autofocus placeholder="cari id/nama " autocomplete="off" 
    value="<?= $keyword;  ?>" >
    <button type="submit" name="cari">Cari</button>
</form>
     <form action="" method="post" class="form"> 
            <input type="text" name="keywordNama" autofocus placeholder="cari nama" autocomplete="off" >
            <button type="submit" name="cariNama">Cari</button>
        </form> -->
    <!-- create the header -->
    <table border="1" cellpadding = '10' cellspacing = '0'>
        <tr>
            <th> No </th>
            <th> Product Name</th>
            <th> Product Descriptions</th>
            <th> Product Image </th>
            <th> Product Stock</th>
            <th> Product Price</th>
            <th> Actions</th>
        </tr>
        
        <?php $i =1;?>
        <!-- create the loop -->
        <?php foreach($product as $row): ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $row['product_name']; ?></td>
            <td><?= $row['product_desc']; ?></td>
            <td><img src="../assets/img/<?= $row['product_thumb'] ?>" width="100px" height="100px"></td>
            <td><?= $row['product_stok']; ?></td>
            <td><?= $row['product_price']; ?></td>
            <td>
               <a href="editProduct?product_id=<?=$row['product_id'];?>">Edit</a>
               <a href="product-delete.php?product_id=<?=$row['product_id'];?>" onclick="return confirm('are you sure?');">Delete</a>
            </td>
            <?php $i++?>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="container">    
                <a href="addProduct.php" class="btn btn-md">TAMBAH PRODUK</a>
    </div>

    <footer>
        <a href="../auth/loginAdmin.php">Logout</a>
        <p>Hubungi kami di: info@tokokebayadanjas.com | Phone: (123) 456-7890</p>
    </footer>
      