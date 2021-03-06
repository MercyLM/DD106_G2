<?php
header('Access-Control-Allow-Origin:*'); //允許所有來源訪問
header('Access-Control-Allow-Method:POST,GET'); //允許POST、GET訪問方式

session_start();
require_once("connectDB.php");
$sql = "select * from `item` where seller_no = :no";
$commodity = $pdo->prepare($sql);

$commodity->bindValue(":no", $_SESSION["seller_no"]);

$commodity->execute();
$memRow = $commodity->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($memRow);
