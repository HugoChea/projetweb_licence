$(document).ready(function(){
	$(".slide0").show();
	$(".slide0").siblings().hide();
	var i = 0;
	var state = -1;
	var defile = setInterval(function(){
		if (state == -1) {
			if(i==0){
				$(".slide1").show();
				$(".slide1").siblings().hide();
				i = 1;
			}
			else if(i==1){
				$(".slide2").show();
				$(".slide2").siblings().hide();
				i = 2;
			}
			else if(i==2){
				$(".slide3").show();
				$(".slide3").siblings().hide();
				i = 3;
			}
			else if(i==3){
				$(".slide4").show();
				$(".slide4").siblings().hide();
				i = 4;
			}
			else if(i==4){
				$(".slide0").show();
				$(".slide0").siblings().hide();
				i = 0;
			}
		}
	},5000);
	$("#Left").click(function(){
		clearInterval(defile);
		state = 1;
		if(i==0){
			$(".slide4").show();
			$(".slide4").siblings().hide();
			i = 4;
		}
		else if(i==1){
			$(".slide0").show();
			$(".slide0").siblings().hide();
			i = 0;
		}
		else if(i==2){
			$(".slide1").show();
			$(".slide1").siblings().hide();
			i = 1;
		}
		else if(i==3){
			$(".slide2").show();
			$(".slide2").siblings().hide();
			i = 2;
		}
		else if(i==4){
			$(".slide3").show();
			$(".slide3").siblings().hide();
			i = 3;
		}
	});
	$("#Right").click(function(){
		clearInterval(defile);
		state = 1;
		if(i==0){
			$(".slide1").show();
			$(".slide1").siblings().hide();;
			i = 1;
		}
		else if(i==1){
			$(".slide2").show();
			$(".slide2").siblings().hide();
			i = 2;
		}
		else if(i==2){
			$(".slide3").show();
			$(".slide3").siblings().hide();
			i = 3;
		}
		else if(i==3){
			$(".slide4").show();
			$(".slide4").siblings().hide();
			i = 4;
		}
		else if(i==4){
			$(".slide0").show();
			$(".slide0").siblings().hide();
			i = 0;
		}
	});
});
