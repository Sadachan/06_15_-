<?php 
  require 'dbConection.php';
  session_start();
  var_dump($_POST);

  $name=$_POST['name'];
  $mail=$_POST['mail'];
  $password=$_POST['password'];

  $pdo=dbconect();

  $sql=$pdo->prepare('select * from user where mail=?');
  $sql->execute([$mail]);


  if(empty($sql->fetchAll())){
    //データ登録SQL作成
    $sql="INSERT INTO user(id,name,mail,password)VALUES(Null,:name,:mail,:password)";

    //SQL準備&実行
    $stmt=$pdo->prepare($sql);
    $stmt->bindValue(':name',$name,PDO::PARAM_STR);
    $stmt->bindValue(':mail',$mail,PDO::PARAM_STR);
    $stmt->bindValue(':password',$password,PDO::PARAM_STR);
    $status=$stmt->execute();
    
    //セッションのためにセレクト文投げる
    $sql=$pdo->prepare('select * from user where mail=? and password=?');
    $sql->execute([$mail,$password]);
    foreach($sql->fetchAll() as $row){
      $id=$row['id'];
    }

    //データ登録処理後
    if($status==false){
      //SQL実行に失敗した場合はここでエラーを出力し、以降の処理を中止する
      $error=$stmt->errorInfo();
      exit('sqlError'.$error[2]);
    }else{
      $_SESSION['user']=[
        'id'=>$id,
        'name'=>$name,
        'mail'=>$mail,
        'password'=>$password
      ];
      header('Location:../');
    }
  }else{
    echo 'メールアドレスがすでに使用されています。';
  }

 