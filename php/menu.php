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
  				<li><a href="home.php" class="gn-icon gn-icon-download">Inicio</a></li>
  				<li><a href="modificarPerfil.php" class="gn-icon gn-icon-cog">Datos de Perfil</a></li>
  				<li><a href="estadisticas.php" class="gn-icon gn-icon-cog">Estadisticas Personales</a></li>
  				<li><a href="logout.php" class="gn-icon gn-icon-download">Cerrar sesi&oacute;n</a></li>
  			</ul>
  		</div><!-- /gn-scroller -->
  	</nav>
  </li>
</ul>

<script src="js/classie.js"></script>
<script src="js/gnmenu.js"></script>
<script>
    new gnMenu( document.getElementById( 'gn-menu' ) );
</script>