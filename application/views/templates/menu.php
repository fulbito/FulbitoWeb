<ul id="gn-menu" class="gn-menu-main">
  <li class="gn-trigger">
  	<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
  	<nav class="gn-menu-wrapper">
  		<div class="gn-scroller">
  			<ul class="gn-menu">
  				<li class="gn-search-item">
  					<input placeholder="Search" class="gn-search" type="search">
  					<a class="gn-icon gn-icon-search"><span>Search</span></a>
  				</li>
  				<li><a href="<?=base_url()?>index.php/home" class="gn-icon gn-icon-download">Inicio</a></li>
  				<li><a href="<?=base_url()?>index.php/perfil" class="gn-icon gn-icon-cog">Datos de Perfil</a></li>
  				<li><a href="<?=base_url()?>index.php/partido" class="gn-icon gn-icon-cog">Mis Partidos</a></li>
                                <li><a href="<?=base_url()?>index.php/configuracion/menu/show_menu" class="gn-icon gn-icon-cog">Configuracion</a></li>
  				<li><a href="<?=base_url()?>index.php/login/logout" class="gn-icon gn-icon-download">Cerrar sesi&oacute;n</a></li>
  			</ul>
  		</div><!-- /gn-scroller -->
  	</nav>
  </li>
</ul>

<script src="<?=base_url()?>assets/js/classie.js"></script>
<script src="<?=base_url()?>assets/js/gnmenu.js"></script>
<script>
    new gnMenu( document.getElementById( 'gn-menu' ) );
</script>

<?// include("php/menu.php"); ?>

