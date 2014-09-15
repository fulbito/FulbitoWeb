
// ----------------- FECHA ------------------ //
/*
$(function() {
    $( "#fecha" ).datepicker({
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
*/
// ----------------- VALIDAR ------------------ //


$(function(){	
		
		$('#crear_partido').validate({

			rules : {
					nombre : {
						required : true
					},
					fecha : {
						required : true
					},
                    hora : {
					   required: true
					},
                    cancha : {
						required: true
					}
			},
			messages : {
					nombre : {
						required : "Debe escribir el nombre."
					},
					fecha : {
						required : "Debe escribir la fecha."
					},
                    hora : {
						required : "Debe escribir la hora."
					},
                    cancha : {
						required : "Debe escribir la cancha."
					}
			}
		});


});
