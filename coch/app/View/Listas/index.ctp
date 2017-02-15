<div class="user-backend">
	<h1>Generador de lista de precios</h1>
	<div class="full-cell mt24p">
		<label>
			Seleccione su lista
			<select class="list" id="list-select">
				<?php 
				if(count($lists_by_user) > 0) foreach($lists_by_user as $list) {
					echo '<option value="' .  h($list['List']['id']) . '">';
					echo h($list['List']['name']);
					echo '</option>';
				}
				else echo '<option value="-1">Lista predeterminada</option>'; ?>
				<option value="add">Agregar nueva lista...</option>
			</select>
			<input type="text" name="list" id="list-text" class="list" style="display: none">
		</label>
		<?php /*<a href="" class="edc">Editar datos cliente &gt;&gt;</a>*/ ?>
	</div>
	
	<div class="medium-cell">
		Seleccione la moneda
		<label class="ml40p"><input type="radio" name="currency" value="$" checked> Pesos</label>
		<label><input type="radio" name="currency" value="US$"> Dólares</label>
	</div>
	<div class="medium-cell ml08p dollar">
		Cotización Dólar
		<div class="dollar">
			1 dólar = <input id="dollar-price" type="text" value="<?php echo h(number_format($dollar_value, 2, ',', '')); ?>"> pesos
		</div>
	</div>


	<div class="price-generator">
		<div class="pg-title">Seleccione un item</div>
		<ul id="price-generator-list">
			<?php foreach($categories as $category) : ?>
				<li>
					<input type="checkbox" data-category="<?php echo h($category['Category']['id']); ?>">
						<a href=""><?php echo h($category['Category']['name']); ?></a>
					<span class="arrow"></span>
					<?php if(!empty($category['Category'][0])) : ?>
						<ul>
							<?php foreach($category['Category'] as $key_c1 => $child1) : ?>
								<?php if(!is_numeric($key_c1)) continue; ?>
								<li>
									<input type="checkbox" data-category="<?php echo h($child1['id']); ?>">
									<a href=""><?php echo h($child1['name']); ?></a>
									<span class="arrow"></span>
									<?php if(!empty($child1[0])) : ?>
										<ul class="with-products">
											<?php foreach($child1 as $key_c2 => $child2) : ?>
												<?php if(!is_numeric($key_c2)) continue; ?>
												<li>
													<input type="checkbox" data-product="true" data-category="<?php echo h($child2['id']); ?>">
													<a href=""><?php echo h($child2['name']); ?></a>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
		
<script type="text/javascript">
$("input[type=checkbox]").removeAttr("checked");
var price_format = function(number) {
	var price = new String(number).toString();
	price = price.split(".");
	if(!price[1]) price[1] = "";
	if(price[1].length >= 3) {
		var dec = price[1].substr(2, 1);
		price[1] = price[1].substr(0, 2);
		if(dec >= 5) price[1]++;
		price[1] = new String(price[1]).toString();
	}
	while(price[1].length < 2) price[1] += "0";
	price[1] = price[1].substr(0, 2);
	
	return price.join(",");
}
var price_to_number = function(number) {
	var price = new String(number).toString();
	price = price.replace(/[^0-9\.\-\,]/, '', price);
	price = price.split(",");
	price[1] = price[1].replace(/0+$/, '');	
	return parseFloat(price.join("."));
}

