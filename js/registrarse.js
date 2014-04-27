
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=596936237067988";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$(function(){
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
						remote: { url: "./php/comprobarEmail.php", async: false } 
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
                  url: 'php/webservices/procesaRegistracion.php',
                  data: $('#formRegistracion').serialize(),
                  type: 'POST',
                  dataType: 'json',
                  success: function(data){
                      if(data.error == false)
                      {
                        location.href="home.php";
                      }
                      else
                      {
                        $(".errorLogin").html(data.data);
                        $(".errorLogin").show();
                      }
                   },
                   error: function(error){
                     $(".errorLogin").html("Error ajax");
                     $(".errorLogin").show();
                   }
                });
            }
		});    
		
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
                  url: 'php/webservices/procesaIngresar.php',
                  data: $('#formIngresar').serialize(),
                  type: 'POST',
                  dataType: 'json',
                  success: function(data){
                      if(data.error == false)
                      {
                        location.href="home.php";
                      }
                      else
                      {
                        $(".errorLogin").html(data.data);
                        $(".errorLogin").show();
                      }
                   },
                   error: function(error){
                     $(".errorLogin").html("Error ajax");
                     $(".errorLogin").show();
                   }
                });
            }
		});
});