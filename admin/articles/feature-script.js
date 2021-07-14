// JavaScript Document

$(document).ready(function(e) {
	
	$("#_BTN_SAVE").click(function(e){
		var frmArticles = $("form#frmArticles"), refId = $('input#ART_POSTDATE').val(), edId = $('input#ART_ED').val();
		var formData = new FormData(frmArticles[0]);
		e.preventDefault();
        $.ajax({
            url: "save-changes.php",
            type: "POST",
			enctype: 'multipart/form-data',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                $("#stat").html(data);
				$("#stat").css({'z-index':'900000000','position':'absolute'});
				$("#stat").fadeIn(2000, function(e){
					//alert(data);
					$("#stat").fadeToggle(2000, 0.0, function(e){
						window.location.assign("./?tk=1679091c5a880faf6fb5e6087eb1b2dc&ftk=Edit&tokid="+refId+"&ed="+edId+"");
					});
				});
            }           
       });
	});
	
	
	
	//search processing
	$("#_BTN_SEARCH").click(function(e) {
		var TOK = $("#tok").val();
        window.location.assign("./?tk=1679091c5a880faf6fb5e6087eb1b2dc&ftk=Search&tok="+TOK);
    });

});