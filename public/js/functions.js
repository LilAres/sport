$(document).ready(function(){
	$("#menu-icon").click(function(){
		$("#mobilemenu").css("display", "block");
		$("#mobilemenu").animate({
			opacity: 1,
			top: "0"
		  }, 1500, function(){
			  
		  });
	});
	
	$("#close").click(function(){
		$("#mobilemenu").animate({opacity: 0, top: "-550"}, 500, function(){
			$("#mobilemenu").css("display", "none");	  
		});
	});
	
});