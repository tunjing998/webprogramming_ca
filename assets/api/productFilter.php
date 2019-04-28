<?php
// require_once '../../models/Account.php';
// $username = $_POST['username'];
// $avaliable = \Account::checkNameAvailable($username);
$db = new PDO(
    'mysql:host=127.0.0.1;dbname=wp_ca4_tunjing_ang_xingnuo_cen;charset=utf8mb4',
    'root',
    '',
    null
);


$productType  =$_POST['type'] ?? "";
$productPriceLow =$_POST['price_low']?? 0;
$productPriceHigh = $_POST['price_high']??999;

$query = $db->prepare('SELECT product_id, product_name, product_type, product_details,product_price,product_img_address FROM products WHERE product_type LIKE :type AND product_price BETWEEN :low AND :high');
$query->execute([
    'type' => "%".$productType."%",
    'low' =>$productPriceLow,
    'high'=>$productPriceHigh
]);
$result= $query->fetchAll();
echo json_encode($result);
?>