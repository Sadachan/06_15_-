<?php
  require 'dbConection.php';
  session_start();
  unset($_SESSION['user']);

  $pdo=dbconect();
  $sql=$pdo->prepare('select * from user where mail=? and password=?');
  $sql->execute([$_POST['mail'],$_POST['password']]);
  foreach($sql->fetchAll() as $row){
    $_SESSION['user']=[
      'id'=>$row['id'],
      'name'=>$row['name'],
      'mail'=>$row['mail'],
      'password'=>$row['password']
    ];
  }
  if(isset($_SESSION['user'])){
    echo 'いらっしゃいませ、'.$_SESSION['user']['name'],'さん';
    header('Location:../');
  }else{
    echo 'ログイン名またはパスワードが違います。';
  }
  ?>

  