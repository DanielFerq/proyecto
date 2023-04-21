/*$('.login-content [data-toggle="flip"]').click(function() {
	$('.login-box').toggleClass('flipped');
	return false;
});
var divLoading = document.querySelector("#divLoading"); */
document.addEventListener('DOMContentLoaded', function(){
	if(document.querySelector("#formLogin")){
		let formLogin = document.querySelector("#formLogin");
		formLogin.onsubmit = function(e) {
			e.preventDefault();

			let strUsuario = document.querySelector('#txtUsuario').value;
			let strClave = document.querySelector('#txtClave').value;

			if(strUsuario == "" || strClave == ""){
				Swal.fire("Por favor", "Escribe usuario y contraseña.", "error");
				return false;
			}else{
				//divLoading.style.display = "flex";
				var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
				var ajaxUrl = base_url+'/login/loginUser'; 
				var formData = new FormData(formLogin);
				request.open("POST",ajaxUrl,true);
				request.send(formData);
				request.onreadystatechange = function(){

					if(request.readyState != 4) return;

					if(request.status == 200){
						var objData = JSON.parse(request.responseText);
						if(objData.resultado){
							window.location = base_url+'/dashboard';
						}else{
							Swal.fire("Atención", objData.msg, "error");
							document.querySelector('#txtClave').value = "";
						}
					}else{
						Swal.fire("Atención","Error en el proceso", "error");
					}
					//divLoading.style.display = "none";
					return false;
				}
			}
		}
	}
	

}, false);  