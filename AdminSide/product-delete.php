<?php

require_once 'Product.php';

$product = new Product;
$product_id = $_GET['product_id'];

try {
      $result = $product->deleteProduct($product_id);
      echo "<script>
            alert('Product deleted');
            document.location.href = 'home.php';
      </script>";
  } catch (Exception $e) {
      echo "<script>
      alert('" . addslashes($e->getMessage()) . "');
      document.location.href = 'home.php';
    </script>";

  }
if ($product->deleteProduct($product_id)){
    echo "<script>
            alert('Product deleted');
            document.location.href = 'home.php';
      </script>";
}else{
  echo "  <script>
            alert('Product failed to be deleted');
            document.location.href = 'home.php';
            </script>";
}


?>