document.addEventListener('DOMContentLoaded', function() {

	if(document.querySelector("#formRecuperar")){		
		let formRecetPass = document.querySelector("#formRecuperar");
		formRecetPass.onsubmit = function(e) {
			e.preventDefault();

			let strEmail = document.querySelector('#txtResetCorreo').value;
			if(strEmail == ""){
				Swal.fire("Por favor", "Escribe tu correo electrónico.", "error");
				return false;
			}else{
				var request = (window.XMLHttpRequest) ? 
							new XMLHttpRequest() : 
							new ActiveXObject('Microsoft.XMLHTTP');

				var ajaxUrl = base_url+'/recuperar/resetClave'; 
				var formData = new FormData(formRecetPass);
				request.open("POST",ajaxUrl,true);
				request.send(formData);
				request.onreadystatechange = function(){
					
					if(request.readyState != 4) return;

					if(request.status == 200){
						var objData = JSON.parse(request.responseText);
						if(objData.resultado){
							
							Swal.fire({
								title: "",
								text: objData.msg,
								icon: "success",
								confirmButtonText: "Aceptar",
							}).then((result) => {
								if (result.isConfirmed){
									window.location = base_url;
								}
							});

						}else{
							Swal.fire("Atención", objData.msg, "error");
						}
					}else{
						Swal.fire("Atención","Error en el proceso", "error");
					}
					return false;
				}
			}
		}
	}



	if(document.querySelector("#formCambiarClav")){
		let formCambiarPass = document.querySelector("#formCambiarClav");
		formCambiarPass.onsubmit = function(e) {
			e.preventDefault();

			let strClave = document.querySelector('#txtclaveNuevo').value;
			let strClaveConfirmar = document.querySelector('#txtclaveNuevo2').value;
			let idUsuario = document.querySelector('#idusuario').value;

			if(strClave == "" || strClaveConfirmar == ""){
				Swal.fire("Por favor", "Escribe la nueva contraseña." , "error");
				return false;
			}else{
				if(strClave.length < 5 ){
					Swal.fire("Atención", "La contraseña debe tener un mínimo de 5 caracteres." , "info");
					return false;
				}
				if(strClave != strClaveConfirmar){
					Swal.fire("Atención", "Las contraseñas no son iguales." , "error");
					return false;
				}

				var request = (window.XMLHttpRequest) ? 
							new XMLHttpRequest() : 
							new ActiveXObject('Microsoft.XMLHTTP');
				var ajaxUrl = base_url+'/recuperar/setClave'; 
				var formData = new FormData(formCambiarPass);
				request.open("POST",ajaxUrl,true);
				request.send(formData);

				request.onreadystatechange = function(){
					if(request.readyState != 4) return;
					
					if(request.status == 200){
						var objData = JSON.parse(request.responseText);
						if(objData.resultado){

							Swal.fire({
								title: "",
								text: objData.msg,
								icon: "success",
								confirmButtonText: "Iniciar sessión",
							}).then((result) => {
								if (result.isConfirmed) {
									window.location = base_url+'/login';
								}
							});

						}else{
							Swal.fire("Atención",objData.msg, "error");
						}
					}else{
						Swal.fire("Atención","Error en el proceso", "error");
					}

				}

			}
		}
	} 

}, false);  