function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires="+d.toString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substr(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substr(name.length, c.length);
		}
	}
	return "";
}

function changeTheme(theme){
	var newTheme;
	switch (theme) {
		case '1':
			newTheme = "url(../img/fond-bleu.jpg)";
			break;
		case '2':
			newTheme = "url(../img/Fond-rouge-graph.jpg)";
			break;
		case '3':
			newTheme = "url(../img/fond-vert.png)";
			break;
		default:
			newTheme = "url(../img/ufyOtlo.jpg)";
	}
	setCookie("theme", newTheme, 365);
	$("body").css({"background-image": newTheme});
}

function changePolice(police){
	var newPolice;
	switch (police) {
		case 'arial':
			newPolice = "Arial, sans-serif";
			break;
		case "comic":
			newPolice = "Comic Sans MS, Comic Sans, cursive";
			break;
		case "century":
			newPolice = "New Century Schoolbook, serif";
			break;
		default:
			newPolice = "georgia, serif";
	}
	setCookie("police", newPolice, 365);
	$("body").css({"font-family": newPolice});
}

function themeDefaut(){
	eraseCookie("theme");
	eraseCookie("police");
	$("body").css({"margin":"0","background-image":"url(../img/ufyOtlo.jpg)","font-family":"georgia, serif"});
}

function eraseCookie(name) {
	setCookie(name,"",-1);
}

$(document).ready(function(){
	var theme = getCookie("theme");
	if (theme != "") {
		$("body").css({"background-image": theme});
	} else {
		if (theme != "" && theme != null) {
			setCookie("theme", "url(../img/ufyOtlo.jpg)", 365);
		}
	}

	var police = getCookie("police");
	if (police != "") {
		$("body").css({"font-family": police});
	} else {
		if (police != "" && police != null) {
			setCookie("police", "georgia, serif", 365);
		}
	}
});
