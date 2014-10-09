<!DOCTYPE html>
<html>

<? $this->load->view('templates/head'); ?>

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

<body>

<div id="wrapper">

    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>

    <? $this->load->view('templates/menu'); ?>

    <div id="maincontent">
      <? $this->load->view('templates/header'); ?>

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