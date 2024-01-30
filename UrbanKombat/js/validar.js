// script para validar 

$(document).ready(function() {
	
	$("#nameOK").hide();
	$("#userOK").hide();
	$("#pass1OK").hide();
	$("#pass2OK").hide();
	
	$("#userLoginOK").hide();
	$("#passLoginOK").hide();


	// VALIDACIÓN DEL REGISTRO
	$("#campoUser").change(function(){
		const campo = $("#campoUser")[0];
		campo.setCustomValidity("");
		var value = $("#campoUser").val();
		if (value.length > 4 ) {
			var url = "comprobarUsuario.php?user=" + value;
			$.get(url,usuarioExiste);
		} else {			
			$("#userOK").text("❌");
			$("#userOK").show();
			campo.setCustomValidity(
				"El username tiene que tener una longitud de al menos 5 caracteres.");
		}
  });

	$("#campoName").change(function(){
		const campo = $("#campoName")[0];
		campo.setCustomValidity("");
		var value = $("#campoName").val();
		if (value.length > 4 ) {
			$("#nameOK").text("✅");
			$("#nameOK").show();
			campo.setCustomValidity("");
		} else {			
			$("#nameOK").text("❌");
			$("#nameOK").show();
			campo.setCustomValidity("El nombre tiene que tener una longitud de al menos 5 caracteres.");
		}
	});

	$("#campoPass1").change(function(){
		const campo = $("#campoPass1")[0];
		campo.setCustomValidity("");
		var value = $("#campoPass1").val();
		if (value.length > 4 ) {
			$("#pass1OK").text("✅");
			$("#pass1OK").show();
			campo.setCustomValidity("");
		} else {			
			$("#pass1OK").text("❌");
			$("#pass1OK").show();
			campo.setCustomValidity("La contraseña tiene que tener una longitud de al menos 5 caracteres.");
		}
	});
	

  $("#campoPass2").change(function(){
	const campo = $("#campoPass2")[0];
	campo.setCustomValidity("");
	var value1 = $("#campoPass1").val();
	var value2 = $("#campoPass2").val();
	if (value1 == value2) {
		$("#pass2OK").text("✅");
		$("#pass2OK").show();
		campo.setCustomValidity("");
	} else {			
		$("#pass2OK").text("❌");
		$("#pass2OK").show();
		campo.setCustomValidity("Las contraseñas deben coincidir.");
	}
	});

	function usuarioExiste(data,status) {
		$("#campoUser")[0].setCustomValidity(""); // limpia validaciones previas

		if(data=="existe"){
			$("#userOK").text("❌");
			$("#userOK").show();
			$("#campoUser").focus(); //Devuelvo el foco
			$("#campoUser")[0].setCustomValidity(
				"El usuario ya existe, escoge otro");
		}
		else if (data == "disponible") {
			$("#userOK").text("✅");
			$("#userOK").show();
			$("#campoUser")[0].setCustomValidity("");
		}
	}

	// VALIDACIÓN DEL LOGIN (sólo mita si están vacíos)
	$("#campoUserLogin").change(function(){
		const campo = $("#campoUserLogin");
		campo[0].setCustomValidity("");
		var value = $("#campoUserLogin").val();
		if (value.length == 0 ) {
			$("#userLoginOK").text("❌");
			$("#userLoginOK").show();
			campo.setCustomValidity("El username no puede estar vacío");
		} else {		
			$("#userLoginOK").text("✅");
			$("#userLoginOK").show();
			campo.setCustomValidity("");
		}
  });
	$("#campoPassLogin").change(function(){
		const campo = $("#campoPassLogin");
		campo[0].setCustomValidity("");
		var value = campo.val();
		if (value.length == 0  ) {
			$("#passLoginOK").text("❌");
			$("#passLoginOK").show();
			campo[0].setCustomValidity("La contraseña no puede estar vacía");
		} else {			
			$("#passLoginOK").text("✅");
			$("#passLoginOK").show();
			campo[0].setCustomValidity("");
		}
	});

});