
$(document).ready(function(){

 var limit = 4;
 var start = 0;  
 var action = true;
 function loading_data(limit, start)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   beforeSend:function()
   {
    $(".spinner").show();
  },
  success:function(data)
  {
    $(".spinner").remove();
    $('#load_data').append(data);

    if(data.search(".spinner")==-1)
    {
     action = false;
     setTimeout(function(){
       $(".completed").remove();
     }, 3000);
   }
   else
   {
     action = true;
   }
 }
});
}


loading_data(limit, start);


$(window).scroll(function(){

  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == true)
  {
    action = false;
    start = start + limit;
    setTimeout(function(){
      loading_data(limit, start);
    }, 1000);
  }
});

});