
function controlTag(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 
    else if (tecla==0||tecla==9)  return true;
    patron =/[0-9\s]/;
    n = String.fromCharCode(tecla);
    return patron.test(n); 
}

function testText(txtString){
    var stringText = new RegExp(/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/);
    if(stringText.test(txtString)){
        return true;
    }else{
        return false;
    }
}

function testEntero(intCant){
    var intCantidad = new RegExp(/^([0-9])*$/);
    if(intCantidad.test(intCant)){
        return true;
    }else{
        return false;
    }
}

function fntEmailValidate(email){
    var stringEmail = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (stringEmail.test(email) == false){
        return false;
    }else{
        return true;
    }
}

function fntValidText(){

	$(".validText").keyup(function(event) {

		let inputValue = this.value;
		if(!testText(inputValue)){
			this.classList.add('form-control-danger');
		}else{
			this.classList.remove('form-control-danger');
		}				

	});
}


function fntValidNumber(){
	$(".validNumber").keyup(function(event) {
		let inputValue = this.value;
		if(!testEntero(inputValue)){
			this.classList.add('form-control-danger');
		}else{
			this.classList.remove('form-control-danger');
		}				
	});
}


function fntValidEmail(){
	$(".validEmail").keyup(function(event) {
		let inputValue = this.value;
		if(!fntEmailValidate(inputValue)){
			this.classList.add('form-control-danger');
		}else{
			this.classList.remove('form-control-danger');
		}				
	});
}

window.addEventListener('load', function() {
	fntValidText();
	fntValidEmail(); 
	fntValidNumber();
}, false);