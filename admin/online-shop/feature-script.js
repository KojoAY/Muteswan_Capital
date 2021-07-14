// JavaScript Document

$(document).ready(function(e) {
	
	$("#_BTN_SAVE").click(function(e){
		var frmAddNew = $("form#frmBooks"), refId = $('input#BOOK_REF_ID').val();
		var formData = new FormData(frmAddNew[0]);
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
						window.location.assign("./?tk=45c48cce2e2d7fbdea1afc51c7c6ad26&ftk=Edit&ed="+refId);
					});
				});
            }           
       });
	});
	
	
	
	//search processing
	$("#_BTN_SEARCH").click(function(e) {
		var TOK = $("#tok").val();
        window.location.assign("./?tk=45c48cce2e2d7fbdea1afc51c7c6ad26&ftk=Search&tok="+TOK);
    });

});