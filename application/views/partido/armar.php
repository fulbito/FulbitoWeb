<html class="no-js">

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
        <h1>ARMAR EQUIPOS para el partido <?=$partido['nombre']?></h1>
        <div id="tablero">
            <img src="<?=base_url()?>assets/images/tablero2.jpg" alt="" />
        </div>
        <div id="jugadores">
            <?
            foreach($jugadores as $jugador)
            {
              if( $jugador['PATH_FOTO'] == "default.jpg" )
              {
                $foto = "default.jpg";
              }
              else
              {
                $foto = "foto_web/".$jugador['PATH_FOTO'];
              }
              echo "<img style='width:75px; height:85px;' src='".base_url()."assets/images/fotos_perfil/".$foto."'>";
              echo $jugador['ALIAS']."<br>";
            }
            ?>
        </div>
      </div>

    </div>
</div>



</body>


</html>

