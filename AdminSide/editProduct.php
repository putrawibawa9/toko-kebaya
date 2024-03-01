<?php 
    // require_once '../admin/header.php';
    require_once 'Product.php';
    require_once 'header.php';
?>

<?php
$product_id = $_GET['product_id'];


$data = new Product;

$data = $data->viewEachProduct($product_id);



if(isset($_POST['submit'])){

    $edit = new Product;
    $result = $edit->editProduct($_POST);
    
    //check the progress
    if ($result){
        echo "
            <script>
            alert('data berhasil diubah');
            document.location.href = 'home.php';
            </script>
        ";
    }else{
        echo " <script>
        alert('data gagal diubah');
        document.location.href = 'home.php';
        </script>
    ";

    }

}

?>
<div class="container">
  <div class="row">
    <div class="col-12 p-3 bg-white">
        <h3>Edit Product</h3>


        <form method="post" enctype="multipart/form-data">

        <input type="hidden" name="product_id" value="<?= $product_id ?>;">
        <input type="hidden" name="gambarLama" value="<?= $data['product_thumb']?>">



            <div class="mb-3">
                <label class="form-label"> Product Name</label>
                <input type="text" name="product_name" class="form-control" value="<?= $data['product_name']?>">
            </div>
            
            
            <div class="mb-3">
                <label class="form-label"> Burger Descriptions</label>
            <textarea class="form-control" name="product_desc" rows="3" placeholder="Keterangan Binatang"  required><?= $data['product_desc']?></textarea>
            </div>

            <img src="../assets/img/<?= $data['product_thumb'] ?>" width="100px" height="100px">

            <div class="mb-3">
                <label for="gambar" class="form-label"> Burger Picture</label>
                <input type="file" name="product_thumb" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label"> Product Stock</label>
                <input type="text" name="product_stok" class="form-control" value="<?= $data['product_stok'] ?>">
            </div>

            <div class="mb-3">
                <label class="form-label"> Product Price</label>
                <input type="text" name="product_price" class="form-control" value="<?= $data['product_price']?>">
            </div>
            <a href="home.php" class="btn btn-success" >Back</a>
            <button type="submit" class="btn btn-primary" name="submit" >Save</button>
        </form>
    </div>
  </div>
</div>



