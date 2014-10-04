<!DOCTYPE html>

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
    <script src="<?=base_url()?>assets/js/interact.js"></script>
    <script>
    (function (interact) {

        'use strict';

        var position = {};

        // setup draggable elements.
        interact('.js-drag')
            .draggable(true)
            .on('dragstart', function (event) {
                position.x = parseInt(event.target.dataset.x, 10) || 0;
                position.y = parseInt(event.target.dataset.y, 10) || 0;
            })
            .on('dragmove', function (event) {
                position.x += event.dx;
                position.y += event.dy;

                event.target.dataset.x = position.x;
                event.target.dataset.y = position.y;
                event.target.style.webkitTransform = event.target.style.transform = 'translate(' + position.x + 'px, ' + position.y + 'px)';
            });

        // setup drop areas.
        // every dropzone accepts draggable #3
        setupDropzone('.js-drop', '#drag1, #drag2, #drag3');

        /**
         * Setup a given element as a dropzone.
         *
         * @param {HTMLElement|String} el
         * @param {String} accept
         */
        function setupDropzone(el, accept) {
            interact(el)
                .dropzone({
                    accept: accept,
                    ondropactivate: function (event) {
                        event.relatedTarget.classList.add('-drop-possible');
                    },
                    ondropdeactivate: function (event) {
                        event.relatedTarget.classList.remove('-drop-possible');
                    }
                })
                .on('dropactivate', function (event) {
                    console.log('activate', event);
                    event.target.classList.add('-drop-possible');
                    //event.target.textContent = 'Drop me here!';
                })
                .on('dropdeactivate', function (event) {
                    console.log('deactivate', event);
                    event.target.classList.remove('-drop-possible');
                    //event.target.textContent = 'Dropzone';
                })
                .on('dragenter', function (event) {
                    event.target.classList.add('-drop-over');
                    //event.relatedTarget.textContent = 'I\'m in';
                })
                .on('dragleave', function (event) {
                    event.target.classList.remove('-drop-over');
                    //event.relatedTarget.textContent = 'Drag me…';
                })
                .on('drop', function (event) {
                    event.target.classList.remove('-drop-over');
                    //event.relatedTarget.textContent = 'Dropped';
                });
        }

    }(window.interact));
    </script>
</head>

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.10.2.min.js"> </script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/additional-methods.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/login.js"></script>

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
        <h1>ARMAR EQUIPOS<?=$partido->nombre?></h1>
        <div class="dropzone-wrapper">
            <div id="drop1" class="dropzone js-drop">Equipo 1</div>
            <div id="drop2" class="dropzone js-drop">Equipo 2</div>
        </div>
        <div id="jugadores">
          <div id="drag1" class="draggable js-drag">Jugador 1</div>
          <div id="drag2" class="draggable js-drag">Jugador 2</div>
          <div id="drag3" class="draggable js-drag">Jugador 3</div>
        </div>
      </div>

    </div>

</div>

</body>

</html>