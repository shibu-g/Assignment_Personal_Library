<?php
session_start();
$res = $_SESSION['library'];

$id = $_POST['id'];
if (array_key_exists($id, $res)) {
    unset($res[$id]);
}
$_SESSION['library'] = $res;


echo json_encode(["message" => "Book deleted successfully"]);

?>