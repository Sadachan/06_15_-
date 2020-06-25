<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <title>シェアスケ</title>
</head>

<?php
  $selected_ymd=$_GET['date'];
?>

<body>
  <h1><?=$selected_ymd?>のスケジュール</h1>
  <form action="../controller/schedule_create.php" method="POST">
    <input type="hidden" name="date" value="<?=$selected_ymd?>">
    タイトル：<input type="text" name="title"><br>
    開始時間：<input type="time" name="start"><br>
    終了時間：<input type="time" name="end"><br>
    <input type="submit" value="予定を入れる">
  <form>
</body>
</html>