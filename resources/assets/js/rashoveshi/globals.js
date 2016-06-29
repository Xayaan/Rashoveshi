$(document).foundation();

$( document ).ready(function() {
	var nav = $('.top-menu-bar');
 var mobilenav = $('.title-bar');
 $(window).scroll(function() {
  if ($(this).scrollTop() > 70) {
    nav.addClass("shrink");
    mobilenav.addClass("mobilefixed");
    $('.name .small').fadeIn();
    $('.name .large').hide();

  } else {
    nav.removeClass("shrink");
    mobilenav.removeClass("mobilefixed");
    $('.name .small').hide();
    $('.name .large').fadeIn();
  }

});
 setTimeout(function() {
  $('.top-article-ad').slideUp('slow');
}, 5000);
 var adurl = "images/ads/homesidead.png";
 $( ".category-news .sub-featured:nth-child(3)" ).after( '<div class="large-6 column sub-featured-ad nopadding-right end"><img src="'+adurl+'")"></div>' );

 if ($('.results-view').height() > 250) {
  $('.result-ad').show();
}
});



// globals_configs.init();
var globals = function(){
   // global configs
   var _timeago = function(){
     if($('abbr.timeago').length > 0 ){
       $('abbr.timeago').timeago();
     }
   }

   var _embed = function(){
    if($('.embed').length > 0){
     $.each($('.embed'), function(){
      var embedURL = $(this).data("url");
      var that = $(this);
      console.log(embedURL);
            // var getEnmbedUrl = $("#embed_this_"+hash).val();
            
            if(embedURL){
              var newUrl = "/embed?url=" + embedURL;
              $.getJSON(newUrl,function(result){
                console.log(result);

                that.html(result.html);
                that.addClass('loaded');
              });
            }

          });
   }
 }

 var _atk = function(){
  if($('.atk').length > 0){
   $('.atk').thaana({keyboard: 'phonetic'});  
 }
}

return{
  init:function(){
   _timeago();
   _embed();
   _atk();
 }
}
}();



$(document).ready(function(){        
  globals.init();  
  
});


$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


function getCookie(name) {
  var dc = document.cookie;
  var prefix = name + "=";
  var begin = dc.indexOf("; " + prefix);
  if (begin == -1) {
    begin = dc.indexOf(prefix);
    if (begin != 0) return null;
  }
  else
  {
    begin += 2;
    var end = document.cookie.indexOf(";", begin);
    if (end == -1) {
      end = dc.length;
    }
  }
  return unescape(dc.substring(begin + prefix.length, end));
} 

$(document).on("click",".reactions div",function(e){
 var react = "positive";
 var commt_id = $(this).parent().data("comment-id");
 var react_count = $(this).data("count");
 var react_container = $(this);

 if ($(this).hasClass( "negative" )) { react = "negative"; };

 var reactCookie = getCookie('comment_r_'+ commt_id);

 if (reactCookie == null) {
  $.ajax({
   url: "/comments/reaction",
   type: 'POST',
   data:  'id='+commt_id+'&react='+react,
   success: function(data) {

     if (data=="Reacted positive" || data=="Reacted negative") {
      react_container.find("span").html(react_count+1);
      react_container.addClass("active");
    }else{
      react_container.addClass("active");
    }

    document.cookie = 'comment_r_'+ commt_id + '='+ react;
    console.log(data);
  }
});
}
else {
  console.log("You've already reacted, one does not simply react twice. Make a stand.");
}

});

$(document).on("click",".post-comment",function(e){
 e.preventDefault();
 var formData = new FormData($('#comments-form')[0]);
 $.ajax({
  url: "/comments",
  type: 'POST',
  dataType: 'json',
  data: formData,
  processData: false,
  contentType: false,
  success: function(data) {
   console.log(data);
   if (data === true){
    $('#comments-form')[0].reset();          
    $('.comment-msg').html("ފޮނުވި ހިޔާލަށް ވަރަށް ބޮޑަށް ޝުކުރިއްޔާ! ރިވިއު ކުރުމަށް ފަހު ޝާއިއު ކުރާނެ!").delay(4000).slideUp();
    $('.comment-msg').fadeIn('fast');
    $('#comments-form').fadeOut();
  }
  setTimeout(function(){
   resetForm();
   $('.status-msg').removeClass('ok');
 },6000)

            // alert(data);
          }
        });
});

$(document).on('click', ".reply", function(e){
 e.preventDefault();
 var commentid = $(this).data('id');
 $('html, body').animate({
  scrollTop: $('#comments-form').offset().top - 100
}, 'slow');
 $('.parent-id').val(commentid);
 $('#comments-form').fadeIn();
 $('.comment-msg').fadeOut();
});

$(document).ready(function(){
    $("#example-menu").sticky({topSpacing:0});
  });