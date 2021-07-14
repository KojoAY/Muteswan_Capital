// JavaScript Document

$(document).ready(function(e) {
	$("#_BTN_SAVE").click(function(e){
		var frmPages = $("form#frmPages"), refId = $('input#PAGE_ID').val();
		var formData = new FormData(frmPages[0]);
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
						window.location.assign("./?tk=e4da3b7fbbce2345d7772b0674a318d5&ftk=Edit&ed="+refId);
					});
				});
            }           
       });
	});
	
});