<?php

require "dbConection.php";
var_dump($_POST);

session_start();
$user_id=$_SESSION['user']['id'];
$title=$_POST['title'];
$start=$_POST['start'];
$end=$_POST['end'];
$date=$_POST['date'];


$pdo=dbconect();

//データ登録SQL作成
$sql="INSERT INTO schedule(user_id,title,date,start,end)VALUES
(:user_id,:title,:date,:start,:end)";

//SQL準備&実行
$stmt=$pdo->prepare($sql);
$stmt->bindValue(':user_id',$user_id,PDO::PARAM_STR);
$stmt->bindValue(':title',$title,PDO::PARAM_STR);
$stmt->bindValue(':date',$date,PDO::PARAM_STR);
$stmt->bindValue(':start',$start,PDO::PARAM_STR);
$stmt->bindValue(':end',$end,PDO::PARAM_STR);
$status=$stmt->execute();

//データ登録処理後
if($status==false){
  //SQL実行に失敗した場合はここでエラーを出力し、以降の処理を中止する
  $error=$stmt->errorInfo();
  exit('sqlError'.$error[2]);
}else{
  header('Location:../');
}