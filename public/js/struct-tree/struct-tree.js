$(document).ready(function(){





		$("#structDiv").show(function(){
			
			$.ajax({
				type 		: 'POST',
				url 		: '/Finance/Structure/createStruct',
				dataType 	: 'json',
				//encode 		: true
			})
			.done(function(data) {
				console.log(data);
				$('<ul id="structMainUl">').appendTo("#structTree"); 
			   	$.each(data, function(key, value){
			   		if(value.level == "1"){
			   			var options = "";
			   			options += '<li><a href="#" data-target="#'+ value.id +'" data-toggle="collapse" aria-expanded="false" aria-control="#'+ value.id +'" name="'+ value.id +'" class="glyphicon glyphicon-play"> ' + value.item + '</a></li>';
			   			options += '<ul class="collapse" id="' + value.id + '"></ul>';
			   			$("#structMainUl").append(options);
			   		}
			   		if(value.level == "2" || value.level == "3" || value.level == "4" || value.level == "5" || value.level == "6" || value.level == "7" || value.level == "8" || value.level == "9") {
			   			var options2 = "";
			   			options2 += '<li><a href="#" data-target="#'+ value.id +'" data-toggle="collapse" aria-expanded="false" aria-control="#'+ value.id +'"  name="'+ value.id +'" class="glyphicon glyphicon-play"> ' + value.item + '</a></li>';
			   			options2 += '<ul class="collapse" id="' + value.id + '"></ul>';
			   			$('#' + value.inherit).append(options2);
			   			$('[name$=' + value.inherit + ']').removeClass("glyphicon-play").addClass("glyphicon-plus-sign");
			   		}
				});

			   	insereDespesas(data);
			   	mapeiaStruct();

			})
			.fail(function(data) {
				console.log(data);
			});		
		});



	function insereDespesas(data) {
		$.each(data, function(key, value){	
			if(value.tipo == "D") {
				var optionsD = "";
				optionsD += '<li><a href="#" id="' + value.id + '" class="glyphicon glyphicon-record"> ' + value.item + '</a></li>';
				$('#' + value.pai).prepend(optionsD);
			}
		});	
	}


	function mapeiaStruct() {
			var descendentes = document.querySelectorAll("#structTree .glyphicon");
			for (var i = 0; i < descendentes.length; i++) {
				descendentes[i].addEventListener("click", function (e) {
					if($(e.target).hasClass("glyphicon-plus-sign")) {
						$("#inherit").val(e.target.text);
						$("#inheritId").val(e.target.name);
						$(e.target).removeClass("glyphicon-plus-sign").addClass("glyphicon-minus-sign");
					} else if($(e.target).hasClass("glyphicon-minus-sign")) {
						$("#inherit").val(e.target.text);
						$("#inheritId").val(e.target.name);
						$(e.target).removeClass("glyphicon-minus-sign").addClass("glyphicon-plus-sign");
					} else if($(e.target).hasClass("glyphicon-play")) {
						$("#inherit").val(e.target.text);
						$("#inheritId").val(e.target.name);
					} else if($(e.target).hasClass("glyphicon-record")) {
						//alert(e.target.name);
						alert(e.target.text);
						//todos os itens com classe record serão os item selecionaveis para o formulario
					}
				});
			}
	}
});


