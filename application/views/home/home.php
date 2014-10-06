<!DOCTYPE html>
<html>

<? $this->load->view('templates/head'); ?>

<body>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/slider/engine1/style.css" />

<div id="wrapper">

    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>

    <? $this->load->view('templates/menu'); ?>

    <div id="maincontent">
      <? $this->load->view('templates/header'); ?> 

	  <div id="centro" class="sombra redondeado">
        <div class="boton_home" onclick="window.location.href='<?=base_url()?>index.php/partido/crear'">
            <div class="boton_home_title">CREAR UN<br>PARTIDO</div>
            <img src="<?=base_url()?>assets/images/crear.png" alt="" />
            <p>Crea un partido publico o privado, elegi el lugar del encuentro y listo!</p>
        </div>
        <div class="boton_home" onclick="window.location.href='<?=base_url()?>index.php/partido/buscar'">
            <div class="boton_home_title">BUSCAR<br>PARTIDOS</div>
            <img src="<?=base_url()?>assets/images/buscar.png" alt="" />
            <p>Busca un partido cerca tuyo y sumate!</p>
        </div>
        <div class="boton_home" onclick="window.location.href='<?=base_url()?>index.php/partido/mis_partidos/'">
            <div class="boton_home_title">VER MIS PARTIDOS</div>
            <img src="<?=base_url()?>assets/images/buscar.png" alt="" />
            <p>Ver mis partidos !</p>
        </div>
      </div>

    </div>
</div>

</body>


</html>

