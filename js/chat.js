$("#envoi").click(function(){
	$.post("insertion.php",
		{message:$("#message").val()});
	$("#message").val(" ");
	return false;
});

function rafraichir(){
	$("#chat").load("affichage.php");
}
rafraichir();
setInterval(rafraichir,1000);