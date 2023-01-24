<?php 
$namaFile = $_FILES['berkas']['name'];
$namaSementara = $_FILES['berkas']['tmp_name'];

$dirUpload = "uploads/";

$terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

if ($terupload) {
    echo "Upload berhasil!<br/>";
    echo "Link: <a href='".$dirUpload.$namaFile."'>".time().$namaFile."</a>";
} else {
    echo "Upload Gagal!".var_dump($_FILES["berkas"]);
}
?>