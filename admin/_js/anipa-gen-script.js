// JavaScript Document

$(document).ready(function(e) {
	
	
    $("i#ddown").click(function(e) {
		var NAVID = "nav#"+$(this).attr('ddNav');
		var ID = $(this).attr('ddNav');
		var DDOWN_CLICKS = $(this).data('clicks');
		if(DDOWN_CLICKS) {
			$(NAVID).css({'display':'none'});
		} else {
			$(NAVID).css({'display':'inline-block'});
			$(NAVID+" div").click(function(e) {
                $("div#"+ID+" input").val($(this).attr("contentVal"));
				$(NAVID).css({'display':'none'});
            });
		}
		
		$(this).data('clicks', !DDOWN_CLICKS)
    });
	
	
});