<?php
require_once "construct.php";
class Product extends Connect{
    
    public function readProduct(){
        $conn = $this->getConnection();
        $query = "SELECT * FROM tb_product";  
        $result = $conn->query($query);
        $product = $result->fetchAll();
        return $product;
        }

    public function readTwoTable(){
        $conn = $this->getConnection();
        $queryKat = "SELECT * FROM kategori";
        $resultKat = $conn->query($queryKat);

        $queryBin = "SELECT * FROM binatang";
        $resultBin = $conn->query($queryBin);


        if($resultKat && $resultBin){
            $dataKat = $resultKat->fetchAll();
            $dataBin = $resultBin->fetchAll();
            return array('tableKat'=>$dataKat, 'tableBin'=>$dataBin);
        }else{
            return false;
        }
    }
    public function readTwoTablepart2($id_binatang){
        $conn = $this->getConnection();
        $queryKat = "SELECT * FROM kategori JOIN binatang ON kategori.id_kategori = binatang.id_kategori WHERE id_binatang = $id_binatang";
        $resultKat = $conn->query($queryKat);

        $queryBin = "SELECT * FROM binatang WHERE id_binatang= $id_binatang";
        $resultBin = $conn->query($queryBin);



        if($resultKat && $resultBin){
            $dataKat = $resultKat->fetch();
            $dataBin = $resultBin->fetch();
            return array('tableKat'=>$dataKat, 'tableBin'=>$dataBin);
        }else{
            return false;
        }
    }

    public function readTwoTablepart3($id_kategori){
        $conn = $this->getConnection();
        $queryKat = "SELECT nama_kategori FROM kategori WHERE id_kategori = $id_kategori";
        $resultKat = $conn->query($queryKat);

        $queryBin = "SELECT * FROM binatang JOIN kategori ON binatang.id_kategori = kategori.id_kategori WHERE kategori.id_kategori = $id_kategori";
        $resultBin = $conn->query($queryBin);

        if($resultKat && $resultBin){
            $dataKat = $resultKat->fetch();
            $dataBin = $resultBin->fetchall();
            return array('tableKat'=>$dataKat, 'tableBin'=>$dataBin);
        }else{
            return false;
    }
}

    public function addProduct($data){
        $conn = $this->getConnection();
        $product_name = $data['product_name'];
        $product_desc = $data['product_desc'];
        $product_stok = $data['product_stok'];
        $product_price = $data['product_price'];
        $product_thumb = $this->uploadGambar();
        if (!$product_thumb) {
            return false;
        }


        $query = "INSERT INTO tb_product VALUES 
        ('',?,?,?,?,?)";
    
        $stmt = $conn->prepare($query);
    
        $stmt->bindParam(1,$product_name);
        $stmt->bindParam(2,$product_desc);
        $stmt->bindParam(3,$product_thumb);
        $stmt->bindParam(4,$product_stok);
        $stmt->bindParam(5,$product_price);
        $stmt->execute();
        return true;
    }


    public function editProduct($data){
        $conn = $this->getConnection();
        $product_id = $data['product_id'];
        $product_name = $data['product_name'];
        $product_desc = $data['product_desc'];
        $product_stok = $data['product_stok'];
        $product_price = $data['product_price'];
        $gambarLama = $data['gambarLama'];

          //check whether user pick a new image or not
        if($_FILES['product_thumb']['error']===4){
            $product_thumb = $gambarLama;
        }else{
            $product_thumb = $this->uploadGambar();
        }
        $query = "UPDATE tb_product SET
        product_name = ?,
        product_desc = ?,
        product_thumb = ?,
        product_stok = ?,
        product_price = ?
        WHERE product_id = ?
        ";
             $stmt = $conn->prepare($query);
             $stmt->bindParam(1,$product_name);
             $stmt->bindParam(2,$product_desc);
             $stmt->bindParam(3,$product_thumb);
             $stmt->bindParam(4,$product_stok);
             $stmt->bindParam(5,$product_price);
             $stmt->bindParam(6,$product_id);
                $stmt->execute();
                return true;
    }

    public function uploadGambar(){
        $namaFile = $_FILES['product_thumb']['name'];
        $ukuranFile =  $_FILES['product_thumb']['size'];
        $error =  $_FILES['product_thumb']['error'];  
        $tmp =  $_FILES['product_thumb']['tmp_name'];  
      
        //cek apakah user sudah menambah gambar
      
        if($error ===4){
          echo "<script>
              alert ('Please choose a picture');
                </script>";
                return false;
        }
      
        //cek apakah yang diupload adalah gambar
        $ekstensiGambarValid =['jpg','jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile); 
        $ekstensiGambar = strtolower(end($ekstensiGambar)); 
        if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
          echo "<script>
              alert ('Wrong Format!');
                </script>";
                return false;
        }
      
        //cek jika ukurannya terlalu besar
        if ($ukuranFile > 1000000){
          echo "<script>
              alert ('Too big!');
                </script>";
        }
      
        //generate nama file random
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
      
      
        //lolos semua hasil cek, lalu dijalankan
        move_uploaded_file($tmp, '../assets/img/'.$namaFileBaru);
      
        return $namaFileBaru;
    }


    public function deleteProduct($product_id) {
        try {
            $conn = $this->getConnection();
            $query = "DELETE FROM tb_product WHERE product_id = $product_id";
            $result = $conn->exec($query);
    
            // Check if the deletion was successful
            if ($result === false) {
                throw new Exception("Deletion failed");
            }
    
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                // Specific error code for integrity constraint violation
                throw new Exception("Unable to delete the product. This product is associated with other records and cannot be deleted.");
            } else {
                // Handle other PDO exceptions
                throw new Exception("An error occurred: " . $e->getMessage());
            }
        }
    }
    

    public function viewEachProduct($product_id){
        $conn = $this->getConnection();
        $query = "SELECT * FROM tb_product WHERE product_id= $product_id";
        $result = $conn->query($query);
        $product = $result->fetch();
        return $product;
    }

    public function editKategori($nama_kategori,$id_kategori){
        $conn = $this->getConnection();
        $query = "UPDATE kategori SET
        nama_kategori = ?
        WHERE id_kategori = ?";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(1,$nama_kategori);
         $stmt->bindParam(2,$id_kategori);

          //check the progress
    if ($stmt->execute()) {
        echo "
            <script>
            alert('Data berhasil diupdate');
            document.location.href = 'kategori.php';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('Data gagal diupdate');
            document.location.href = 'kategori.php';
            </script>
        ";
    }
    }

}
?>