<!DOCTYPE html>


<html class="no-js">

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
       
        <div id="partidos_jugados" style="background-color:red; float:left;  width:50%;">
       		MIS PARTIDOS CREADOS <br>

       		<? 	
       			//echo "cantidad: ".$mis_partidos->num_rows();

       			if($mis_partidos->num_rows() == 0): 
       				echo "Aun no tiene partido creados";
       			else:
       				foreach ($mis_partidos->result() as $row):
       				
       					echo "<a href=".base_url()."index.php/partido/editar/".$row->id."> Editar </a> | <a href=".base_url()."index.php/partido/configurar/".$row->id."> Configurar </a> |  <a href=".base_url()."index.php/partido/armar/".$row->id."> armar </a> | ".$row->fecha." - ".$row->hora."<br>";
       				
       				endforeach;

       			endif;
       		?>


        </div>

        <div id="proximos_partidos" style="background-color:green; float:left;  width:50%;">
        	INVITACONES A PARTIDOS
        </div>
      
      </div>

    </div>
</div>
</body>
</html>