var crear_tabla = function(selector) {
	var tabla_base = '<table class="pg-list">' +
				'<thead>' +
					 '<tr>' +
						'<th colspan="2">Código</th>' +
						'<th>Descripción</th>' +
						'<th>Embalaje</th>' +
						'<th>Precio Lista</th>' +
						'<th>Precio Gral.</th>' +
						'<th>D1</th>' +
						'<th>D2</th>' +
						'<th>D3</th>' +
						'<th class="final-price" colspan="2">Costo final</th>' +
					'</tr>' +
				'</thead>' +
				'<tbody>' +
				'</tbody>' +
			'</table>';	
	var tabla = $(tabla_base);
	selector.append(tabla);
	
	return tabla;
};
var agregar_producto = function(tabla, id_variante, codigo, descripcion, embalaje, moneda, precio, d1, d2, d3) {


	var item_tabla = '<tr>' +
		'<td><input type="checkbox"></td>' +
		'<td data-type="code"></td>' +
		'<td data-type="name"></td>' +
		'<td data-type="packaging"></td>' +
		'<td class="price-partial" data-type="price-list"></td>' +
		'<td class="price-partial" data-type="price-list"></td>' +
		'<td><input type="text" value="0" data-type="percent-1">%</td>' +
		'<td><input type="text" value="0" data-type="percent-2">%</td>' +
		'<td><input type="text" value="0" data-type="percent-3">%</td>' +
		'<td class="final-price" data-type="final-price"></td>' +
		'<td><a class="punto" href="javascript:void(0)"></a></td>' +
	'</tr>';

	var item = $(item_tabla);

	item.find('input[type="checkbox"]').attr("data-product-variant", id_variante);
	item.find('td[data-type="code"]').text(codigo);
	item.find('td[data-type="name"]').text(descripcion);
	item.find('td[data-type="packaging"]').text(embalaje);

	item.find('td[data-type="price-list"]').attr("data-currency", moneda);
	item.find('td[data-type="price-list"]').attr("data-price", precio);

	item.find('input[data-type="percent-1"]').val(d1);
	item.find('input[data-type="percent-2"]').val(d2);
	item.find('input[data-type="percent-3"]').val(d3);

	//item.find('td[data-type="price-list"]').text(currency + ' ' + price_format(product_value));
	//item.find('td[data-type="final-price"]').text(currency + ' ' + price_format(product_value));
	tabla.find('tbody').append(item);

	item.find('input[type="text"]').change(function() {
		var tr = $(this).parent().parent();
		var original_price = price_to_number(tr.find('td[data-type="price-list"]:first').text());

		var price = (100 - tr.find('input[data-type="percent-1"]').val()) * original_price / 100;
		price = (100 - tr.find('input[data-type="percent-2"]').val()) * price / 100;
		price = (100 - tr.find('input[data-type="percent-3"]').val()) * price / 100;

		//item.find('td[data-type="final-price"]').data("currency", e[i].Currency.symbol);
		//item.find('td[data-type="final-price"]').data("price", e[i].ProductVariant.price);

		tr.find('td[data-type="final-price"]').text($("input[name=\"currency\"]:checked").val() + ' ' + price_format(price));
	});

	item.find('input[type="checkbox"]').change(function() {
		if(!$(this).is(':checked')) {
			var parent_category = $(this).parent().parent().parent().parent().parent().find("> input[type=\"checkbox\"]");
			while(parent_category.length > 0) {
				parent_category.removeAttr("checked");
				parent_category = parent_category.parent().parent().parent().find("> input[type=\"checkbox\"]");
			}
		}
	});

	$(tabla).append(item);
	
	return item;
	//if(tabla.prev().prev().is(":checked")) tabla.find("input[type=\"checkbox\"]").prop("checked", true);
};

var update_prices = function() {
	$("*[data-type=\"price-list\"]").each(function() {
		var currency = $(this).data('currency');
		var price = $(this).data('price');
		
		var elm = $(this);
		if(typeof price != 'undefined') {
			if(currency == $("input[name=\"currency\"]:checked").val()) {
				elm.text(currency + ' ' + price_format(price));
			}
			else if(currency == "US$" && $("input[name=\"currency\"]:checked").val() == "$") {
				price = price * price_to_number($("#dollar-price").val());
				elm.text('$ ' + price_format(price));
			}
			else if(currency == "$" && $("input[name=\"currency\"]:checked").val() == "US$") {
				price = price / price_to_number($("#dollar-price").val());
				elm.text('$ ' + price_format(price));
			}
		}
		elm.parent().find('input[data-type="percent-1"]').trigger("change");
	});
}


	
$("#price-generator-list a").click(function(e) {
	e.preventDefault();
	if($(this).parent().is(".open")) {
		$(this).parent().removeClass("open");
		//$(this).parent().find(".open").removeClass("open");
		
		//$(this).parent().find("input[type=checkbox]").removeAttr("checked");
	}
	else {
		$(this).parent().addClass("open")/*.hide().clearQueue().slideDown()*/;
	}
});

