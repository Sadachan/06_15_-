<style>
  th{font-size:12px;}
  table{display:block;width:97vw;overflow:scroll;}
</style>
<script src='https://code.jquery.com/jquery-3.3.1.js'></script>
<script>
  let fromphp='';
  let classToRemove=''
</script>
<?php
  require 'dbConection.php';
  //var_dump($_POST);
  //$member=array();
  $where='';
  foreach($_POST['member'] as $eachmember){
    //array_push($member,$eachmember);
    $where.=' user_id='.$eachmember.' or';
  }
  $where = substr( $where , 0 , strlen($where)-3 );
  var_dump($where);
  $pdo=dbconect();
  $sql=$pdo->prepare('select date,start,end from schedule where'.$where);
  $sql->execute();

?>
<?php 
  //本日の年・月・日を取得
  $year=date('Y');
  $month=date('n');
  $today=date('j');

  //月末日を取得
  $last_day=date('j',mktime(0,0,0,$month+1,0,$year));
?>
<!-- カレンダー表示-->
<table border="1">
  <tr>
    <td></td>
    <?php $day=$today;?>
    <!-- 本日から30日分の日付(横軸)を表示 -->
    <?php for($i=$today;$i<=$today+30; $i++){?>
      <th><?=$month?>/<?=$day?></th>
      <?php 
        $day=$day+1; 
        if($day==$last_day){
          $month+=1;
          $day=1;
        }
      ?>
    <?php }?>
  </tr>
  <!-- 9:00から24：00までの時間(縦軸)を表示 -->
  <?php $rows=$sql->fetchAll();?>
  <?php for($j=9; $j<=24; $j++){?>
    <tr>
      <th><?=$j?>:00</th>
      <?php 
        //本日の年・月・日を取得
        $year=date('Y');
        $month=date('n');
        $today=date('j');
        $day=$today;
        
      ?>
      <?php for($i=$today;$i<=$today+30; $i++){
          $judge='';
          $noyetFlag='on';
          for($k=0; $k<count($rows); $k++){
            $ymd=$rows[$k]['date'];
            $y=substr($ymd,0,4);
            if($y==$year){
              $m=substr($ymd,5,2);
              if($m==$month){
                $d=substr($ymd,8,2);
                if($d==$day){
                  $start=$rows[$k]['start'];
                  $start_h=substr($start,0,2);
                  $start_m=substr($start,3,2);
                  $end=$rows[$k]['end'];
                  $end_h=substr($end,0,2);
                  $end_m=substr($end,3,2);
                  if($noyetFlag=='on'){
                  //時間を比較して予定ありのところは塗りつぶす
                  if($start_h>$j){
                    echo '<td class="td_'.$year.'_'.$month.'_'.$day.'">'.$year.'/'.$month.'/'.$day.'</td>';
                  }else{
                    if($end_h<$j){
                      echo '<td class="td_'.$year.'_'.$month.'_'.$day.'">'.$year.'/'.$month.'/'.$day.'</td>';
                    }else{
                      if($start_m>=30){
                        echo '<td class="td_'.$year.'_'.$month.'_'.$day.'">'.$year.'/'.$month.'/'.$day.'</td>';
                      }else{
                        echo '<td bgcolor="black">'.$day.':'.$start_h.':'.$start_m.'-'.$end_h.':'.$end_m.'</td>';
                      }
                    }
                  }
                  $judge='on';
                  }else{

                  }
                $noyetFlag='off';
                }else{
                  //echo '<td>'.$year.'/'.$month.'/'.$day.'</td>';
                }
              }
            }
          }
          if($judge=='on'){
            
          }else{
            echo '<td class="td_'.$year.'_'.$month.'_'.$day.'">'.$year.'/:::'.$month.'/'.$day.'</td>';
          }
        // }
        ?>
        <?php 
          $day=$day+1; 
          if($day==$last_day){
            $month+=1;
            $day=1;
          }
        ?>
      <?php }?>
    </tr>
    <!-- <tr>
      <th><?=$j?>:30</th>
      <?php for($i=$today;$i<=$today+30; $i++){?>
        
        <?php
        foreach($sql->fetchAll() as $row){
          $ymd=$row['date'];
          $y=substr($ymd,0,4);
          $start= $row['start'];
        }
        ?>
        <?php $bgcolor = "#FF0000";?>
        <?php 
          $day=$day+1; 
          if($day==$last_day){
            $month+=1;
            $day=1;
          }
        ?>
      <?php }?>
    </tr> -->
    <tr>
      <th><?=$j?>:30</th>
      <?php 
        //本日の年・月・日を取得
        $year=date('Y');
        $month=date('n');
        $today=date('j');
        $day=$today;
      ?>
      <?php for($i=$today;$i<=$today+30; $i++){
        // foreach($sql->fetchAll() as $row){
          $judge='';
          foreach($rows as $row){
            $ymd=$row['date'];
            $y=substr($ymd,0,4);
            if($y==$year){
              $m=substr($ymd,5,2);
              //echo 'yearOK';
              if($m==$month){
                $d=substr($ymd,8,2);
                //echo 'monthOK';
                if($d==$day){
                  $start=$row['start'];
                  $start_h=substr($start,0,2);
                  $start_m=substr($start,3,2);
                  $end=$row['end'];
                  $end_h=substr($end,0,2);
                  $end_m=substr($end,3,2);
                  //時間を比較して予定ありのところは塗りつぶす
                  if($start_h>$j){
                    echo '<td class="td_'.$year.'_'.$month.'_'.$day.'">'.$year.'/'.$month.'/'.$day.'</td>';
                  }else{
                    if($end_h<$j){
                      echo '<td class="td_'.$year.'_'.$month.'_'.$day.'">'.$year.'/'.$month.'/'.$day.'</td>';
                    }else{
                      if($end_h==$j){
                        if($end_m=='00'){
                          echo '<td class="td_'.$year.'_'.$month.'_'.$day.'">'.$year.'/'.$month.'/'.$day.'</td>';
                        }else{
                          echo '<td bgcolor="black">'.$start_h.':'.$start_m.'-'.$end_h.':'.$end_m.'</td>';
                        }
                      }else{
                        echo '<td bgcolor="black">'.$start_h.':'.$start_m.'-'.$end_h.':'.$end_m.'</td>';
                      }
                    }
                  }
                  $judge='on';
                }else{

                }
              }
            }
          }
          if($judge=='on'){

          }else{
            echo '<td class="td_'.$year.'_'.$month.'_'.$day.'">'.$year.'/'.$month.'/'.$day.'</td>';
          }
        ?>
        <?php 
          $day=$day+1; 
          if($day==$last_day){
            $month+=1;
            $day=1;
          }
        ?>
      <?php }?>
    </tr>
  <?php }?>
</table>



  