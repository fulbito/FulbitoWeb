<!DOCTYPE html>
<html>

<? $this->load->view('templates/head'); ?>

<body>

<div id="wrapper">

    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>

    <? $this->load->view('templates/menu'); ?>

    <div id="maincontent">
      <? $this->load->view('templates/header'); ?>

	  <div id="centro" class="sombra redondeado">

        <form>
            <input type="mail" placeholder="E-mail" name="mail"/>
            <input type="submit" name="enviar_mail" value="Invitar"/>
        </form>

        <?
        foreach($usuarios as $usuario)
        {
            echo $usuario->nombre."<br>";
        }
        ?>

      </div>

    </div>

</div>

</body>

</html>