var guardar_item = function(pdf) {
	var data = new Object();
	data.client_id = <?php echo h($client['Client']['id']); ?>;
	if($("input[name=\"currency\"]:checked").val() == '$') data.currency_id = 1;
	else data.currency_id = 2;
	
	data.items = [];
	
	if($("input[data-product-variant]:checked").length == 0) {
		alert("Esta lista de precios está vacía.");
		return;
	}
	
	$("input[data-product-variant]:checked").each(function() {
		var elm = $(this);
		var tr = $(this).parent().parent();
		data.items.push({
			"variant": elm.data("product-variant"),
			"price_list": price_to_number(tr.find("td[data-type=\"price-list\"]").text()),
			"discount_1": tr.find("input[data-type=\"percent-1\"]").val(),
			"discount_2": tr.find("input[data-type=\"percent-2\"]").val(),
			"discount_3": tr.find("input[data-type=\"percent-3\"]").val(),
		});
	});
	data["exchange_rate"] = $("#dollar-price").val().replace(",", ".");
	if($("#list-text").is(":visible")) data["new_list"] = $("#list-text").val();
	else data["list"] = $("#list-select option:selected").val();
	
	loading++;
	if($("#loading").is(":visible")) $("#loading").stop().clearQueue().css("opacity", 1).show();
	else $("#loading").fadeIn();
	
	$.ajax({
		"url": "<?php echo Router::url('/listas/save', true);?>",
		"type": "POST",
		"data": data,
		"dataType": "json",
		"success": function(e) {
			loading--;
			if(loading <=0) {
				$("#loading").fadeOut();
			}
			if($("#list-text").is(":visible")) {
				var option = $("<option></option>");
				option.text($("#list-text").val());
				option.attr("value", e.id);
				option.insertBefore("option[value=\"add\"]");
				
				$("#list-text").hide();
				$("#list-select").show();
				option.prop("selected", true);
			}
			
			if(pdf) location.href = '<?php echo h(Router::url('/listas/exportar_lista')); ?>/' + e.id;
		}
		
	});
};


var loading = 0;
$("#price-generator-list ul.with-products > li > a").click(function(e) {
	
	var category = $(this).prev().data("category");
	var elm = $(this).parent();
	
	if(elm.data("loaded")) return;
	elm.data("loaded", true);
	
	loading++;
	
	if($("#loading").is(":visible")) $("#loading").stop().clearQueue().css("opacity", 1).show();
	else $("#loading").fadeIn();

	$.ajax({
		"url": "<?php echo Router::url('/listas/load_category', true);?>",
		"type": "POST",
		"dataType": "json",
		"data": {
			"category": category
		},
		"success": function(e) {
			if(e.length != 0) {
				//elm.append(tabla);
				var tabla = crear_tabla(elm);
				for(i=0;i<e.length;i++) {
					agregar_producto(tabla, e[i].ProductVariant.id, e[i].ProductVariant.code, e[i].ProductVariant.name, e[i].ProductVariant.packaging, e[i].Currency.symbol, e[i].ProductVariant.price, 0, 0, 0);
				}
				if(tabla.prev().prev().is(":checked")) tabla.find("input[type=\"checkbox\"]").prop("checked", true);
				update_prices();
			}
			loading--;
			if(loading <= 0) $("#loading").fadeOut();
		}
	});
});
$("input[name=\"currency\"]").change(update_prices);
$("#price-generator-list input[type=checkbox]").change(function(e) {
	if($(this).is(":checked")) {
		$(this).parent().find("input[type=checkbox]").prop("checked", true);
		$(this).parent().addClass("open");
		$(this).parent().find("li").addClass("open");
		$(this).parent().find("ul.with-products input[type=\"checkbox\"]").trigger("change");
		
		var elm = $(this);
		if($(this).is('input[data-product="true"]')) {
			elm.parent().removeClass("open");
			$(this).next().trigger("click");
			$(this).prop("checked", true);
		}
	}
	else {
		$(this).parent().find("input[type=checkbox]").removeAttr("checked");
		parent_category = $(this).parent().parent().parent().find("> input[type=\"checkbox\"]");
		while(parent_category.length > 0) {
			parent_category.removeAttr("checked");
			parent_category = parent_category.parent().parent().parent().find("> input[type=\"checkbox\"]");
		}
	}
});


