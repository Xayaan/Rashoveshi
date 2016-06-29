window.Dropzone;
Dropzone.autoDiscover = false;

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
      if($('.thaana').length > 0){
         $('.thaana').thaana({keyboard: 'phonetic'});  
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


// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': 
//     }
// });

var Badha  = Badha || {};

Badha.Utils = Badha.Utils || {};

Badha.Utils.Dropzone = function(el, cb){
	var type = $(el).data('img-type');
	var imageName = $(el).data('img-name');
	var mockFile = { name:imageName, size: 12345 };
	var _input = el + '_upload';
	var myDropzone = new Dropzone (el,{ 
		url: '/upload' ,
		thumbnailWidth:166,
   	thumbnailHeight:166,
		maxFiles: 1,
		addRemoveLinks: true,
		dictDefaultMessage:"Click to browse or drop a photo to upload.",
		init:function(){
			this.on('sending', function(file, xhr, formData){
				formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
				formData.append("_type", type);
			});

			this.on("success", function(file, result){
				$(_input).val(result.filename);
				$(el).attr('data-photoid', result.id);
				$(el).attr('data-img-name', result.filename);
			});
			this.on("removedfile", function(file) {
					var id = $(el).data('photoid');
					Badha.Photo.DeleteById(id);
					$(_input).val("");
			});
		}
	});

	if (typeof imageName !== "undefined"){
			console.log(imageName);
			myDropzone.emit("addedfile", mockFile);
			myDropzone.emit("thumbnail", mockFile, "/uploads/"+ type +"/square_"+imageName);
			$(".dz-progress").remove();
			console.log(imageName);
		}
 }


Badha.Utils.Slugify = function(string) {
    // very preliminary slugify, must improve
    return string.replace(/['";:<>,\.\/\?\~`!@#$%^&*()_+-=]/gi,"").replace(/ +/gi, "-").toLowerCase();
}

Badha.Utils.UpdateEditor = function(el, ContentEditor){
	var content = ContentEditor.serialize();
	var data = content['element-0']['value'];
	var _html = data.replace(/(\r\n|\n|\r|\t)/gm,"");
	$(el + '.content').val(_html);
}

Badha.Utils.UpdatePhotoCaption = function(el, caption, cb){
	if($(el).next().is('figcaption')){
  		el.next('figcaption').html(caption);
  		return cb;
	}
	else{
  		$(el).after('<figcaption contenteditable="true" class="">'+ caption +'</figcaption>');
  		return cb;
  	}
}

Badha.Utils.SetHeader = function(xhr){
  	xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
}

/** Photos */
Badha.Photo = Badha.Photo || {};

/** Return photo details with attached tags */
Badha.Photo.GetById = function(id, success){
	return $.getJSON('/photos/' + id, success);
}

Badha.Photo.UpdateById =  function(data, cb){
	var _data = data;
	var _url = '/photos/' + data.id;
	var _setHeader = Badha.Utils.SetHeader;

	return $.ajax({ 
		type:"POST", 
		beforeSend: _setHeader, 
		url: _url, 
		data: _data	,
      success: cb,
      dataType:'JSON'
    });

	// return $.post(, _data, success, 'JSON');
}

Badha.Photo.DeleteById = function(id, cb){
	var _setHeader = Badha.Utils.SetHeader;
	return $.ajax({ 
		method: 'DELETE' , 
		beforeSend: _setHeader, 
		url: '/photos/' + id, 
		success:cb});
}

window.Badha = Badha;
