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
  //現在の年月を取得
  $year=date('Y');
  $month=date('n');

  //月末日を取得
  $last_day=date('j',mktime(0,0,0,$month+1,0,$year));

  $calender=array();
  $j=0;

  //月末日までループ
  for($i=1;$i < $last_day+1; $i++){
    //曜日を取得
    $week=date('w',mktime(0,0,0,$month,$i,$year));
    //1日の場合
    if($i==1){
      for($k=1; $k<=$week;$k++){
        //前半に空文字セット
        $calender[$j]['day']='';
        $j++;
      }
    }
    //配列に日付をセット
    $calender[$j]['day']=$i;
    $j++;
    if($i==$last_day){
      //月末日からの残りをループ
      for($e=1;$e<=6-$week;$e++){
        //後半に空文字セット
        $calender[$j]['day']='';
        $j++;
      }
    }
  }

?>

<html>
  <body>
    <?=$year?>年<?=$month?>月
    <table>
      <tr>
        <th>日</th><th>月</th><th>火</th>
        <th>水</th><th>木</th><th>金</th><th>土</th>
      </tr>
      <tr>
        <?php $cnt=0;?>
        <?php foreach($calender as $key =>$value): ?>
          <td>
          <?php $cnt++;?>
          <?=$value['day'];?>
          </td>
        <?php if($cnt==7): ?>
        </tr>
        <tr>
        <?php $cnt=0; ?>
        <?php endif; ?>

        <?php endforeach;?>
      </tr>
    </table>
    <!-- <?=$year?>
    <?=$month?>
    <?=$last_day?>
    <?=$week?> -->
  </body>
</html>