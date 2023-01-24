<?php 
include('./database.php');

$req = json_decode(file_get_contents('php://input'), true);
$query = "DELETE FROM Barang WHERE Barang.Id=".$req["id"]-78912;
// $query = "DELETE FROM Barang WHERE id=200000";
// if(==true){
    // var_dump($req['id']);
// }else{
    // http_response_code(500);
    $result = $conn->query($query);
    if($conn->affected_rows>0){
        http_response_code(200);
    }else{
        http_response_code(500);

    };
// }

$conn->close();
