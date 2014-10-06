<!DOCTYPE html>

<? $id_usuario =  $this->session->userdata('id'); ?>


<!-- HTML5 Boilerplate -->
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif] -->

<head>
	
	<!-- Importante: la variable CI_ROOT se usa en JQUERY como base_url -->
	<script type="text/javascript">
        CI_ROOT = "<?=base_url() ?>";
    </script>

	<meta charset="utf-8">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Fulbito</title>

	<meta http-equiv="cleartype" content="on">
	<!--<link rel="shortcut icon" href="/favicon.ico">-->

	<!-- Responsive and mobile friendly stuff -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/html5reset.css" media="all">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/style.css" media="all">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/validate.css" media="all">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/menu.css" type="text/css">
    
	<!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements and feature detects -->
	<script src="<?=base_url()?>assets/js/modernizr-2.5.3-min.js"></script>


</head>

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.10.2.min.js"> </script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/additional-methods.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/partido.js"></script>
<body>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/slider/engine1/style.css" />

<div id="wrapper">

    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>

    <? $this->load->view('templates/menu'); ?>

    <div id="maincontent">
      <header>
          <a href="index.php"><img src="<?=base_url()?>assets/images/logo.png" alt="Fulbito" /></a>
          <div class="fb-follow" data-href="https://www.facebook.com/zuck" data-width="300" data-height="20" data-colorscheme="dark" data-layout="standard" data-show-faces="false"></div>
      </header>

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