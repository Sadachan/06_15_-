<?php
  session_start();
  if(!(isset($_SESSION['user']))){
    header('Location:./view/login.php');
  }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link rel="stylesheet" type="text/css" href="fullcalendar/fullcalendar.css">
   <script src='fullcalendar/lib/jquery.min.js'></script>
   <script src="fullcalendar/lib/moment.min.js"></script>
   <script src='fullcalendar/fullcalendar.js'></script>
   <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
   <script src="js/calendar.js"></script>
   <script src='fullcalendar/locale/ja.js'></script>
  <title>シェアスケ</title>
</head>

<body>
  <p><?=$_SESSION['user']['name']?>さん</p>
  <p>IDは<?=$_SESSION['user']['id']?></p>
  <a href="./view/adjustment.php"><button>調整</button></a>
  <div id="calendar" class="calendar"></div>
  <script>
    $(function(){
      $('#calendar').fullCalendar()
    })
  </script>
</body>
</html>