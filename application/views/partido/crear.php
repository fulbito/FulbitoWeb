<!DOCTYPE html>

<!-- HTML5 Boilerplate -->
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif] -->

<? $this->load->view('templates/head'); ?>

<body>

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
        <h1>CREAR PARTIDO</h1>
        <?php echo validation_errors(); ?>
        <?php echo $error; ?>
		<? $atributos = array('name' => 'crear_partido', 'id' => 'crear_partido'); ?>
        <?php echo form_open('partido/crear', $atributos) ?>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre del partido"/><br>
            <input type="date" name="fecha" id="fecha" placeholder="Fecha"/><br>
            <input type="time" name="hora" id="hora" placeholder="Hora"/><br>
            <input type="text" name="cancha" id="cancha" placeholder="Cancha"/><br>
            <input type="submit" name="crear" value="CREAR"/><br>
        <?php echo form_close() ?>
      </div>

    </div>
</div>

</body>


</html>

