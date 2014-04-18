// ----------------- FECHA ------------------ //
$(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd"
    });
});

// ----------------- HORA ------------------ //
$(function() {
  $("#hora").clockpick({
starthour : 0,
endhour : 24,
showminutes : true,
minutedivisions: 2,
military: true

}
);
});

// ----------------- VALIDAR ------------------ //


$(function(){	
		
		$('#formCrearPartido').validate({

			rules : {
					datepicker : {
						required : true
					},
					hora : {
						required : true
					},
                    cantidadJugadores : {
					   number: true
					},
                    cantidadSuplentes : {
						number: true
					}
			},
			messages : {
					datepicker : {
						required : "Debe escribir la fecha del partido."
					},
					hora : {
						required : "Debe escribir la hora del partido."
					},
                    cantidadJugadores : {
						number : "Debe escribir un numero."
					},
                    cantidadSuplentes : {
						number : "Debe escribir un numero."
					}
			}
		});


});
