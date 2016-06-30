$(document).ready(function(){
	var loadedAgency = $("#agency").val();
	if(loadedAgency == "") {
		var options = "";
		options = '<option value="">Selecione uma agência</option>';
		$("#agency").html(options);
	}else {
		var id = $("#bank").val();
		$.ajax({
			type 		: 'POST',
			url 		: '/Finance/Agency/findAgencyByBank/' + id,
			dataType 	: 'json',
			encode 		: true
		})
		.done(function(data) {
			console.log(data);
			var options = "";
        	$.each(data, function(key, value){
           		options += '<option value="' + value.id + '">' + value.name + '</option>';
        	});
        	$("#agency").html(options);
        	$("#agency").val(loadedAgency);
		})
		.fail(function(data) {

		});		
	}
	
	$("#bank").change(function(){
		var id = $("#bank").val();
		$.ajax({
			type 		: 'POST',
			url 		: '/Finance/Agency/findAgencyByBank/' + id,
			dataType 	: 'json',
			encode 		: true
		})
		.done(function(data) {
			console.log(data);
			var options = "";
        	$.each(data, function(key, value){
           		options += '<option value="' + value.id + '">' + value.name + '</option>';
        	});
        	$("#agency").html(options);
		})
		.fail(function(data) {

		});
	})
});