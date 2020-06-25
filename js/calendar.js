$(document).on('click','.fc-day',function(){
  //alert( $(this).data('date'))
  let selected_ymd=$(this).data('date')
  location.href="view/schedule.php?date="+selected_ymd
})