$(function(){	
		
		/* VALIDAR AL CREAR EL PARTIDO */

		$('#crear_partido').validate({

			rules : {
						fecha : {
							required : true
						},
	                    hora : {
						   required: true
						},
						cant_jugadores: {
							digits: true
						}
			},
			messages : {

						fecha : {
							required : "Debe escribir la fecha."
						},
	                    hora : {
							required : "Debe escribir la hora."
						},
						cant_jugadores: {
							digits: "La cantidad debe ser solo numeros"
						}
			}
		});

		/* VALIDAR AL EDITAR EL PARTIDO */

		$('#editar_partido').validate({

			rules : {
						fecha : {
							required : true
						},
	                    hora : {
						   required: true
						},
						cant_jugadores: {
							digits: true
						}
			},
			messages : {

						fecha : {
							required : "Debe escribir la fecha."
						},
	                    hora : {
							required : "Debe escribir la hora."
						},
						cant_jugadores: {
							digits: "La cantidad debe ser solo numeros"
						}
			}
		});


	/* MUESTRA LOS DIV EN CONFIGURACION */

	$(".tipo_partido").change(function () {
      
      if($(this).val() == '1') // Muestra seleccion jugadores
      {
        $( "#div_armar_equipos" ).show();
        $( "#div_desafiar_jugador" ).hide();
        $( "#div_desafiar_equipo" ).hide();
      }

      if($(this).val() == '2') // Muestra ajax jugadores
      {
        $( "#div_armar_equipos" ).hide();
        $( "#div_desafiar_jugador" ).show();
        $( "#div_desafiar_equipo" ).hide();
      }

      if($(this).val() == '3') // Muestra ajax equipos
      {
        $( "#div_armar_equipos" ).hide();
        $( "#div_desafiar_jugador" ).hide();
        $( "#div_desafiar_equipo" ).show();
      }

  });

	/* VALIDA LA CONFIGURACION DE PARTIDOS  */

  $('#configurar_partido').validate({


      rules : 
      {
              tipo_partido : 
              {
                required : true
              },
              tipo_seleccion_jugadores: 
              {
                   required: 
                   {
                          depends: function(element) 
                          {
                            
                              if ( $('input[name=tipo_partido]:checked', '#configurar_partido').val() == 1)
                              {
                                  return true;
                              }
                              else
                              {
                                  return false;
                              } 
                          }
                    }
              } ,
              jugador_desafiado: 
              {
                   required: 
                   {
                          depends: function(element) 
                          {
                              if ( $('input[name=tipo_partido]:checked', '#configurar_partido').val() == 2)
                              {
                                  return true;
                              }
                              else
                              {
                                  return false;
                              }
                          }
                    }
              },
              equipo_desafiado: 
              {
                   required: 
                   {
                          depends: function(element) 
                          {
                              if ( $('input[name=tipo_partido]:checked', '#configurar_partido').val() == 3)
                              {
                                  return true;
                              }
                              else
                              {
                                  return false;
                              }
                          }
                    }
              }
      },
      messages : {

            tipo_partido : {
              required : "Debe seleccionar el tipo de partido."
            },
            tipo_seleccion_jugadores:{
              required : "Debe seleccionar quien arma los equipos"
            } ,
            jugador_desafiado:{
              required : "Debe escribir el jugador a desafiar"
            } ,
            equipo_desafiado : {
              required : "Debe escribir el equipo a desafiar"
            }
      }

  });
  


});
