
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=596936237067988";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$(function(){
		
		// VALIDA REGISTRARSE EN EL SISTEMA
		$('#formRegistracion').validate({

			rules :{
					alias : {
						required : true, //para validar campo vacio
						minlength : 6, //para validar campo con minimo 3 caracteres
						maxlength : 20  //para validar campo con maximo 9 caracteres
					},
					email : {
						required : true, //para validar campo vacio
						email    : true,  //para validar formato email
						remote: { url: CI_ROOT+"index.php/login/comprobar_email_existente/", type: 'POST', async: false } 
					},
					password : {
						required : true, //para validar campo vacio
						minlength : 6, //para validar campo con minimo 3 caracteres
						maxlength : 15  //para validar campo con maximo 9 caracteres
					},
					confirma_password : {
						required : true, //para validar campo vacio
						minlength : 6, //para validar campo con minimo 3 caracteres
						maxlength : 15,  //para validar campo con maximo 9 caracteres
						equalTo: "#password"
					}
			},
			messages : {
					alias : {
						required : "Debe ingresar su usuario.",
						minlength : "EL usuario debe tener un minimo de 6 caracteres",
						maxlength : "EL usuario debe tener un maximo de 20 caracteres"
					},
			 		email : {
						required : "Debe ingresar su email.",
						email    : "Debe ingresar un email valido.",
						remote    : "Email usado."
					}, 
					password : {
						required : "Debe ingresar su password.",
						minlength : "Su password debe tener un minimo de 6 caracteres",
						maxlength : "Su password debe tener un maximo de 15 caracteres"
					},
					confirma_password : {
						required : "Debe ingresar un password",
						minlength : "Su password debe tener un minimo de 6 caracteres",
						maxlength : "Su password debe tener un maximo de 15 caracteres",
						equalTo: "Los password deben ser iguales."
					}
			},
            submitHandler: function (form) {
                $.ajax({
				  url:  CI_ROOT+'index.php/login/registrar_usuario',
                  data: $('#formRegistracion').serialize(),
                  async: false,
                  type: 'POST',
                  dataType: 'JSON',
                  success: function(data){
                     if(data.error == false)
					  {
						location.href= CI_ROOT+'index.php/home';
					  }
					  else
					  {
						location.href= CI_ROOT+'index.php/login/error_registrar_usuario';
					  }
                   },
                   error: function(error){

                     $(".errorLogin").html("Error ajax");
                     $(".errorLogin").show();
                   }
                });
            } 
		});    
		
		// VALIDA INGRESAR AL SISTEMA 	
		$('#formIngresar').validate({
				
			rules :{
					correo : {
						required : true, //para validar campo vacio
						email    : true  //para validar formato email
					},
					clave : {
						required : true //para validar campo vacio
					}
			},
			messages : {
					correo : {
						required : "Debe ingresar su email.",
						email    : "Debe ingresar un email valido."
					},
			 		clave : {
						required : "Debe ingresar su clave."
					}
			},
            submitHandler: function (form) {

                $.ajax({
                  url: CI_ROOT+'index.php/login/ingresar',
                  data: $('#formIngresar').serialize(),
                  async: false,
                  type: 'POST',
                  dataType: 'JSON',
                  success: function(data)
                  {
					  if(data.error == false)
					  {
						location.href= CI_ROOT+'index.php/home';
					  }
					  else
					  {
						location.href= CI_ROOT+'index.php/login/error_ingresar';
					  }
                   },
                   error: function(error){
                     $(".errorLogin").html("Error ajax");
                     $(".errorLogin").show();
                   }
                });
            }
		});
		
		// VALIDAR RECUPERAR CONTRASEÑA.
		$('#formRecuperar').validate({

			rules :{

					email : {
						required : true, //para validar campo vacio
						email    : true,  //para validar formato email
						remote: { url: CI_ROOT+"index.php/login/comprobar_email_no_existente/", type: 'POST', async: false } 
					}
			},

			messages : {

			 		email : {

						required : "Debe ingresar su email.",
						email    : "Debe ingresar un email valido.",
						remote    : "Email no registrado."
					}
			}

		});    
});
