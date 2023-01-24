<?php

include('./database.php');
var_dump($_POST);
var_dump($_POST["NamaBarang"]);
echo ("<br>");
var_dump($_FILES['file-upload']['error']==NULL);
if ($_FILES['file-upload']['error'] == 0 && $_FILES['file-upload']['error'] != NULL) {
    $namaFile = $_FILES['file-upload']['name'];
    $namaSementara = $_FILES['file-upload']['tmp_name'];

    $dirUpload = "./uploads/";

    $terupload = move_uploaded_file($namaSementara, $dirUpload . time() . $namaFile);
    if ($terupload) {
        echo "Upload berhasil!<br/>";
        echo "Link: <a href='" . $dirUpload . time() . $namaFile . "'>" . time() . $namaFile . "</a>";
        $query = "UPDATE Barang SET 
        NamaBarang = '" . $_POST["NamaBarang"] . "', FotoBarang = '" . time() . $namaFile . "', HargaBeli = '" . $_POST["HargaBeli"] . "', HargaJual = '" . $_POST["HargaJual"] . "', Stok = '" . $_POST["Stok"] . "' 
        WHERE Barang.Id = " . ($POST["id"] - 78912);

        // $query = "INSERT INTO Barang ( NamaBarang, FotoBarang, HargaBeli, HargaJual, Stok) VALUES 
        // ( '".$_POST["NamaBarang"]."', '".(time() . $namaFile)."', '".$_POST["HargaBeli"]."', '".$_POST["HargaJual"]."', '".$_POST["Stok"]."')" ;
        $result = $conn->query($query);
        if ($conn->affected_rows > 0) {
            var_dump("berhasil");
            http_response_code(200);
            header('location: index.php');
        } else {
            http_response_code(500);
            var_dump("error");
            var_dump($conn->error);

            header('location: index.php');
        };
    } else {
        echo "Upload Gagal!" . var_dump($_FILES);
    }
} else {
    $query = "UPDATE Barang SET 
        NamaBarang = '" . $_POST["NamaBarang"] . "', HargaBeli = '" . $_POST["HargaBeli"] . "', HargaJual = '" . $_POST["HargaJual"] . "', Stok = '" . $_POST["Stok"] . "' 
        WHERE Barang.Id =  ". ($_POST["id"]-78912)." ;";

    $result = $conn->query($query);
    if ($conn->affected_rows > 0) {
        var_dump("berhasil");
        http_response_code(200);
        header('location: index.php');
    } else {
        http_response_code(500);
        var_dump("error");
        var_dump($conn->error);
    };
    // http_response_code(500);
}
