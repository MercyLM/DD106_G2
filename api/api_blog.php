<?php
header('Access-Control-Allow-Origin:*'); //允許所有來源訪問
header('Access-Control-Allow-Method:POST,GET'); //允許POST、GET訪問方式
  
session_start();

try{
  require_once("connectDB.php");
  // $frontInfo = json_decode(file_get_contents("php://input"));
  // $ec=json_encode($frontInfo);
  // echo $ec;
  $sql = "SELECT b.content,b.content2,b.date,b.img,b.no,b.title,m.nick,m.img m_img,s.review_total,s.review_count FROM blog  b JOIN seller s ON b.seller_no=s.no JOIN member m ON s.member_no=m.no WHERE b.status=1"; 
  $blog = $pdo->prepare($sql);
  $blog->execute();
  $blogRows = $blog->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($blogRows);

  


  






}catch(PDOException $e){
  //echo "error : " . $e->getMessage();
	$error = ["error"=>$e->getMessage()];
	echo json_encode($error);
}
?>

