<link href='https://use.fontawesome.com/releases/v5.6.1/css/all.css' rel='stylesheet'>
<script src='https://code.jquery.com/jquery-3.3.1.js'></script>

<style>
  li{list-style:none;}
  .fas:hover{cursor:pointer;}
</style>
<?php session_start();?>
<form action="../controller/adjustment_create.php" method="POST">
  <input type="hidden" name="member[]" value=<?php echo $_SESSION['user']['id'];?>>
  <li class="member-select"><i class="fas fa-plus-circle"></i><input type="text" name="member[]"><br></li>
  <input class="adjust" type="submit" value="調整する">
</form>

<script>
  $(document).on('click','.fa-plus-circle',function(){
    let newEle=$('.member-select').clone(true)
    $('.adjust').before(newEle[0])
  })
</script>

