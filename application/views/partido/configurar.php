<!DOCTYPE html>

<html class="no-js">

<? $this->load->view('templates/head'); ?>

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/partido.js"></script>

<script type="text/javascript">


$( document ).ready(function() {


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

 

</script>

<div id="wrapper">

    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>

    <? $this->load->view('templates/menu'); ?>

    <div id="maincontent">
      
    <? $this->load->view('templates/header'); ?> 

	  <div id="centro" class="sombra redondeado">
    <h1>PARTIDO</h1>


        <?  if(isset($mensaje_error)): ?>
                   <label class='errorLogin'><?=$mensaje_error?></label>
                <? unset($mensaje_error);
            endif;
        ?>

        <?  
            if(isset($mensaje_exito)): ?>
                 <label class='ok'><?=$mensaje_exito?></label>
              <? unset($mensaje_exito);
            endif;  
        ?>
        <?
		    $atributos = array('name' => 'configurar_partido', 'id' => 'configurar_partido'); 
        echo form_open('partido/configurar/', $atributos);
        ?>
            <input id="id_partido" name="id_partido" type="hidden" value="<? echo $datos_partido->id; ?>" /> 

           ¿ Qué tipo de partido vas armar ? </br>
           
           <?
              foreach ($tipo_partido->result()  as $row):
                  echo "<input class='tipo_partido' type='radio' name='tipo_partido' id='tipo_partido' value='".$row->id."' /> ".$row->descripcion."</br>";
              endforeach;
           ?>

           <div id='div_armar_equipos' style='display: none;'>
           ¿ Quién arma los equipos ?</br>
           <?
              foreach ($tipo_seleccion_jugadores->result()  as $row):
                echo "<input type='radio' name='tipo_seleccion_jugadores' id='tipo_seleccion_jugadores' value='".$row->id."' /> ".$row->descripcion."</br>";
              endforeach;
           ?>
           </div>

           <div id='div_desafiar_jugador' style='display: none;'>
               ¿ A quién queres desafiar ?</br>
              <input type='text' name='jugador_desafiado' id='jugador_desafiado'/>
           </div>

           <div id='div_desafiar_equipo' style='display: none;'>
               ¿ A qué equipo queres desafiar ?</br>
               <input type='text' name='equipo_desafiado' id='equipo_desafiado'/>
           </div>

        <?
        echo form_submit('configurar', 'CONFIGURAR PARTIDO');
        echo form_close() ?>
    
    </div>

    </div>

</div>

</body>


</html>