$(function() {
	$("#guardar").click(function(e) {
		e.preventDefault();
		guardar_item();
	});
	$("#imprimir-seleccion").click(function(e) {
		e.preventDefault();
		guardar_item(true);
	});
	
	$("#list-select option:first").prop("selected", true);
	$("#list-select").change(function() {
		if($(this).find("option[value=\"add\"]").is(":selected")) {
			$("#list-select option:first").prop("selected", true);
			$("#list-select").hide();
			$("#list-text").show().focus();
		}
		else {
			if(!$("#list-select option[value=\"-1\"]").is(":selected")) cargar_lista($("#list-select").val());
		}
	});
	$("#list-text").val("").blur(function() {
		if($("#list-text").val() == "") {
			$("#list-text").hide();
			$("#list-select").show();
		}
	});
	$("#list-select").trigger("change");
	
	$("#mail-send").submit(function(e) {
		e.preventDefault();
		
		//
		if($("#list-text").is(":visible")) alert("Debe guardar la lista para poder enviarla.");
		else if($("#list-select option:selected").val() == -1) alert("Debe guardar la lista para poder enviarla.");
		else {
			$("#send-list-id").val($("#list-select option:selected").val());
			
			loading++;
			if($("#loading").is(":visible")) $("#loading").stop().clearQueue().css("opacity", 1).show();
			else $("#loading").fadeIn();

			$("#mail-send").ajaxSubmit({
				"dataType": "json",
				"success": function(e) {
					loading--;
					if(loading <=0) $("#loading").fadeOut();
					
					if(e.status) alert("Los correos se han enviado con éxito");
					else alert("Ocurrió un error al intentar enviar la lista. Por favor, intente de nuevo más tarde.");
				},
				"error": function() {
					loading--;
					if(loading <=0) $("#loading").fadeOut();
					
					alert("Ocurrió un error al intentar enviar la lista. Por favor, intente de nuevo más tarde.");
				}
				
			});
		}
	});
	$("#send1").click(function(e) {
		e.preventDefault();
		
		$("input[name=\"email[]\"]:eq(0)").removeAttr("disabled");
		$("input[name=\"email[]\"]:eq(1)").attr("disabled", "disabled");
		$("input[name=\"email[]\"]:eq(2)").attr("disabled", "disabled");
		
		$("#mail-send").submit();
		
		$("input[name=\"email[]\"]:eq(1)").removeAttr("disabled");
		$("input[name=\"email[]\"]:eq(2)").removeAttr("disabled");
	});
	$("#send2").click(function(e) {
		e.preventDefault();
		
		$("input[name=\"email[]\"]:eq(1)").removeAttr("disabled");
		$("input[name=\"email[]\"]:eq(0)").attr("disabled", "disabled");
		$("input[name=\"email[]\"]:eq(2)").attr("disabled", "disabled");
		
		$("#mail-send").submit();
		
		$("input[name=\"email[]\"]:eq(0)").removeAttr("disabled");
		$("input[name=\"email[]\"]:eq(2)").removeAttr("disabled");
	});
	$("#send3").click(function(e) {
		e.preventDefault();
		
		$("input[name=\"email[]\"]:eq(2)").removeAttr("disabled");
		$("input[name=\"email[]\"]:eq(0)").attr("disabled", "disabled");
		$("input[name=\"email[]\"]:eq(1)").attr("disabled", "disabled");
		
		$("#mail-send").submit();
		
		$("input[name=\"email[]\"]:eq(0)").removeAttr("disabled");
		$("input[name=\"email[]\"]:eq(1)").removeAttr("disabled");
	});
})

