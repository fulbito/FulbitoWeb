<!DOCTYPE html>

<html class="no-js">

<? $this->load->view('templates/head'); ?>

<body>

<div id="wrapper">

    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>

    <? $this->load->view('templates/menu'); ?>

    <div id="maincontent">
     
      <? $this->load->view('templates/header'); ?> 

	  <div id="centro" class="sombra redondeado">
        <h1>MIS PARTIDOS</h1>
        <?
        foreach($partidos as $partido)
        {
          print "<a href='".base_url()."index.php/partido/armar/".$partido['id']."'>".$partido['nombre']."</a><br>";
        }
        ?>
      </div>

    </div>
</div>

</body>


</html>

