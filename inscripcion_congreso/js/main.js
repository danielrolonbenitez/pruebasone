
		$().ready(function() {
		jQuery.validator.addMethod("selectComboboxCheck",
        function (value, element)
            {
                if ($(element).find(":selected").val() == -1) {
                    return false; 
                }
                else return true;
            },
            "Seleccione un cargo"
        );

		jQuery.validator.addMethod("selectComboboxCheckArea",
        function (value, element)
            {
                if ($(element).find(":selected").val() == -1) {
                    return false; 
                }
                else return true;
            },
            "Seleccione un área"
        );

        jQuery.validator.addMethod("selectComboboxCheckComision",
        function (value, element)
            {
                if ($(element).find(":selected").val() == -1) {
                    return false; 
                }
                else return true;
            },
            "Seleccione una comsión de trabajo"
        );

		$("#inscripcionForm").validate({
			onkeyup: false,
			rules: {
				last_name: "required",
				name: "required",
				dni: {
					required: true,
					number: true,
					remote: {
				        url: "check-dni.php",
				        type: "post",
				        dataFilter: function(data) {
		                    var json = JSON.parse(data);
		                    if(json === "true") {
		                        return true;
		                    }
		                    return false;
		                }
				      }
				},
				email: {
					required: true,
					email: true
				},
				cellphone: {
					required: true,
					number: true
				},
				phone: {
					required: true,
					number: true
				},
				position : {
					required: true
				},
				school : {
					required: true
				},
				district: {
			      required: true,
			      range: [1, 21]
			    },
			    agree: {
			      required: true
			    }

			},
			messages: {
				last_name: "Por favor complete con su apellido",
				name: "Por favor complete con su nombre",
				dni: {
					required: "Por favor complete con su DNI",
					number: "Solo ingrese números",
					remote: "Su DNI no figura en nuestra base de datos, por favor contáctese con CAMYP"
				},
				email: {
					required: "Por favor ingrese su email",
					email: "Por favor ingrese un email válido"
				},
				cellphone: {
					required: "Por favor ingrese su número de celular",
					number: "Solo ingrese números"
				},
				phone: {
					required: "Por favor ingrese su número telefónico",
					number: "Solo ingrese números"
				},
				position : {
					required: "Por favor indiquenos su posicion"
				},
				school: {
					required: "Por favor ingrese nombre del establecimiento",
				},
				district: {
					required: "Por favor complete con su D.E.",
					min: "El D.E. debe ser inferior o igual a 21",
					max: "El D.E. debe ser inferior o igual a 21",
					rangelength: "El D.E. debe ser inferior o igual a 21",
					range: "El D.E. debe ser inferior o igual a 21"
				},
				agree: "Por favor acepte los términos y condiciones",
			}
		});
		});
