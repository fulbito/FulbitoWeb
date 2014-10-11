<!DOCTYPE html>
<html>

<? $this->load->view('templates/head'); ?>

<script>
function invitar(id)
{
  $.ajax({
    url: CI_ROOT+'index.php/invitar/ajax_invitar',
    data: { id_usuario: id, id_partido: <?=$partido->id?> },
    async: false,
    type: 'POST',
    dataType: 'JSON',
    success: function(data)
    {
      if(data.error == false)
      {
          $('.usr_'+id).hide();
          $('.usuarios_invitados').append("<div class='usr_inv_"+id+"'>"+$('.usr_'+id).html()+"</div>");
          $('.usr_inv_'+id+' button').hide();
      }
      else
      {
          alert(data.data);
      }
    },
    error: function(x, status, error){
     alert(error);
    }
  });
}
</script>

<body>

<div id="wrapper">

    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>

    <? $this->load->view('templates/menu'); ?>

    <div id="maincontent">
      <? $this->load->view('templates/header'); ?>

	  <div id="centro" class="sombra redondeado">

        <form>
            Enviar invitacion por e-mail:
            <input type="mail" placeholder="E-mail" name="mail"/>
            <input type="submit" name="enviar_mail" value="Invitar"/>
        </form>

        <div class="usuarios">
            <h2>Usuarios</h2>
            <?
            foreach($usuarios as $usuario)
            {
                echo "<div class='usr_".$usuario['id']."'>".$usuario['alias']."<button onclick='invitar(".$usuario['id'].");'>Invitar</button></div>";
            }
            ?>
        </div>

        <div class="usuarios">
            <h2>Amigos</h2>
            <?
            foreach($amigos as $amigo)
            {
                echo "<div class='usr_".$amigo['id_usuario_amigo']."'>".$amigo['alias']."<button onclick='invitar(".$amigo['id_usuario_amigo'].");'>Invitar</button></div>";
            }
            ?>
        </div>

        <div class="usuarios_invitados">
            <h2>Invitados</h2>
            <?
            foreach($invitados as $invitado)
            {
                echo "<div class='usr_".$invitado['id_usuario']."'>".$invitado['alias']."</div>";
            }
            ?>
        </div>

      </div>

    </div>

</div>

</body>

</html>