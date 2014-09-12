$(function(){

		$('#formRecuperar').validate({

			rules :{

					email : {

						required : true, //para validar campo vacio
						email    : true,  //para validar formato email
						remote: { url: "./php/comprobarEmail.php?recu=true", async: false } 

					}

			},

			messages : {

			 		email : {

						required : "Debe ingresar su email.",
						email    : "Debe ingresar un email valido.",
						remote    : "Email no encontrado."

					}

			}

		});    

});