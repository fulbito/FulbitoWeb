<!DOCTYPE html>

<? $id_usuario =  $this->session->userdata('id'); ?>

<html class="no-js">

<? $this->load->view('templates/head'); ?>

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/partido.js"></script>

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
      
        if(isset($datos_partido->fecha)):  // Esta editando el partido

  		    $atributos = array('name' => 'editar_partido', 'id' => 'editar_partido'); 
          echo form_open('partido/editar/'.$datos_partido->id, $atributos);
          echo form_hidden('id_partido', $datos_partido->id );

        else: // Esta creando 

          $atributos = array('name' => 'crear_partido', 'id' => 'crear_partido'); 
          echo form_open('partido/crear', $atributos);

        endif;
        ?>
            <input id="id_usuario" name="id_usuario" type="hidden" value="<? echo $id_usuario; ?>" />
            <input <? if(isset($datos_partido->nombre)) echo "value=".$datos_partido->nombre; ?> type="text" name="nombre" id="nombre" placeholder="Nombre del partido"/><br>
            <input <? if(isset($datos_partido->fecha)) echo "value=".$datos_partido->fecha; ?> type="date" name="fecha" id="fecha" placeholder="Fecha"/>*<br>
            <input <? if(isset($datos_partido->hora)) echo "value=".$datos_partido->hora; ?> type="time" name="hora" id="hora" placeholder="Hora"/>*<br>
            
            <?
            if(isset($datos_partido->nombre)):
                foreach ($tipo_visibilidad_partido->result() as $row ) 
                { 
                    if($row->id == $datos_partido->id_tipo_visibilidad_partido )
                      echo "<input type='radio' name='id_tipo_visibilidad_partido' id='id_tipo_visibilidad_partido' checked='checked' value=".$row->id." /> ".$row->descripcion; 
                    else
                      echo "<input type='radio' name='id_tipo_visibilidad_partido' id='id_tipo_visibilidad_partido' value=".$row->id." /> ".$row->descripcion;
                }  
            else:
                  foreach ($tipo_visibilidad_partido->result() as $row ) 
                  { ?>
                      <input type="radio" name="id_tipo_visibilidad_partido" id="id_tipo_visibilidad_partido" value="<?=$row->id;?>" <? if($row->descripcion=='Privado') echo 'checked=checked'; ?>/> <? echo $row->descripcion; ?>   
              <?  } 
            endif; ?>
            <br>  
            <input type="text" name="cancha" id="cancha" placeholder="Cancha/Club/Lugar"/><br>
            <input <? if(isset($datos_partido->hora)) echo "value=".$datos_partido->cant_jugadores; ?> type="text" name="cant_jugadores" id="cant_jugadores" placeholder="Cantidad de Jugadores"/><br>
        <?

        if(!isset($datos_partido->fecha)): 
            echo form_submit('crear', 'CREAR PARTIDO');
        else:
            echo form_submit('editar', 'EDITAR PARTIDO');
        endif; 

        echo form_close() ?>
    
    </div>

    </div>

</div>

</body>


</html>