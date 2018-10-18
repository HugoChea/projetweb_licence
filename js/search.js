$(document).ready(function(){
	$("#search").keyup(function(){
		$.get("search.php",
		{val:$(this).val()},
		function(result){
			$("#proposition").css("width",$("#search").css("width"));
			$("#proposition ul").html(result);
			if(result)
				$("#proposition").show();
			else
				$("#proposition").hide();
		});
	});
	$("body").click(function(){
		$("#proposition").hide();
	});
});