var cargando_lista = false;
var cargar_lista = function(id) {
	loading++;
	if($("#loading").is(":visible")) $("#loading").stop().clearQueue().css("opacity", 1).show();
	else $("#loading").fadeIn();
	
	if(!cargando_lista) {
		cargando_lista = true;
		$.ajax({
			"url": "<?php echo Router::url('/listas/cargar_lista', true); ?>/" + id,
			"dataType": "json",
			"success": function(data) {
				loading--;
				if(loading <=0) $("#loading").fadeOut();
				cargando_lista = false;
				
				$("#price-generator-list input[type=\"checkbox\"]").removeAttr("checked");
				$("#price-generator-list li.open").removeClass("open");
				$("#price-generator-list table.pg-list").remove();
				
				for(i=0;i<data.categories.length;i++) {
					var category = data.categories[i]
					$("#price-generator-list input[type=\"checkbox\"][data-category=\"" + category + "\"]").each(function() {
						$(this).prop("checked", true);
						var parent = $(this).parent();
						
						parent.addClass("open");
						if(parent.parent().is(".with-products")) {
							var tabla = crear_tabla(parent);
							for(i2=0;i2<data.products.length;i2++) {
								var i_category = data.products[i2].category;
								if(i_category == category) {
									var variante = data.products[i2].variant;
									var item = data.products[i2].item;
									var prod = agregar_producto(tabla, variante.id, variante.code, variante.name, variante.packaging, data.products[i2].currency, item.price_list, item.discount_1, item.discount_2, item.discount_3);
									prod.find("input[type=\"checkbox\"]").prop("checked", true);
								}
							}
						}
					});
				}
				for(i=0;i<data.other_products.length;i++) {
					var variante = data.other_products[i].variant;
					var categoria = data.other_products[i].category;
					var tabla = $("input[type=\"checkbox\"][data-category=\"" + categoria + "\"]").parent().find("table.pg-list");
					agregar_producto(tabla, variante.id, variante.code, variante.name, variante.packaging, data.other_products[i].currency, variante.price, 0, 0, 0);
				}
				update_prices();
			}
		});
	}
};

</script>

		<div class="print-or-save">
			<a href="" class="print" id="imprimir-seleccion">Imprimir selección</a>
			<a href="" class="save" id="guardar">Guardar</a>
		</div>
	</div>

	<?php /*
	<div class="full-cell mt24p">
		<div class="gd-title general-disc">Aplicar descuento general a</div>
		<div class="general-discount">
			<span class="categories">ILUMINACIÓN / Lámparas / Lámparas de descarga / Sodio</span>
			<span class="discount">
				<span class="d-line">D1</span>
				<input type="text" value="0" id="desc-gral1">%
			</span>
			<span class="discount">
				<span class="d-line">D2</span>
				<input type="text" value="0" id="desc-gral2">%
			</span>
			<span class="discount">
				<span class="d-line">D3</span>
				<input type="text" value="0" id="desc-gral3">%
			</span>
		</div>
	</div>
	 
	<div class="print-or-save mt05p">
		<a href="" class="print">Desplegar ítem</a>
		<a href="" class="save">Aplicar</a>
	</div>
*/ ?>
	<div class="send-by-mail">
		<form action="<?php echo Router::url('/listas/send_mail', true); ?>" method="POST" id="mail-send">
			<div class="sbm-title">Enviar por mail</div>
			<div class="mail first-mail">
				<input type="email" name="email[]" placeholder="Email 1">
				<a class="send" href="" id="send1">Enviar</a>
			</div>
			<div class="mail">
				<input type="email" name="email[]" placeholder="Email 2">
				<a class="send" href="" id="send2">Enviar</a>
			</div>
			<div class="mail">
				<input type="email" name="email[]" placeholder="Email 3">
				<a class="send" href="" id="send3">Enviar</a>
			</div>
			<div class="submit">
				<button type="submit">Enviar a todos</button>
			</div>
			<input type="hidden" name="list_id" id="send-list-id">
		</form>
	</div>

</div>
<div id="loading" style="display: none">Loading...</div>